<?php
include_once 'lib.php';
include_once 'mod.php';
User::session_start();
View::start('Distribuidora');
View::navigation();

if(!isset($_SESSION["user"]) && $_SESSION["user"]==1){
    header("location:index.php");
}
if(isset($_GET['accion']) &&  $_GET['tipo'] == $_SESSION["tipo"]){
    switch ($_GET['accion']) {
        case "editar": //editar cliente
            if(isset($_GET['id'])){
                $res = DB::execute_sql('SELECT * FROM bebidas WHERE id='.$_GET['id']);
                View::formularioBebidas($res);
            }else{
                View::formularioBebidas();
            }
            break;
        case "crear": //crear nuevo cliente
            View::formularioBebidas();
            break;
        case "borrar":
            Mod::borrarRegistro('bebidas',$_GET['id']);
            header("location:gestionar.php?tipo=1&pag=gStock");
            break;
    }
}
if(isset($_POST['accion']) &&  $_POST['tipo'] == $_SESSION["tipo"]){
    switch ($_POST['accion']) {
        case "editar": //editar cliente
            Mod::editarBebida($_POST);
            header("location:gestionar.php?tipo=1&pag=gStock");
            break;
        case "crear": //crear nuevo cliente
            Mod::crearBebida($_POST);
            header("location:gestionar.php?tipo=1&pag=gStock");
            break;
    }
}
View::end();
