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
                    case "gStock": //getionar stock
                        $res = DB::execute_sql('SELECT * FROM bebidas');
                        View::gestionStock($res);
                        break;
                    case "gPedidos": //gestionar pedidos
                        $res = DB::execute_sql('SELECT id, poblacionentrega , horacreacion, idrepartidor, horaasignacion, horareparto, horaentrega, PVP FROM pedidos');
                        View::gestionPedidos($res);
                        break;
                    default :// menu principal
                        View::gestionAdmin();
                        break;
                }
            } else { View::gestionAdmin(); }
            break;
        case 2: //cliente
            if(isset($_GET['pag'])){
                $res = DB::execute_sql('SELECT id, marca, PVP FROM bebidas');
                switch ($_GET['pag']) {
                    case "gProductos": //getionar pedido nuevo
                        View::gestionClientes($res);
                        break;
                    case "gPedidos": //gestionar pedidos
                        $res = DB::execute_sql("SELECT * FROM pedidos WHERE id='".$_SESSION['id']."'");
                        View::gestionPedidosCliente($res);
                        break;
                    default :// menu principal
                        View::gestionClientes($res);
                        break;
                }
            } else { View::gestionClientes(); };
            break;
        case 3: //repartidor
            echo 'menu repartidor';
            break;
    }
}else{
    echo "<div id=\"error\"><h2>un intruso!!!! llamando a la poli... no te vallas aveces tardan en llegar... jejejejeje</h2></div>";
}
View::end();
