<?php
include_once 'lib.php';
include_once 'mod.php';
View::start('Distribuidora');
View::navigation();
$res = DB::execute_sql('SELECT * FROM bebidas');
View::bebidas($res);
View::end();
