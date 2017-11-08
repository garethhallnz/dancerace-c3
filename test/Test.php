<?php

namespace C3\Tests;

use C3\C3;
use C3\C3Client;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use Eris\Generator;
use Eris\TestTrait;

/**
 * Class C3ClientTest
 * @test Get Client Balance
 * @package C3\Tests
 */
class GetClientBalanceTest extends C3
{
  protected $c3Client;

  protected $clientId;

  public function __construct($c3Client, $clientId)
  {
    $this->c3Client = $c3Client;

    $this->clientId = $clientId;
  }

  public function testBuildUrl() {
    public $url = $this->buildRequestUrl('', '', []);

    $c3Client = new C3('E534912C0A594207C06504294863B7AE', '101', new Client());

    return $this->assertEquals(static:API_URL . "{$service->facebookUrl}/?id={$string}&scrape=true", $url);
  }

  /**
   * Test Url builder.
   */
  public function testUrlBuilder() {

//    $service = new FacebookFlushCacheService($this->httpClientMock, $this->loggerMock);

    $generator = Generator\regex("[a-zA-Z0-9 #?+&_()*,;=@!$\/~.-]");

    $url = $this->buildRequestUrl('', '', []);

    TestCase::assertEquals(static:API_URL . "?key={$key}&sourceApp={$sourceApp}&action={$action}&client={$clientId}", $url);
  }
}


// test build url and add quotes