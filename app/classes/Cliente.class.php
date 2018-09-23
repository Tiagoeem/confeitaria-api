<?php

namespace app\classes;

class Cliente
{
    #Campos obrigatórios
    private $nome;
    private $cpf;
    private $contato;
    #Campos opcionais
    private $endereco;
    private $email;

    function getNome() {
        return $this->nome;
    }

    function setNome( $nome ) {
        $this->nome = $nome;
    }

    function getCPF() {
        return $this->cpf;
    }

    function setCPF( $cpf ) {
        if ( $this->verificarCPF( $cpf ) ) {
            $this->cpf = $cpf;
        } else {
            #pensar em um gerenciador de erro
        }
    }

    function getContato() {
        return $this->contato;
    }

    function setContato( $contato ) {
        $this->contato = $contato;
    }

    function getEndereco() {
        return $this->endereco;
    }

    function setEndereco( $Endereco ) {
        $this->endereco = $Endereco;
    }

    function getEmail() {
        return $this->email;
    }

    function setEmail( $email ) {
        $this->email = $email;
    }

    # Método retirado do link: https://www.geradorcpf.com/script-validar-cpf-php.htm 
    function validaCPF($cpf = null) {

        # Verifica se um número foi informado
        if(empty($cpf)) {
            return false;
        }
    
        # Elimina possivel mascara
        $cpf = preg_replace("/[^0-9]/", "", $cpf);
        $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);
        
        # Verifica se o numero de digitos informados é igual a 11 
        if (strlen($cpf) != 11) {
            return false;
        }
        # Verifica se nenhuma das sequências invalidas abaixo 
        # foi digitada. Caso afirmativo, retorna falso
        else if ($cpf == '00000000000' ||
            $cpf == '11111111111' ||
            $cpf == '22222222222' ||
            $cpf == '33333333333' ||
            $cpf == '44444444444' ||
            $cpf == '55555555555' ||
            $cpf == '66666666666' ||
            $cpf == '77777777777' ||
            $cpf == '88888888888' ||
            $cpf == '99999999999') {
            return false;
        # Calcula os digitos verificadores para verificar se o
        # CPF é válido
        } 
        else
        {
            for ($t = 9; $t < 11; $t++) {

                for ($d = 0, $c = 0; $c < $t; $c++) {
                    $d += $cpf{$c} * (($t + 1) - $c);
                }
                $d = ((10 * $d) % 11) % 10;
                if ($cpf{$c} != $d) {
                    return false;
                }
            }
            return true;
        }
    }

    function __toString() {
        return json_encode( array( 'nome' => $this->nome,
                        'cpf' => $this->nome,
                        'contato' => $this->contato,
                        'endereco' => $this->endereco,
                        'email' => $this->email) );
    }
}