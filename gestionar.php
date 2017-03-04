<?php
include_once 'lib.php';
include_once 'mod.php';
User::session_start();
View::start('Distribuidora');
View::navigation();

if(!isset($_SESSION["user"])){
    header("location:index.php");
}
if(isset($_GET['tipo']) && $_GET['tipo'] == $_SESSION["tipo"]){
    switch ($_GET['tipo']) {
        case 1: //administrador
            if(isset($_GET['pag'])){
                switch ($_GET['pag']) {
                    case "gUsuarios": //gestionar usuarios
                        $res = DB::execute_sql('SELECT * FROM usuarios');
                        View::gestionUsuarios($res);
                        break;
                    case "gStock": //cliente
                        View::gestionStock();
                        break;
                    case "gPedidos": //repartidor
                        View::gestionPedidos();
                        break;
                    default :// menu principal
                        View::gestionAdmin();
                        break;
                }
            } else { View::gestionAdmin(); }
            break;
        case 2: //cliente
            echo "ta en el 2";
            break;
        case 3: //repartidor
            echo "ta en el 3";
            break;
    }
}else{
    echo "<div id=\"error\"><h2>un intruso!!!! llamando a la poli... no te vallas aveces tardan en llegar... jejejejeje</h2></div>";
}
View::end();
