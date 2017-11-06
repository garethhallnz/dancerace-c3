<?php

namespace C3;

use \Exception;
use Psr\Http\Message\ResponseInterface;

/**
 * Custom C3 API exception.
 *
 * @package PandaDoc
 */
class C3ApiException extends Exception
{

  /**
   * @inheritdoc
   */
  public function __construct($data)
  {
    $message = $data->MSGID . ': ' . $data->MSG;

    parent::__construct($message);
  }
}