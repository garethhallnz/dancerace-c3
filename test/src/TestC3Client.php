<?php
declare(strict_types=1);

namespace C3\Tests;

use C3\C3;
use C3\C3Client;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use Eris\Generator;
use Eris\TestTrait;

/**
 * Class C3Client.
 *
 * @package C3
 */
class TestC3Client extends C3
{
//  function __construct($key, $sourceApp, $guzzleClient)
//  {
//    parent::__construct($key, $sourceApp, $guzzleClient);
//
////    $testCase = new TestCase();
//

//  }

  public function setUp($key, $sourceApp, $guzzleClient) {
    $this->key = $key;

    $this->sourceApp = $sourceApp;

    $this->guzzleClient = $guzzleClient;
  }

  public function testBuildUrl($action) {
    $clientId = '0344';

    $key = 'E534912C0A594207C06504294863B7AE';

    $sourceApp = '101';

    $view = '0';

    $year = '2017';

    $month = '1';

    $params = [
      'view' => $view,
      'year' => $year,
      'month' => $month
    ];

    $string = '';
    if (!empty($params['view'])) $string .= "&view={$params['view']}";
    if (!empty($params['year'])) $string .= "&year={$params['year']}";
    if (!empty($params['month'])) $string .= "&month={$params['month']}";

    $url = $this->buildRequestUrl($clientId, $action, $params);

    echo '<br>.' . static::API_URL . "?key={$key}&sourceApp={$sourceApp}&client={$clientId}&action={$action}" . $string;
    echo '<br>.' . $url;

//    $c3Client = new C3('E534912C0A594207C06504294863B7AE', '101', new Client());
//    TestCase::assertEquals(static::API_URL . "?key={$key}&sourceApp={$sourceApp}&client={$clientId}&action={$action}", $url);
  }
// "hello world", "hello world"


//  /**
//   * Test Url builder.
//   */
//  public function testUrlBuilder() {
//
////    $service = new FacebookFlushCacheService($this->httpClientMock, $this->loggerMock);
//
//    $generator = Generator\regex("[a-zA-Z0-9 #?+&_()*,;=@!$\/~.-]");
//
//    $this->forAll($generator)->then(function ($string) use ($service) {
//
//      $url = $service->buildUrl($string);
//
//      $string = urlencode($string);
//
//      $testCase->assertEquals(static::API_URL . "?key={$key}&sourceApp={$sourceApp}&action={$action}&client={$clientId}", $url);
//
//    });
//
//  }
}



//public function testAddQuotes() {
//
//}

// test 1 and '1'