<?php

require 'bootstrap.php';

$fields = [
    '_id'     => 'product-1',
    'schema'  => 'products',
    'label'   => 'Product 1',
    'descriptions' => [
        [
            'label' => 'The standard chunk of Lorem Ipsum',
            'text'  => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo ad quod totam magnam iste aliquid, nulla optio nisi officia eaque, voluptatem debitis exercitationem in fugiat corporis amet quam alias excepturi.'
        ],
        [
            'label' => 'The standard chunk of Lorem Ipsum',
            'text'  => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo ad quod totam magnam iste aliquid, nulla optio nisi officia eaque, voluptatem debitis exercitationem in fugiat corporis amet quam alias excepturi.'
        ],
        [
            'label' => 'The standard chunk of Lorem Ipsum',
            'text'  => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo ad quod totam magnam iste aliquid, nulla optio nisi officia eaque, voluptatem debitis exercitationem in fugiat corporis amet quam alias excepturi.'
        ]
    ]
];

$document = new \Emid\CouchDB\Document($fields);
$document = $service->saveDocument($document);

print_r($document);