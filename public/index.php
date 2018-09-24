<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \app\controller\ControladorApp;
use \app\classes\Cliente;
use \app\model\BoloDAOImplementation as BoloDAO;

require_once 'config.php';

mb_internal_encoding('UTF-8');
mb_http_output('UTF-8');


$app = new \Slim\App;

# Desabilita tratamento automatico de exceção do Slim, as execeções são tratados
# pela aplicação no controller (ControllerApp), em que os HTTP status code são configurados
# corretamente para resposta.
$c = $app->getContainer();
unset($c['phpErrorHandler']);



# ROTAS
$app->group('/v1',function ( ) {

    $this->post('/bolo', function (Request $request, Response $response, array $args) {
        $controlador = new ControladorApp();
        return $controlador->cadastrarBolo($request, $response, $args);
    });

    $this->get('/bolo', function (Request $request, Response $response, array $args) {
        $controlador = new ControladorApp();
        return $controlador->lerTodosBolos($request, $response, $args);
    });

    $this->get('/bolo/{idBolo}', function (Request $request, Response $response, array $args) {
        $controlador = new ControladorApp();
        return $controlador->lerBolo($request, $response, $args);
    });
    
    $this->delete('/bolo/{idBolo}', function (Request $request, Response $response, array $args) {
        $controlador = new ControladorApp();
        return $controlador->deletarBolo($request, $response, $args);
    });

    $this->put('/bolo/{idBolo}', function (Request $request, Response $response, array $args) {
        $controlador = new ControladorApp();
        return $controlador->updateBolo($request, $response, $args);
    });


    $this->get('/hello/{name}', function (Request $request, Response $response, array $args) {
    
        #$boloDAO = new BoloDAO();
        #$bolo = $boloDAO->getBoloById(1);
        #var_dump($bolo);
        
        
        #$response->write( $cliente );
    
        return $response->write($args["name"])->withStatus(201);
    });

});

# Criando uma função especifica para o Erro 404 "not found". Por padrão é enviado um
# html com um texto padrão. Por se tratar de uma API, irei devolver apenas o status code
# 404 sem nenhum corpo na mensagem
$c['notFoundHandler'] = function ($c) {
    return function ($request, $response) use ($c) {
        return $response->withStatus(404);
    };
};

$app->run();