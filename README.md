# PHP library for Dancerace C3's API

[![Build Status](https://travis-ci.org/garethhallnz/pandadoc.svg?branch=master)](https://travis-ci.org/garethhallnz)
[![License](https://poser.pugx.org/garethhallnz/pandadoc/license)](https://packagist.org/packages/garethhallnz/pandadoc)

This library provides convenient wrapper functions for Dancerace C3's REST API.

## Requirements

- PHP 7.0 or greater
- [Composer](https://getcomposer.org/)
- [Guzzle](https://github.com/guzzle/guzzle)

## Installation

Dependencies are managed by [Composer](https://getcomposer.org/). After
installing Composer, run the following command from the library root:

`composer install --no-dev --ignore-platform-reqs`

Or to install with phpunit:

`composer install`


## Usage Documents
```php
<?php
    require 'vendor/autoload.php';
    
    // security key (supplied at setup) eg:
    $key = 'E534912C0A594207C06504294863B7AE';
    
    // source application ID (supplied at setup) eg:
    $sourceApp = '101';
    
    // C3 Client ID eg:
    $clientId = '0344';
    
    $c3 = new C3($key, $clientId, $sourceApp);
    
    // Get the customer balance.
    // old method: $data = $c3->list();
    $data = $c3->getCustomerBalance();
    
    // Get the client balance.
    $data = $c3->getClientBalance();
    
    // Get the customer details.
    $data = $c3->getCustomerDetails();
    
    // Get the client details.
    $data = $c3->getClientDetails();
    
    // Get details of client collections for period.
    $data = $c3->getClientCollections();
    
    // Get details of client account (sim to above)
    $data = $c3->getClientAccount();
    
    
    
    
    
    
    
    
    // Search for a document.
    $filter = [
        'q' => 'Search string here'
    ];
    
    $data = $c3->list($filter);
    
    // Show document details.
    $data = $c3->details('documentID');
    
    // Show document state.
    $data = $c3->status('documentID');
    
    // Download a document
    $data = $c3->download('documentID', "destination-path");
```

## Usage Templates
```php
<?php
    require 'vendor/autoload.php';
    
    $token = 'my-token';
    
    $templates = new Templates($token);
    
    // List all the templates.
    $data = $templates->list();
    
    // Show template details.
    $data =$templates->details('templateID');
```