<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Exception;
use GuzzleHttp\Client;

class MahasiswaClient extends BaseController
{
    public function index()
    {
        $client = new Client([
            'base_uri' => 'http://localhost:9000',
            // default timeout 5 detik
            'timeout'  => 5,
        ]);

        $response = $client->request('GET', '/books');
        $body = $response->getBody();
        $body_array = json_decode($body);
        print_r($body_array);
    }

    public function show()
    {
        // var_dump($id);
        // die;
        $client = new Client([
            'base_uri' => 'http://localhost:9000',
            // default timeout 5 detik
            'timeout'  => 5,
        ]);

        $response = $client->request('GET', '/books', [
            'query' => [
                'id' => 2
            ]
        ]);
        $body = $response->getBody();
        $body_array = json_decode($body);
        print_r($body_array);
    }
}
