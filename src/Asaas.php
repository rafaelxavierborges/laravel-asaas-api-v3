<?php

namespace asaas\api;

use asaas\api\Traits\Cliente;

class Asaas {
    
    use Cliente;
    
    public function __construct($access_token) {
        $this->access_token = $access_token;
    }
}