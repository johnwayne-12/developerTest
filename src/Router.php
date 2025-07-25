<?php

class Router {
    private $method;
    private $uri;

    public function __construct($method, $uri) {
        $this->method = $method;
        $this->uri = parse_url($uri, PHP_URL_PATH);
    }

    public function route() {
        if ($this->method === 'GET' && $this->uri === '/clubes') {
            ClubeController::listar();
        } elseif ($this->method === 'POST' && $this->uri === '/clubes') {
            ClubeController::cadastrar();
        } elseif ($this->method === 'POST' && $this->uri === '/consumir') {
            RecursoController::consumir();
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Rota não encontrada.']);
        }
    }
}