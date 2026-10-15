<?php

namespace App\Controllers;

use Core\Controller;

require_once BASE_PATH . 'app/controllers/Controller.php';

/**
 * Esta clase representa el controlador de la página de "home"
 *
 * @author Joseph Figueroa
 * @version 1.0
 *
 */
class HomeController extends Controller
{
   /**
    * La función antes de arrancar la página principal ('/')
    *
    */
	public function index(): void
	{
		$datos = [
			'titulo' => "Bienvenido a Doctor Werbsite Engine",
			'descripcion' => "¡El mejor motor para arrancar websites modernos y de manera segura!"
		];

		$this->view('home', $datos);
	}
}
