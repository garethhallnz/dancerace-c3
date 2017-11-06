<?php
declare(strict_types=1);

namespace C3;

/**
 * Class Documents.
 *
 * @package C3
 */
class C3Client
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

  /**
   * Get Client Balance.
   *
   * @param string $clientId
   *  Method which takes client ID and returns customer balance
   *
   * @return string
   */
  public function getClientBalance($clientId) //: \stdClass
  {
    return $this->request($clientId, 'getClientBal');
  }

  /**
   * Get Client Details.
   *
   * @param string $clientId
   *  Method which takes client ID and returns customer balance
   *
   * @return string
   */
  public function getClientDetails($clientId) //: \stdClass
  {
    return $this->request($clientId, 'getClientDtl');
  }

  /**
   * Get Client Collections.
   *
   * @param string $clientId
   * @param string $view
   * @param string $year
   * @param string $month
   *  Method which takes client ID and returns customer balance
   *
   * @return string
   */
  public function getClientCollections($clientId, $view = '1', $year = '0', $month = '0') //: \stdClass
  {
    $params = [
      'view' => $view,
      'year' => $year,
      'month' => $month
    ];

    return $this->request($clientId, 'getColDtls', $params);
  }

  /**
   * Get Client Account.
   *
   * @param string $clientId
   * @param string $year
   * @param string $month
   *  Method which takes client ID and returns customer balance
   *
   * @return string
   */
  public function getClientAccount($clientId, $year = '0', $month = '0') //: \stdClass
  {
    $params = [
      'year' => $year,
      'month' => $month
    ];

    return $this->request($clientId, 'getClientAcct', $params);

  }

  /**
   * @param $action
   * @param array $params
   * @return string
   */
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
  public function request($clientId, $action, $params = [])
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
  public function buildRequestUrl($clientId, $action, $params = []): string
  {
    $query = $this->stringifyParams($params);
    return self::API_URL . "?key={$this->key}&sourceApp={$this->sourceApp}&action={$action}&client={$clientId}{$query}";
  }

  /**
   * @param $params
   * @return string
   */
  public function stringifyParams($params)
  {
    $string = '';

    if(!empty($params)) {
      foreach ($params as $key => $param) {
        $string .= "&{$key}={$param}";
      }
    }

    return $string;
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
