<?php

namespace asaas\api\Traits;

use GuzzleHttp\Client;

trait Cliente
{
    protected $access_token;
    
    /**
     * Cria um novo cliente no Asaas.
     * @param Array $cliente
     * @return Boolean
     */
    public function create($cliente)
    {
        // Define os headers da requisição
        $headers = array(
            'headers' => array(
                'Content-Type' => 'application/json',
                'access_token' => $this->access_token
            )
        );
        
        // Cria um cliente guzzle
        $client = Client( $headers );
        
        // Faz o post
        $response = $client->request('POST', 'https://www.asaas.com/api/v3/customers', ['form_params' => $cliente]);
        
        // Retorna a resposta
        return [
            'code'     => $response->getStatusCode(),
            'response' => $response->getBody()
        ];
        
    }
}