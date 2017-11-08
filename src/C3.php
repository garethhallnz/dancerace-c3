<?php
declare(strict_types=1);

namespace C3;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

/**
 * Class C3.
 *
 * @package C3
 */
abstract class C3
{
  protected $key;
  protected $sourceApp;
  protected $guzzleClient;
  const API_URL = 'https://lock-x1-c3api.c3exec.com/service/c3api';

  public function __construct($key, $sourceApp, $guzzleClient)
  {
    $this->key = $key;

    $this->sourceApp = $sourceApp;

    $this->guzzleClient = $guzzleClient;
  }


  public function getRequestUrl($action, $params): string
  {
    $params = array_merge(['action' => $action, 'key' => $this->key, 'sourceApp' => $this->sourceApp], $params);

    return self::API_URL . '?' . http_build_query($params);
  }

  /**
   * @param $clientId
   * @param $action
   * @param array $params
   * @return mixed
   * @throws C3ApiException
   */
  public function getRequest($clientId, $action, $params = [])
  {
    $response = $this->guzzleClient->request('GET', $this->buildRequestUrl($clientId, $action, $params));

    $body = $response->getBody();

    $contents = $body->getContents();

    $contents = $this->handleJsonErrors($contents);

    $data = json_decode($contents);

    if (!empty($data->SUCCESS) && $data->SUCCESS == 1) {
      return $data;
    }

    throw new C3ApiException($data);
//    return $data;
  }

  /**
   * @param $clientId
   * @param $action
   * @param array $params
   * @return string
   */
  public function buildRequestUrl($clientId, $action, array $params = []): string
  {

    $query = [
      'key' => $this->key,
      'sourceApp' => $this->sourceApp,
      'client' => $clientId,
      'action' => $action
    ];

    if (!empty($params)) {
      $query = array_merge($query, $params);
    }

    return self::API_URL . "?" . http_build_query($query);
  }

  /**
   * @param $contents
   * @return string
   */
  public function handleJsonErrors($contents)
  {
    $contents = str_replace(': 0', ':0', $contents); // ideally need to check for ': 0' in addition to ':0'

    while (strpos($contents, ':0') !== false) {
      $positionA = strpos($contents, ':0');
      $positionB = strpos ($contents , ',', $positionA);

      if ($positionB <= $positionA) {
        $positionB = strpos ($contents , '}', $positionA);
      }

      $contents = substr_replace($contents, '"', $positionA + 1, 0);
      $contents = substr_replace($contents, '"', $positionB + 1, 0);
    }
    return $contents;
  }

}