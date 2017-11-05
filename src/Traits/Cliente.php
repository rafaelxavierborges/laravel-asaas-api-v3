<?php

namespace asaas\api\Traits;

use GuzzleHttp\Client;
use assas\api\Exceptions\ClienteException;
use Exception;

trait Cliente
{
    protected $access_token;
    
    protected $cliente;
    
    /**
     * Cria um novo cliente no Asaas.
     * @param Array $cliente
     * @return Boolean
     */
    public function create($cliente)
    {
        // Cria o array cliente (merge)
        $cliente = $this->setCliente( $cliente );
        
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
    
    /**
     * Faz merge nas informações do cliente.
     * 
     * @see https://asaasv3.docs.apiary.io/#reference/0/clientes/criar-novo-cliente
     * @param Array $cliente
     * @return Array
     */
    public function setCliente($cliente)
    {
        try {
            
            if ( ! $this->cliente_valid($cliente) ) {
                throw ClienteException::invalidClient();
            }
            
            $this->cliente = array(
                'name'                 => '',
                'cpfCnpj'              => '',
                'email'                => '',
                'phone'                => '',
                'mobilePhone'          => '',
                'address'              => '',
                'addressNumber'        => '',
                'complement'           => '',
                'province'             => '',
                'postalCode'           => '',
                'externalReference'    => '',
                'notificationDisabled' => '',
                'additionalEmails'     => ''
            );
            
            $this->cliente = array_merge($cliente);
            
        } catch (Exception $e) {
            return 'Erro ao definir o cliente. - ' . $e->getMessage();
        }
    }
    
    /**
     * Verifica se os dados do cliente são válidos.
     * 
     * @param array $cliente
     * @return Boolean
     */
    public function cliente_valid($cliente)
    {
        return ! ( empty($cliente['name']) OR empty($cliente['cpfCnpj']) OR empty($cliente['email']) );
    }
}