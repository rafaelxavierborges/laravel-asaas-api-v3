<?php

namespace asaas\api;

use asaas\api\Traits\Cliente;
use assas\api\Exceptions\AccessTokenException;

class Asaas {
    
    use Cliente;
    
    public function __construct($access_token) {
        
        $this->setToken( $access_token );
        
    }
    
    public function setToken( $access_token )
    {
        $valid_token = $this->verify_token( $access_token );
        
        if ( ! $valid_token  ) {
            throw AccessTokenException::invalidToken();
        }
        
        $this->access_token = $access_token;
        
        return $valid_token;
    }
    
    public function verify_token( $access_token )
    {
        return $true;
    }
}