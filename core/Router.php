<?php

namespace Core;

/**
 * Esta clase está creada para almacenar y poder "ejecutar" la página solicitada 
 * por el usuario en el buscador del navegador web. 
 *
 * @author Joseph Figueroa
 * @version 1.0
 */
class Router {
	private array $routes = [];

    /**
     * Este método se usa para almacenar rutas que tienen una petición GET.
     *
     * @example 
     * $router->get('/', [HomeController::class, 'index']);
     *
     *  @param string $uri Ruta que quieres almacenar
     *  @return void
     *
     */
	public function get( string $uri, array $controllerAction ) : void 
	{
	    $this->routes['GET'][$uri] = $controllerAction;
    }

    /**
     * Este método se usa para almacenar rutas que tienen una petición POST.
     *
     * @example
     * $router->post('/form', [CotizacionesController::class, 'guardar']);
     *
     * @param
     *  string $uri Ruta que quieres almacenar
     *  array $controllerAction un dict que la clave es la ruta y la accion esta asociado a la clase. [HomeController::class, 'guardar']
     *
     *  @return void
     */
    public function post( string $uri, array $controllerAction ) : void
    {
        $this->routes['POST'][$uri] = $controllerAction;
    }

    /**
     * Este método es para observar el buscador del navegador web del usuario para
     *  buscar el controlador y la acción esperada a la ruta que colocó el usuario. 
     *
     * @example
     * $router->resolve();
     *
     * @param none
     * @return void
     *
     */
	public function resolve() : void
	{
		$method = $_SERVER['REQUEST_METHOD'];
		$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

		if (isset($this->routes[$method][$uri])) {
			[$controller, $action] = $this->routes[$method][$uri];
			if (class_exists($controller)) {
				$controllerInstance = new $controller();
				if ( method_exists($controllerInstance, $action)) {
					$controllerInstance->$action();
					return;
				}

			}
		
		}
		$this.sendNotFound();	
	}

    /**
     * Este método se ejecuta en el método de "resolve()" cuando el usuario solicita una ruta 
     * que no está en el array de esta clase y si la acción no existe en los controladores. 
     *
     *  @param none
     *  @return void
     */
	private function sendNotFound(): void
    	{
        	http_response_code(404);
        	echo '404 - Página no encontrada';
    	}


}
