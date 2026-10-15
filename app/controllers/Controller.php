<?php

namespace Core;

/**
 * Esta clase es la madre de todos los controladores. La idea es que los métodos y atributos 
 * de aquí son para generalizarlos a todos los controladores. 
 *
 * @author Joseph Figueroa
 * @version 1.0
 */
class Controller
{

    /**
     *  Este método es el enlace del controlador y las vistas. Primero carga los  
     *  datos y arranca la vista. 
     *
     *  @param 
     *  string $viewName Nombre de la vista
     *  array $data Los datos que van a aparecer en la vista.
     *  @return void
     *
     */
    protected function view(string $viewName, array $data = []): void
    {
        extract($data);

        $viewFile = BASE_PATH . "app/views/{$viewName}.php";

        if (file_exists($viewFile)) {
            require_once $viewFile;
        } else {
            http_response_code(500);
            die("La vista no existe: {$viewFile}");
        }
    }
    
    /**
    * Esto es para buscar errores. Muestra lo que almacena el parametro de la misma
    *
    * @param mixed ...$args
    */
    protected function dd(...$args)
    {
    	echo '<pre style="font-size: 1.2em; background-color: black; color: white; padding: 15px">';
    	var_dump(...$args);
    	echo '</pre>';
    	die();
    }
}

