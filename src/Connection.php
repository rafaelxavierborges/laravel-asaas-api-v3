<?php

namespace Asaas\Api;

use GuzzleHttp\Client;

class Connection {
    
    public $http;
    public $api_key;
    public $base_url;
    
    public function __construct() {
        $this->api_token = config('asaas.api_key');
        
        $this->http = new Client([
            'headers' => [
                'Content-Type' => 'application/json',
                'access_token' => $this->api_key
            ]
        ]);
        
        return $this->http;
    }
    
    public function get($url)
    {
        $response = $this->http->get($this->base_url . $url);
        $result = $response->getBody()->getContents();
        return json_decode( $result );
    }
    
    public function post($url, $params)
    {
        // Faz a requisição
        $response = $this->http->post($this->base_url . $url, $params);

        // Retorna a resposta
        return [
            'code'     => $response->getStatusCode(),
            'response' => $response->getBody()
        ];
    }
    
}