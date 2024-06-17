<?php
require 'vendor/autoload.php'; // Ensure Composer's autoload is included

use \Elasticsearch\ClientBuilder;

$client = ClientBuilder::create()->build();

// Example data to index
$params = [
    'index' => 'my_index',
    'id'    => 'my_id',
    'body'  => [
        'testField' => 'abc'
    ]
];

// Index the data
$response = $client->index($params);
print_r($response);

// Search the data
$params = [
    'index' => 'my_index',
    'body'  => [
        'query' => [
            'match' => [
                'testField' => 'abc'
            ]
        ]
    ]
];

$response = $client->search($params);
print_r($response);
?>
