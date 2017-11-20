<?php

namespace Asaas\Api;

use Asaas\Api\Assinatura;
use Asaas\Api\Cliente;
use Asaas\Api\Cobranca;
use Asaas\Api\Notificacao;
use Asaas\Api\Webhook;

class Asaas {
    
    public $assinatura;
    public $cliente;
    public $cobranca;
    public $notificacao;
    public $webhook;
    
    public function __construct() {
        $this->assinatura  = new Assinatura;
        $this->cliente     = new Cliente;
        $this->cobranca    = new Cobranca;
        $this->notificacao = new Notificacao;
        $this->webhook     = new Webhook;
    }
}