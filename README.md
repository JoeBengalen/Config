# Config
[![Build Status](https://travis-ci.org/JoeBengalen/Config.svg?branch=master)](https://travis-ci.org/JoeBengalen/Config)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg)](LICENSE.md)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/e589a068-48fd-407d-9351-b6127acf7741/mini.png)](https://insight.sensiolabs.com/projects/e589a068-48fd-407d-9351-b6127acf7741)

Config library can be used to store configuration options, which can be used later in the application. The `set`, `get`, `has` and `remove` methods as well as `\ArrayAccess` can be used to control the configuration options. For easy usage dot notation is supported to access nested arrays.

The source code is very easy to understand and can be extended to support more functionality when needed.

## Installation

Via [Composer](https://getcomposer.org)

```bash
$ composer require joebengalen/config
```

## Usage

```php
<?php

require_once 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

// Instantiate the config object.
$config = new \JoeBengalen\Config\Config();

// Load a php config file info the config object.
$config->load(__DIR__ . DIRECTORY_SEPARATOR . 'config.php');

// Set some more configurations.
$config->set([
    'database.host' => '127.0.0.1',
    'database.user' => 'root',
]);

// Show an array of all database configurations
var_dump($config->get('database'));
```

## Testing

[PHPUnit](https://phpunit.de) is used for testing. The source code is 100% covered.

There is an `phpunit.xml.dist` file with some default settings for phpunit.

```bash
$ phpunit
```

**Note**: phpunit is not included. The command assumes phpunit is installed globally.
