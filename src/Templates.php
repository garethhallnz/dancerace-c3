<?php
declare(strict_types=1);

namespace C3;

/**
 * Class Documents.
 *
 * @package PandaDoc
 */
class Templates extends C3Client
{
  // Test the 4 methods
  /**
   * Get client balance.
   *
   * @return \stdClass
   *
   * @see https://developers.pandadoc.com/v1/reference#list-templates
   */
  public function list(): \stdClass
  {
    return $this->getRequest('GET', self::RESOURCE);
  }

  /**
   * Get client details.
   *
   * @return \stdClass
   *
   * @see https://developers.pandadoc.com/v1/reference#list-templates
   */
  public function list(): \stdClass
  {
    return $this->getRequest('GET', self::RESOURCE);
  }

  /**
   * Get client collections.
   *
   * @return \stdClass
   *
   * @see https://developers.pandadoc.com/v1/reference#list-templates
   */
  public function list(): \stdClass
  {
    return $this->getRequest('GET', self::RESOURCE);
  }

  /**
   * Get client account.
   *
   * @return \stdClass
   *
   * @see https://developers.pandadoc.com/v1/reference#list-templates
   */
  public function list(): \stdClass
  {
    return $this->getRequest('GET', self::RESOURCE);
  }

  // ???
  /**
   * Template Details.
   *
   * @param string $id
   *
   * @return \stdClass
   *
   * @see https://developers.pandadoc.com/v1/reference#template-details
   */
  public function details(string $id): \stdClass
  {
    return $this->getRequest('GET', self::RESOURCE . "/{$id}/details");
  }
}
