<?php
include_once 'lib.php';
include_once 'mod.php';
User::session_start();
View::start('Distribuidora');
View::navigation();

if(!isset($_SESSION["user"]) && $_SESSION["user"]!=2){
    header("location:index.php");
}
if(isset($_GET['id']) && isset($_GET['tipo']) &&  $_GET['tipo'] == $_SESSION["tipo"]){
    $res = DB::execute_sql('SELECT idpedido, bebidas.marca, unidades, lineaspedido.PVP FROM lineaspedido  INNER JOIN bebidas ON lineaspedido.idbebida = bebidas.id WHERE idpedido='.$_GET['id']);
    View::verPedido($res);
}
View::end();


