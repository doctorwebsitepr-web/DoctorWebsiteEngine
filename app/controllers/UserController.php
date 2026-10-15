<?php

namespace App\Controllers;

use Core\Controller;

require_once BASE_PATH . 'app/controllers/Controller.php';
require  BASE_PATH . 'app/models/UserModel.php';

/**
 * Esta clase representa el controlador de la página de "user"
 *
 * @author Joseph Figueroa
 * @version 1.0
 *
 */
class UserController extends Controller
{
   /**
    * La función antes de arrancar la página principal ('/user')
    *
    */
	public function index(): void
	{
		$datos = [
			'titulo' => "Bienvenido a Doctor Werbsite Cotizacion",
			'descripcion' => "Un formulario básico para probar el método POST."
		];

		$this->view('user', $datos);
    }
    
    /**
     * Este método espera un método POST para recibir los datos de un usuario con los siguientes datos: 
     * nombre, apellidos, username, email y password. Usa los métodos de los modelos para la comunicación 
     * con la base de datos. 
     *
     */
    public function guardar(): void
    {
        if( $_SERVER['REQUEST_METHOD'] === "POST" ) { 
            $errores = [];
            
            $obtenerTexto = static function (string $campo) : string {
                $valor = $_POST[$campo];
                return is_string($valor) ? trim($valor) : '';
            };
            $nombreUser = $obtenerTexto('nombre');
            $apellidoPaternoUser = $obtenerTexto('apellidoPaterno');
            $apellidoMaternoUser = $obtenerTexto('apellidoMaterno');
            $usernameUser = $obtenerTexto('username');
            $emailUser = $obtenerTexto('email');

            $passwordUser = $_POST['password'] ?? '';
            if (!is_string($passwordUser)) {
                 $passwordUser = '';
            }

            if ($nombreUser === '' || mb_strlen($nombreUser) > 100) {
                $errores[] = 'El nombre es obligatorio y no debe superar 100 caracteres.';
            }

            if ($apellidoPaternoUser === '' || mb_strlen($apellidoPaternoUser) > 100) {
                $errores[] = 'El apellido paterno es obligatorio y no debe superar 100 caracteres.';
            }

            if (mb_strlen($apellidoMaternoUser) > 100) {
                $errores[] = 'El apellido materno no debe superar 100 caracteres.';
            }

            if ( mb_strlen($usernameUser) < 3 || mb_strlen($usernameUser) > 50 || !preg_match('/\A[a-zA-Z0-9_.-]+\z/', $usernameUser) ) {
                $errores[] = 'El username debe tener entre 3 y 50 caracteres y usar letras, números, punto, guion o guion bajo.';
            }

            if ( mb_strlen($emailUser) > 254 || filter_var($emailUser, FILTER_VALIDATE_EMAIL) === false) {
                $errores[] = 'Ingresa un correo válido de hasta 254 caracteres.';
            }

            if (strlen($passwordUser) < 12) {
                $errores[] = 'La contraseña debe tener al menos 12 caracteres.';
            }

            if ($errores) {
            // Muestra errores
            } else {
                $passwordHash = password_hash($passwordUser, PASSWORD_DEFAULT);
                
                $data = [
                    'nombre' => $nombreUser,
                    'apellido_paterno' => $apellidoPaternoUser,
                    'apellido_materno' => $apellidoMaternoUser,
                    'correo' => $emailUser,
                    'username' => $usernameUser,
                    'password_hash' => $passwordHash,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                    'role' => 'user',
                    'estado_cuenta' => 'active'
                ];
                
                \UserModel::insertDB($data);
                header('location: /');
            }
       }
    }


    /**
     * Este método espera un método POST para recibir los datos de un usuario con los siguientes datos: 
     * nombre, apellidos, username, email y password. Usa los métodos de los modelos para la comunicación 
     * con la base de datos. 
     */
    public function allUser() {
        $datos = \UserModel::all(); //metodo modelos
        //$this->dd($datos);
	    $this->view('alluser', ['usuarios' => $datos]);
    }

    /**
    * La función antes de arrancar la página principal ('/user')
    *
    */
	public function iniciar(): void
	{
		$datos = [
			'titulo' => "Bienvenido a Doctor Werbsite Cotizacion",
			'descripcion' => "Un formulario básico para probar el método POST."
		];

		$this->view('iniciaruser', $datos);
    }

    public function iniciarcuenta() {
        if( $_SERVER['REQUEST_METHOD'] === "POST" ) { 
            $errores = [];
            
            $obtenerTexto = static function (string $campo) : string {
                $valor = $_POST[$campo];
                return is_string($valor) ? trim($valor) : '';
            };
            $usernameUser = $obtenerTexto('username');
            $emailUser = $obtenerTexto('email');

            $passwordUser = $_POST['password'] ?? '';
            if (!is_string($passwordUser)) {
                 $passwordUser = '';
            }

            if ( mb_strlen($usernameUser) < 3 || mb_strlen($usernameUser) > 50 || !preg_match('/\A[a-zA-Z0-9_.-]+\z/', $usernameUser) ) {
                $errores[] = 'El username debe tener entre 3 y 50 caracteres y usar letras, números, punto, guion o guion bajo.';
            }

            if ( mb_strlen($emailUser) > 254 || filter_var($emailUser, FILTER_VALIDATE_EMAIL) === false) {
                $errores[] = 'Ingresa un correo válido de hasta 254 caracteres.';
            }

            if (strlen($passwordUser) < 12) {
                $errores[] = 'La contraseña debe tener al menos 12 caracteres.';
            }

            if ($errores) {
            // Muestra errores
            } else {
                $passwordHash = password_hash($passwordUser, PASSWORD_DEFAULT);
                
                $data = [
                    'correo' => $emailUser,
                    'username' => $usernameUser,
                    'password_hash' => $passwordHash,
                    'role' => 'user',
                    'estado_cuenta' => 'active'
                ];
                
                $this->dd($data);
                \UserModel::insertDB($data);
                header('location: /');
            }
       }
    }
} 
