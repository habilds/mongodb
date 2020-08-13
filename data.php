<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');

if ($_SERVER['REQUEST_METHOD'] !== 'GET' && $_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);

    echo json_encode(
        array('message' => 'Method not allowed.')
    );
}

include 'vendor/autoload.php';

/*$linfo = new \Linfo\Linfo;
$parser = $linfo->getParser();*/

$client = new \MongoDB\Client(
    'mongodb://localhost:27017'
);

$db = $client->dataCPU;

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $cursor = $db->data->find([]);

    $data = [];

    foreach ($cursor as $cur) {
        array_push($data, $cur);
    }

    http_response_code(200);

    echo json_encode(
        $data
    );
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $insertOneResult = $db->data->insertOne([
        'namacpu' => 'Windows',
        'tipe'=> 'Windows',
        'platform' => 'win32',
        'rilis' => '10',
        'ramSisa' => 1002302,
        'ramTotal' => 2002032
    ]);

    http_response_code(201);

    echo json_encode(
        array('message' => 'Data ditambahkan.')
    );
}
