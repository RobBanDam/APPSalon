<?php
namespace Model;

class Usuario extends ActiveRecord{
    //  Base de Datos
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'email', 'password', 'telefono', 'admin', 'confirmado', 'token'];

    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $password;
    public $telefono;
    public $admin;
    public $confirmado;
    public $token;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->admin = $args['admin'] ?? '0';
        $this->confirmado = $args['confirmado'] ?? '0';
        $this->token = $args['token'] ?? '';
    }

    //  Mensajes de validación para la Creación de la cuenta
    public function validarNuevaCuenta(){
        if(!$this->nombre){
            self::$alertas['error'][] = 'El Nombre es Obligatorio'; 
        }

        if(!$this->apellido){
            self::$alertas['error'][] = 'El Apellido es Obligatorio'; 
        }

        if(!$this->email){
            self::$alertas['error'][] = 'El E-Mail es Obligatorio'; 
        }

        if(!$this->password){
            self::$alertas['error'][] = 'La Contraseña es Obligatoria'; 
        }

        if(strlen($this->password) < 6){
            self::$alertas['error'][] = 'La Contraseña debe de tener una longitud mayor a 6 caracteres';
        }

        return self::$alertas;
    }

    //  Verificar si el usuario ya existe en la base de datos
    public function existeUsuario(){
        $query = " SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";
        
        $resultado = self::$db->query($query);

        if($resultado->num_rows){
            //  Verifica si hay al menos una fila en el resultado
            if ($resultado->num_rows > 0) {
                self::$alertas['error'][] = 'El Usuario ya está Registrado';
            }else{
                //  Maneja el error de la consulta
                self::$alertas['error'][] = 'Error en la consulta: ' . self::$db->error;
            }   
        }
        return $resultado;
    }

    //  Hashear la contraseña
    public function hashPassword(){
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    //  Crear token único
    public function crearToken(){
        $this->token = uniqid();
    }
}

?>