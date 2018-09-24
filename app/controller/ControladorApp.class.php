<?php

namespace app\controller;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use app\model\BoloDAOImplementation as BoloDAO;
use app\classes\BadHttpRequest;
use app\classes\Bolo;

class ControladorApp
{

    public function lerTodosBolos( Request $request, Response $response, array $args )
    {
        $status = 200;

        try {
            $dao = new BoloDAO();
            $bolosArray = $dao->getAllBolos();

            $corpoResp =  json_encode( array( "bolos" =>$bolosArray ) );
            $response = $response->withHeader('Content-type', 'application/json')
                                 ->write( $corpoResp );
        } catch ( \PDOException $e ) {
            $status = 500;
            $response->write('Exceção capturada: '.  $e->getMessage(). '\n');
        } 
        return $response->withStatus($status);
    }

    public function lerBolo( Request $request, Response $response, array $args )
    {
        $status = 200;

        try {
            # Verifica o argumento que vem via URL
            if ( isset( $args["idBolo"]) ) {
                if ( !is_numeric( $args["idBolo"] ) )
                    throw new BadHttpRequest();
            } else { 
                throw new BadHttpRequest();
            }

            $dao = new BoloDAO();
            $bolo = $dao->getBoloById( $args["idBolo"] );

            $status = ( !is_null( $bolo ) ) ? 200 : 204; 

            $corpoResp =  json_encode( $bolo );
            $response = $response->withHeader('Content-type', 'application/json')
                                 ->write( $corpoResp );
        } catch (BadHttpRequest $e) {
            $status = 400;
            $response->write('Exceção capturada: '.  $e->getMessage(). '\n');
        } catch ( \PDOException $e ) {
            $status = 500;
            $response->write('Exceção capturada: '.  $e->getMessage(). '\n');
        } 
        return $response->withStatus($status);
    }

    public function deletarBolo( Request $request, Response $response, array $args )
    {
        $status = 200;

        try {
            # Verifica o argumento que vem via URL
            if ( isset( $args["idBolo"]) ) {
                if ( !is_numeric( $args["idBolo"] ) )
                    throw new BadHttpRequest();
            } else { 
                throw new BadHttpRequest();
            }

            $dao = new BoloDAO();
            # TRUE: Deletou a tupla com o id requisitado => 200
            # FALSE: Não existia nenhuma tupla com o id requisitado => 204
            $sucesso = $dao->deleteBoloById( $args["idBolo"] );
            $status = ( $sucesso ) ? 200 : 204;
        } catch (BadHttpRequest $e) {
            $status = 400;
            $response->write('Exceção capturada: '.  $e->getMessage(). '\n');
        } catch ( \PDOException $e ) {
            $status = 500;
            $response->write('Exceção capturada: '.  $e->getMessage(). '\n');
        } 
        return $response->withStatus($status);
    }

    public function cadastrarBolo( Request $request, Response $response, array $args )
    {

        $status = 201;
        try {
            # Verifica se os campos obrigatórios estão preenchidos
            if (!( isset( $objEntrada["nome"] ) &&
            isset( $objEntrada["sabor"] ) &&
            isset( $objEntrada["cobertura"])))
                throw new BadHttpRequest();

            # Verificar erro na entrada
            # Esperamos uma entrada Json da seguinte forma:
            # {"nome":"valor","sabor":"valor","cobertura":"valor","descricao":"valor"}
            $objEntrada = $request->getParsedBody();

            # getParsedBody, irá parsear o Json de entrada, caso ele falhe
            # pela entrada não ser um Json válido, esse if irá capturar
            if ( is_null($objEntrada) )
                throw new BadHttpRequest();

            # Descrição é opcional, então caso não tenha sido passada será substituida por ""
            $desc = (!\is_null($objEntrada["descricao"])) ? $objEntrada["descricao"] : "";

            $arrayBolo = array( "nome"=>$objEntrada["nome"],
                                "sabor"=>$objEntrada["sabor"],
                                "cobertura"=>$objEntrada["cobertura"],
                                "descricao"=> $desc);

            $boloInst = new Bolo($arrayBolo);
            $dao = new BoloDAO();
            $dao->createBolo( $boloInst );
        } catch (BadHttpRequest $e) {
            $status = 400;
            $response->write('Exceção capturada: '.  $e->getMessage(). '\n');
        } catch (\PDOException $e) {
            $status = 500;
            $response->write('Exceção capturada: '.  $e->getMessage(). '\n');
        }

        return $response->withStatus($status);
    }

    # Por simplificação será preciso enviar todos os valores e o update ocorrerá no objeto inteiro.
    public function updateBolo( Request $request, Response $response, array $args )
    {

        $status = 200;

        try {

            # Verifica o argumento que vem via URL
            if ( isset( $args["idBolo"]) ) {
                if ( !is_numeric( $args["idBolo"] ) )
                    throw new BadHttpRequest();
            } else { 
                throw new BadHttpRequest();
            }

            # Verificar erro na entrada
            # Esperamos uma entrada Json da seguinte forma:
            # {"nome":"valor","sabor":"valor","cobertura":"valor","descricao":"valor"}
            $objEntrada = $request->getParsedBody();            

            # getParsedBody, irá parsear o Json de entrada, caso ele falhe
            # pela entrada não ser um Json válido, esse if irá capturar
            if ( is_null($objEntrada) )
                throw new BadHttpRequest();

            # Verifica se os campos obrigatórios estão preenchidos
            if (!( isset( $objEntrada["nome"] ) &&
            isset( $objEntrada["sabor"] ) &&
            isset( $objEntrada["cobertura"])))
                throw new BadHttpRequest();

            # Descrição é opcional, então caso não tenha sido passada será substituida por ""
            $desc = (!\is_null($objEntrada["descricao"])) ? $objEntrada["descricao"] : "";

            $arrayBolo = array( "nome"=>$objEntrada["nome"],
                                "sabor"=>$objEntrada["sabor"],
                                "cobertura"=>$objEntrada["cobertura"],
                                "descricao"=> $desc);

            $boloInst = new Bolo($arrayBolo);
            $dao = new BoloDAO();
            $sucesso = $dao->updateBoloById( $args["idBolo"]  , $boloInst );
            $status = ( $sucesso ) ? 200 : 204;

        } catch (BadHttpRequest $e) {
            $status = 400;
            $response->write('Exceção capturada: '.  $e->getMessage(). '\n');
        } catch (\PDOException $e) {
            $status = 500;
            $response->write('Exceção capturada: '.  $e->getMessage(). '\n');
        }

        return $response->withStatus($status);
    }


}