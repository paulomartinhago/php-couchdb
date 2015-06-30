<?php

require 'bootstrap.php';

$document = new \Emid\CouchDB\Document(['_id' => 'product-1']);
$document = $service->deleteDocument($document);

print_r($document);