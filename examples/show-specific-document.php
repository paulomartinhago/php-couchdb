<?php

require 'bootstrap.php';

$document = new \Emid\CouchDB\Document(['_id' => 'product-1']);
$document = $service->findDocument($document);

print_r($document);