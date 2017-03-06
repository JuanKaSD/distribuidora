<?php
include_once 'lib.php';
include_once 'mod.php';
View::start('Distribuidora');
View::navigation();
if (isset($_GET['contacto'])){
    $para      = 'webmaster@pagina.com';
    $titulo    = 'contacto desde distribuidora';
    $mensaje = wordwrap($_GET['mensaje'], 70, "\r\n");
    $cabeceras = "From: ".$_GET['eCliente'] . "\r\n" . "X-Mailer: PHP/" . phpversion();
    mail($para, $titulo, $mensaje, $cabeceras);
}
View::contacto();
View::end();
