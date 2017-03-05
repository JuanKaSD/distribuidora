<?php
include_once 'lib.php';
include_once 'mod.php';
User::session_start();

if(!isset($_SESSION["user"]) && $_SESSION["user"]==2){
    header("location:index.php");
}
if(isset($_POST)){
    echo $queryPedido = "INSERT INTO [pedidos] ([idcliente], [horacreacion], [poblacionentrega], [direccionentrega], [PVP]) VALUES (".$_SESSION['id'].", ".time().",".$_POST['poblacion'].",".$_POST['direccion'].",0)";

    $res = DB::execute_insert("INSERT INTO [pedidos] ([idcliente], [horacreacion], [poblacionentrega], [direccionentrega], [PVP]) VALUES (".$_SESSION['id'].", ".time().",'".$_POST['poblacion']."','".$_POST['direccion']."',0)");
    echo $res;



    foreach($_POST as $field=>$value){
        if($value!=null){
            if(strstr($field, "_",true) =="cantidad"){
                $idbebida = substr(strrchr($field, "_"), 1);
                echo $queryLineasPedido = "INSERT INTO [lineaspedidos] ([idpedido], [idbebida], [unidades], [PVP]) VALUES (1, ".$idbebida.",".$value.",0);</br>";
            }
        }



    }
        print_r($_POST);


}
View::end();
