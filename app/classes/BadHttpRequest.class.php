<?php

namespace app\classes;

class BadHttpRequest extends \Exception
{
    public function errorMessage() {
        $errorMsg = 'Erro ao parsear o JSON de entrada.';
        return $errorMsg;
    }
}