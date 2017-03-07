<?php
include_once 'lib.php';
include_once 'mod.php';
View::start('Distribuidora');
View::navigation();
if(isset($_SESSION['user'])){
    header("location:index.php");
}
if (isset($_POST['user'])){
    if(User::login($_POST['user'],$_POST['password'])){
        User::session_start();
        $result=User::getLoggedUser();
        $_SESSION['user'] = $result['usuario'];
        $_SESSION['tipo'] = $result['tipo'];
        $_SESSION['id'] = $result['id'];
        header("location:index.php");
    }else {
       View::error("Error, Datos erroneos.");
    }
}
View::login();
View::end();
