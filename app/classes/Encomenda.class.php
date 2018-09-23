<?php

class Encomenda
{
    private $idEncomenda;
    private $idCliente;
    private $idBolo;
    private $pesoBolo;
    private $enderecoEntrega;
    private $dataEntrega;

    function getIdEncomenda(){
        return $this->idEncomenda;
    }

    function setIdEncomenda( $idEncomenda ){
        $this->idEncomenda = $idEncomenda;
    }

    function getIdCliente(){
        return $this->idCliente;
    }

    function setIdCliente( $idCliente ) {
        $this->idCliente = $idCliente;
    }

    function getIdBolo() {
        return $this->idBolo;
    }

    function setIdBolo( $idBolo ) {
        $this->idBolo = $idBolo;
    }

    function getPesoBolo() {
        return $this->pesoBolo;
    }

    function setPesoBolo( $pesoBolo ) {
        $this->pesoBolo = $pesoBolo;
    }

    function getEnderecoEntrega() {
        return $this->enderecoEntrega;
    }

    function setEnderecoEntrega( $enderecoEntrega ){
        $this->enderecoEntrega = $enderecoEntrega;
    }

    function getDataEntrega(){
        return $this->dataEntrega;
    }

    function setDataEntrega( $dataEntrega ){
        $this->dataEntrega = $dataEntrega;
    }
}