# Virtualizor API Wrapper [![Build Status](https://travis-ci.org/bennetgallein/VirtualizorPHP.svg?branch=master)](https://travis-ci.org/bennetgallein/VirtualizorPHP)
This is a wrapper for the API for Virtualizor. 
### That Base-client is Forked from https://github.com/bennetgallein/VirtualizorPHP.
Code Complete Recoded.
Documentation for this Version of the API can be found here:
http://virtualizor.com/admin-api/#virtual-servers . Own Documentation will follow.

## Installation
Install this library via composer is pretty easy. 
```
composer require cookiemc337/virtualizor-php-lib
```
And then you can get started with your project.

## Object Description:

Every call starts by Initializing the `Virtualizor` Object. Once initialized you can use it over and over again.
```php
$virt = new \Virtualizor\Virtualizor("ip", "key", "pass", "port");
```

### ServerInfo

Get some information about the master
```php
$info = $virt->serverInfo();
```

