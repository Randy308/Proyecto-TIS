<?php

require __DIR__ . '/vendor/autoload.php'; // Incluye la carga de Composer si es necesario
require __DIR__ . '/bootstrap/app.php'; // Incluye la configuración de Laravel

use App\Mail\NotificacionEventoEmail;
use Illuminate\Support\Facades\Mail; 

$mailer = new Swift_Mailer(new Swift_SmtpTransport('smtp.example.com', 587));
$message = (new Swift_Message('Título del correo'))
    ->setFrom(['tu@email.com' => 'Tu Nombre'])
    ->setTo(['destinatario@email.com'])
    ->setBody('Contenido del correo');

// Enviar el correo
$result = $mailer->send($message);

// Puedes añadir más lógica para el envío de correos electrónicos aquí
// ...

// Puedes registrar información en un log si necesitas verificar o depurar el proceso
file_put_contents('logs/enviar_correos.log', 'Correo enviado', FILE_APPEND);
