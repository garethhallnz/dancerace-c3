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
//    $params = [
//      'client' => $clientId,
//    ];
//    $action = 'getClientBal';
//
//    $data = $this->request($clientId, $action, $params);
//
//    return $data;

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
//    $params = [
//      'client' => $clientId,
//    ];
//    $action = 'getClientDtl';
//
//    $data = $this->request($action, $params);
//
//    return $data->ClientDtl;

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
//    $params = [
//      'client' => $clientId,
//      'view' => $view,
//      'month' => $month,
//      'year' => $year
//    ];
//    $action = 'getColDtls';
//    $data = $this->request($action, $params);
//    return $data->getColDtls;

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
//    $params = [
//      'client' => $clientId,
//      'month' => $month,
//      'year' => $year
//    ];
//    $action = 'getClientAcct';
//
//    $data = $this->request($action, $params);
//
//    return $data->getClientAcct;

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
    $url = self::API_URL . '?' . http_build_query($params);
    return $url; //'?key=E534912C0A594207C06504294863B7AE&sourceApp=101&action=getClientDtl&client=0344';
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

//    throw new C3ApiException($data);
    return $data;
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
//    var_dump(self::API_URL."?key={$this->key}&sourceApp={$this->sourceApp}&action={$action}&client={$clientId}{$query}");die;
    $url = self::API_URL . "?key={$this->key}&sourceApp={$this->sourceApp}&action={$action}&client={$clientId}{$query}";
    return $url;
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

//    var_dump($contents);die;
    return $contents;
  }
}





//  /**
//   * @param $action
//   * @param $params
//   * @return mixed
//   * @throws C3ApiException
//   */
//  public function xxrequest($action, $params)
//  {
//    $client = new Client();
//
//    $response = $client->request('GET', $this->getRequestUrl($action, $params));
//
//    $body = $response->getBody();
//    $data = json_decode($body->getContents());
//    return $data;
//    if (!empty($data->SUCCESS) && $data->SUCCESS == 1) {
//      return $data;
//    }
//    var_dump($data);die;
//    throw new C3ApiException($data);
//  }