<?php
include_once 'lib.php';
include_once 'mod.php';
View::start('Distribuidora');
View::navigation();
if(isset($_GET['id'])){
    $res = DB::execute_sql('SELECT * FROM bebidas WHERE id = '.$_GET['id']);
    View::bebidas($res);
}else{
    $res = DB::execute_sql('SELECT * FROM bebidas');
    View::bebidas($res);
}
View::end();
