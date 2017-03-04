<?php
include_once 'mod.php';
User::session_start();
if(!isset($_SESSION["user"])){
    header("location:index.php");
}
if(isset($_GET['tipo'])){
    switch ($_GET['tipo']) {
        case 1: //borrar usuario
            if(isset($_GET['id_usuario'])){
                Mod::borrarRegistro('usuarios',$_GET['id_usuario']);
                header("location:gestionar.php?tipo=1&pag=gUsuarios3");
            }
            break;
        case 2: //editar usuario
            echo "ta en el 2";
            break;
        case 3: //repartidor
            echo "ta en el 3";
            break;
    }
}else{
    echo "aqui no debe estar, Vete....";
}
