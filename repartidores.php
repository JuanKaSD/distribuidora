<?php
include_once 'lib.php';
include_once 'mod.php';
User::session_start();

if(!isset($_SESSION["user"]) && $_SESSION["user"]!=3){
    header("location:index.php");
}
if(isset($_POST) &$_POST != null){
    foreach($_POST as $field){
        DB::execute_sql("UPDATE pedidos SET horaasignacion=".time().", idrepartidor=".$_SESSION['id']." WHERE id=$field");
    }
}else{
    if(isset($_GET["tipo"]) && $_SESSION["tipo"]==$_GET["tipo"] && isset($_GET["id"]) && isset($_GET["pagina"])){
        if($_GET["pagina"] == "entregar"){
            DB::execute_sql("UPDATE pedidos SET horaentrega=".time()." WHERE id=".$_GET["id"]);
        }else{
            DB::execute_sql("UPDATE pedidos SET horareparto=".time()." WHERE id=".$_GET["id"]);
        }
    }
}
header("Location: gestionar.php?tipo=3&pag=gMPedidos");
