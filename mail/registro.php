<?php
    require '/Applications/MAMP/htdocs/practicas/practicaCartas/vendor/autoload.php';

    use PHPMailer\PHPMailer\PHPMailer;

    $phpmailer = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP de Mailtrap
        $phpmailer->SMTPDebug= 0;
        $phpmailer->isSMTP();
        $phpmailer->Host = 'sandbox.smtp.mailtrap.io';
        $phpmailer->SMTPAuth = true;
        $phpmailer->Port = 2525;
        $phpmailer->Username = 'cf5e2b6ba2be43';
        $phpmailer->Password = '0d3f88a56b669e';


        // Configuración del correo
        $phpmailer->setFrom('deboranobs07@gmail.com', 'Juego');
        $usuarioCorreo = 'test@example.com';
        $phpmailer->addAddress($usuarioCorreo);
        $phpmailer->isHTML(true);
        $phpmailer->Subject = 'Registro completado';

        // Cargar el contenido de la plantilla HTML
        ob_start();
        include realpath(__DIR__ . '/plantilla.php'); 
        $bodyContent = ob_get_contents();
        echo $bodyContent;
        ob_end_clean();

        $phpmailer->Body = $bodyContent;
        $phpmailer->Subject = 'Este es el subject del html';
        $phpmailer->send();

        echo 'El correo ha sido enviado con éxito';
    } catch (Exception $e) {
        echo "El mensaje no pudo ser enviado. Error: {$phpmailer->ErrorInfo}";
    }

?>
