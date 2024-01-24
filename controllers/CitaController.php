<?php

namespace Controllers;

use MVC\Router;

class CitaController{
    public static function index(Router $router){

        iniciarSession();

        $router->render('cita/index', [
            'nombre' => $_SESSION['nombre']
        ]);
    }
}

?>