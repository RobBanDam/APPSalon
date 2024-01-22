<?php
namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController{
    public static function login(Router $router){
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $auth = new Usuario($_POST);
            $alertas = $auth->validarLogin();

            if(empty($alertas)){
                //  Comprobar que exista el usuario
                $usuario = Usuario::where('email', $auth->email);

                if($usuario){
                    //  Verificar la Contraseña
                    if ($usuario->comprobarPasswordAndVerificado($auth->password)){
                        //  Autenticar al usuario
                        if(!isset($_SESSION)) {
                            session_start();
                        };

                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre . " " . $usuario->apellido;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['login'] = true;

                        //  Redireccionamiento
                        if($usuario->admin === "1"){
                            $_SESSION['admin'] = $usuario->admin ?? null;

                            header("location: /admin");
                        }else{
                            header("location: /cita");
                        }
                    }
                }else{
                    Usuario::setAlerta('error', 'Usuario no Encontrado');
                }
            }
        }

        $alertas = Usuario::getAlertas();

        $router->render('auth/login', [
            'alertas' => $alertas
        ]);
    }

    public static function logout(){
        echo "Desde Logout";
    }

    public static function olvide(Router $router){
        $router->render('auth/olvide-password', [
            
        ]);
    }

    public static function recuperar(){
        echo "Desde Recuperar";
    }

    public static function crear(Router $router){
        $usuario = new Usuario;

        //  Alertas Vacías
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();

            //  Revisar que alertas esté vacío
            if(empty($alertas)){
                //  Verificar que el usuario no este registrado
                $resultado = $usuario->existeUsuario();

                if($resultado->num_rows){
                    $alertas = Usuario::getAlertas();
                }else{
                    //  Hashear la contraseña
                    $usuario->hashPassword();

                    //  Generar un token único
                    $usuario->crearToken();

                    //  Enviar el E-Mail
                    $email = new Email($usuario->nombre, $usuario->email, $usuario->token);
                    $email->enviarConfirmacion();

                    //  Crear el usuario
                    $resultado = $usuario->guardar();
                    if($resultado){
                        header("location: /mensaje");
                    }

                    //debuguear($usuario);
                }
            }
        }


        $router->render('auth/crear-cuenta', [
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }

    public static function mensaje(Router $router){
        $router->render('auth/mensaje');
    }

    public static function confirmar (Router $router) {
        $alertas = [];
 
        //sanitizar y leer token desde la url
        $token = s($_GET['token']);
 
        $usuario = Usuario::where('token', $token);
 
        if(empty($usuario) || $usuario->token === '') {
 
            //mostrar mensaje de error
            Usuario::setAlerta('error', 'Token no válido...');
 
        }else {
 
            //cambiar valor de columna confirmado
            $usuario->confirmado = '1';
            //eliminar token
            $usuario->token = '';
            //Guardar y Actualizar 
            $usuario->guardar();
            //mostrar mensaje de exito
            Usuario::setAlerta('exito', 'Cuenta verificada exitosamente...');
        }
 
        //  Obtener Alertas
        $alertas = Usuario::getAlertas();

        //  Renderizar la vista
        $router->render('auth/confirmar-cuenta', [
            'alertas'=>$alertas
        ]);
    }
}

?>