<?php
declare(strict_types=1);

namespace C3;

/**
 * Class C3Client.
 *
 * @package C3
 */
class C3Client extends C3
{
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
    return $this->getRequest($clientId, 'getClientBal');
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
    return $this->getRequest($clientId, 'getClientDtl');
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

    return $this->getRequest($clientId, 'getColDtls', $params);
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

    return $this->getRequest($clientId, 'getClientAcct', $params);

  }
}
