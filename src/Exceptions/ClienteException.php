<?php

namespace asaas\api\Exceptions;

class ClienteException {

    public static function invalidClient()
    {
        return new static('Os dados fornecidos para o cadastro do cliente não são válidos. Tipo: Array | Keys: "name", "cpfCnpj" e "email".');
    }
}
