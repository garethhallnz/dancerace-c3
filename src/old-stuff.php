<?php
//index.php
//$client = new \GuzzleHttp\Client();

//$request = $client->request('GET', 'https://lock-x1-c3api.c3exec.com/service/c3api?key=E534912C0A594207C06504294863B7AE&sourceApp=101&action=getClientDtl&client=0344');

//$data = json_decode($request->getBody());

//var_dump($request->getBody());




//C3Client.php
//    $params = [
//      'client' => $clientId,
//    ];
//    $action = 'getClientBal';
//
//    $data = $this->request($clientId, $action, $params);
//
//    return $data;

//    $params = [
//      'client' => $clientId,
//    ];
//    $action = 'getClientDtl';
//
//    $data = $this->request($action, $params);
//
//    return $data->ClientDtl;

//    $params = [
//      'client' => $clientId,
//      'view' => $view,
//      'month' => $month,
//      'year' => $year
//    ];
//    $action = 'getColDtls';
//    $data = $this->request($action, $params);
//    return $data->getColDtls;

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




