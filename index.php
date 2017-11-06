<?php

use \C3\C3Client;
use GuzzleHttp\Client;

require 'vendor/autoload.php';

$c3Client = new C3Client('E534912C0A594207C06504294863B7AE', '101', new Client());

$clientId = '0345';

//$data = $c3Client->getClientBalance($clientId); // works with fix

//$data = $c3Client->getClientDetails($clientId);

//$data = $c3Client->getClientCollections($clientId,1, 0, 0); // appears to work with fix but no client details

$data = $c3Client->getClientAccount($clientId, 2017, 1);

var_dump($data);

