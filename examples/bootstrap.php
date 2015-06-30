<?php

require __DIR__ . '/../vendor/autoload.php';

$client  = new \Emid\CouchDB\Client('http://localhost:5984', 'example');
$service = new \Emid\CouchDB\Service($client);