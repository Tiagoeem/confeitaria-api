<?php

namespace app\classes;

class Bolo implements \JsonSerializable
{
    private $idBolo;
    private $nome;
    private $sabor;
    private $cobertura;
    private $descricao;

    function __construct( $argsDB = null )
    {
        if ( !is_null($argsDB) ) {
            $this->idBolo = (isset($argsDB["id_bolo"])) ? $argsDB["id_bolo"] : null ;
            $this->nome = $argsDB["nome"];
            $this->sabor = $argsDB["sabor"];
            $this->cobertura = $argsDB["cobertura"];
            $this->descricao = $argsDB["descricao"];
        }
    }

    public function getIdBolo() {
        return $this->idBolo;
    }

    public function setIdBolo( $idBolo ) {
        $this->idBolo = $idBolo;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome( $nome ) {
        $this->nome = $nome;
    }

    public function getSabor() {
        return $this->sabor;
    }

    public function setSabor( $sabor ) {
        $this->sabor = $sabor;
    }

    public function getCobertura() {
        return $this->cobertura;
    }

    public function setCobertura( $cobertura ) {
        $this->cobertura = $cobertura;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function setDescricao( $descricao ) {
        $this->descricao = $descricao;
    }

    function __toString() {
        return json_encode( array( 'idbolo' => $this->idBolo,
                        'nome' => $this->nome,
                        'sabor' => $this->sabor,
                        'cobertura' => $this->cobertura,
                        'descricao' => $this->descricao));
    }

    # Esse método é executado automaticamente quando o objeto da Classe é passado como parametro na
    # função json_encode
    public function jsonSerialize()
    {
        return array( 'idbolo' => $this->idBolo,
                        'nome' => $this->nome,
                        'sabor' => $this->sabor,
                        'cobertura' => $this->cobertura,
                        'descricao' => $this->descricao);
    }


}