<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email{

    public $email;
    public $nombre;
    public $token;

    public function __construct($nombre, $email, $token){
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion(){
        //  Crear el objeto de email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '8349c4625ac442';
        $mail->Password = 'e679466f1f9bd6';

        $mail->setFrom('cuentas@appsalon.com'); // Aquí debe de ir el correo con el dominio una vez que se haya comprado el host
        $mail->addAddress('cuentas@appsalon.com', 'AppSalon.com');
        $mail->Subject = 'Confirma tu Cuenta';

        //  Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p><strong>Hola " . $this->nombre ."</strong> Has creado tu cuenta en AppSalon, sólo debes de confirmarla presionando el siguiente enlace</p>";
        $contenido .= "<p>Presiona aquí: <a href='http://localhost:3000/confirmar-cuenta?token=" . $this->token . "'>Confirmar Cuenta</a> </p>";
        $contenido .= "<p>Si tú no solicitaste esta cuenta, puedes ignorar el mensaje</p>";
        $contenido .= "</html>";
        $mail->Body = $contenido;

        //  Enviar el email
        $mail->send();
    }
}

?>