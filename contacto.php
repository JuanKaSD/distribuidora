<?php
include_once 'lib.php';
include_once 'mod.php';
View::start('Distribuidora');
View::navigation();
if (isset($_GET['contacto'])){
    //mandar correo electronico

    //hacer el formulario de contacto
}
View::contacto();
View::end();
