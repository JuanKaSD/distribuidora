<?php
include_once 'lib.php';
include_once 'mod.php';
View::start('Distribuidora');
View::navigation();
if (isset($_GET['contacto'])){
    $para      = 'jjcinformatik@gmail.com';
    $titulo    = 'contacto desde distribuidora';
    $mensaje = wordwrap($_POST['mensaje'], 70, "\r\n");
    $cabeceras = "From: ".$_POST['eCliente'] . "\r\n" . "X-Mailer: PHP/" . phpversion();
    mail($para, $titulo, $mensaje, $cabeceras);
}
View::contacto();
View::end();
