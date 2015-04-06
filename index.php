<?php

namespace JoeBengalen\Config;

require_once 'vendor'.DIRECTORY_SEPARATOR.'autoload.php';

$config = new Config();
$config->load(__DIR__.DIRECTORY_SEPARATOR.'config.php');

$config->set([
    'database.host' => '127.0.0.1',
    'database.user' => 'root',
]);

$config->set([
    'key1' => [
        'key2.key3' => 'value',
    ],
]);

$config->get('database');
$config->get('key1.key2');

// has should return true of a value of null is set!
$config->has('database');
$config->has('key1.key2');
$config->has('nothing');

$config->remove('database');
$config->remove('key1.key2');

var_dump($config['database']);
var_dump($config['key1.key2']);

var_dump(isset($config['database']));
var_dump(isset($config['key1.key2']));

unset($config['database']);
unset($config['key1.key2']);
