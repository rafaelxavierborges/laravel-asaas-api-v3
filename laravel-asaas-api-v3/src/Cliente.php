<?php

namespace Asaas\Api;

use Asaas\Api\Connection;
use Asaas\Api\Exceptions\ClienteException;
use Exception;

class Cliente
{
    
    public $http;
    protected $cliente;
    
    public function __construct()
    {
        $this->http = new Connection;
    }
    
    /**
     * Retorna array de clientes.
     * @return array
     */
    public function index()
    {
        return $this->http->get('/customers');
    }
    
    
    /**
     * Cria um novo cliente no Asaas.
     * @param Array $cliente
     * @return Boolean
     */
    public function create($cliente)
    {
        // Preenche as informações do cliente
        $cliente = $this->setCliente($cliente);
        
        // Faz o post e retorna array de resposta
        return $this->http->post('/customers', ['form_params' => $cliente]);
        
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
            
            $this->cliente = array_merge($this->cliente, $cliente);
            return $this->cliente;
            
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