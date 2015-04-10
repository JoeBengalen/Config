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

// get() returns null if not found, so you are able to use a default:
var_dump($config->get('none.existing') ?: 'default value');
