<?php

require 'bootstrap.php';

$document = new \Emid\CouchDB\Document(['_id' => 'product-1']);
$document = $service->findDocument($document);

$attachment = '/var/www/example.jpg';

$response = $service->saveAttachment($document, $attachment);

print_r($response);