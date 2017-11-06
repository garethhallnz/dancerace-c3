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
  /**
   * API url.
   *
   * @var string
   */
  protected $endpoint = 'https://lock-x1-c3api.c3exec.com/service/c3api';

  /**
   * Key.
   *
   * @var string
   */
  protected $key;

  /**
   * Client ID.
   *
   * @var string
   */
  protected $clientId;

  /**
   * SourceApp.
   *
   * @var string
   */
  protected $sourceApp;

  /**
   * Guzzle client.
   *
   * @var C3Client
   */
  protected $client;

  /**
   * Makes a request to the C3 API.
   *
   * @param $method
   * @param $action
   * @return mixed
   */
  public function request(string $method, string $action) //: \stdClass //array $options = []
  {
//    if (!empty($options['query'])) {
//      $options['query'] = http_build_query(['query']);
//    }
    $query = 'key=E534912C0A594207C06504294863B7AE&sourceApp=101&action=getClientDtl&client=0344';

    return $this->handleRequest($method, $this->endpoint . $query);
  }

  /**
   * Makes a request to the C3 API using the Guzzle HTTP client.
   *
   * @param $method
   * @param string $uri
   * @return mixed
   * @throws C3ApiException
   *
   * @see PandaDoc::request()
   */
  public function handleRequest(string $method, string $uri): \stdClass
  {
    try {
      $response = $this->client->request($method, $uri);
      $data = $response->getBody();
      return json_decode($data->getContents());
    } catch (RequestException $e) {
      $response = $e->getResponse();

      throw new C3ApiException($response, $e);
    }
  }
}