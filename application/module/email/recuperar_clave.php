<?php


$to      = $user->email;
$subject = 'Recuperar Email';
$message = '<head>'
        . '<body>'
        . '<img style="width:200px;height:auto" src="/media/logo.png"/>'
        . '<p>Hola '.$user->firstname.',</p>'
        . '<p>Recupera tu clave para usar tu cuenta</p>'
        . '<a href="'.DOMAIN.'/account/recupere_contrasena/?key='.$hash.'">Recuperar clave</a>'
        . '</body>';
$headers = 'From: soporte@pluralpet.com.uy' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
//echo $message;
mail($to, $subject, $message, $headers);


?>