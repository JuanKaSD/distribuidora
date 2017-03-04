<?php
include_once 'lib.php';
include_once 'mod.php';
User::session_start();
View::start('Distribuidora');
View::navigation();

if(!isset($_SESSION["user"])){
    header("location:index.php");
}
if(isset($_GET['accion']) &&  $_GET['tipo'] == $_SESSION["tipo"]){
    switch ($_GET['accion']) {
        case "editar": //editar cliente
            if(isset($_GET['id'])){
                $res = DB::execute_sql('SELECT * FROM usuarios WHERE id='.$_GET['id']);
                View::formularioUsuarios($res);
            }else{
                View::formularioUsuarios();
            }
            break;
        case "crear": //crear nuevo cliente
            View::formularioUsuarios();
            break;
        case "borrar":
            Mod::borrarRegistro('usuarios',$_GET['id']);
            header("location:gestionar.php?tipo=1&pag=gUsuarios");
            break;
    }
}
if(isset($_POST['accion']) &&  $_POST['tipo'] == $_SESSION["tipo"]){
    switch ($_POST['accion']) {
        case "editar": //editar cliente
            Mod::editarUsuario($_POST);
            header("location:gestionar.php?tipo=1&pag=gUsuarios");
            break;
        case "crear": //crear nuevo cliente
            Mod::crearUsuario($_POST);
            header("location:gestionar.php?tipo=1&pag=gUsuarios");
            break;
    }
}
View::end();
