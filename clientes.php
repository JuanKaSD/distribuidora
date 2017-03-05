<?php
include_once 'lib.php';
include_once 'mod.php';
User::session_start();

if(!isset($_SESSION["user"]) && $_SESSION["user"]==2){
    header("location:index.php");
}
if(isset($_POST)){
    $idpedido = DB::execute_insert("INSERT INTO [pedidos] ([idcliente], [horacreacion], [poblacionentrega], [direccionentrega], [PVP]) VALUES (".$_SESSION['id'].", ".time().",'".$_POST['poblacion']."','".$_POST['direccion']."',0)");
    $total=0;
    foreach($_POST as $field=>$value){
        if($value!=null){
            if(strstr($field, "_",true) =="cantidad"){
                $idbebida = substr(strrchr($field, "_"), 1);
                $res = DB::execute_sql("SELECT PVP, stock FROM bebidas WHERE id =".$idbebida);
                $res->setFetchMode(PDO::FETCH_NAMED);
                   foreach($res as $campo){
                       DB::execute_sql("INSERT INTO [lineaspedido] ([idpedido], [idbebida], [unidades], [PVP]) VALUES ($idpedido, $idbebida,$value,".$campo['PVP'].")");
                       $newstock=$campo['stock']-$value;
                       DB::execute_sql("UPDATE bebidas SET stock=$newstock WHERE id=$idbebida");
                       $total+=$campo['PVP']*$value;
                   }

            }
        }
    }
    DB::execute_sql("UPDATE pedidos SET PVP=$total WHERE id=$idpedido");
    header("location:gestionar.php?tipo=2&pag=gPedidos");
}
