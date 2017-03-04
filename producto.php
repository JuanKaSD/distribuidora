<?php
include_once 'lib.php';
include_once 'mod.php';
View::start('Distribuidora');
View::navigation();
if (isset($_GET['id'])){
    $id=$_GET['id'];
    $db = Mod::conectar();
    Mod::iniDb();
    $res=$db->prepare('SELECT * FROM bebidas WHERE id = ?;');
    $res->execute(array($id));
    //Ejemplo de lectura de tabla
    if($res){
        echo '<div id="content">
            <div id="main"><h2>Detalles de la bebida</h2>';
        $res->setFetchMode(PDO::FETCH_NAMED);
        $first=true;
        foreach($res as $game){
            if($first){
                echo "<table><tr>";
                foreach($game as $field=>$value){
                    echo "<th>$field</th>";
                }
                $first = false;
                echo "</tr>";
            }
            echo "<tr>";
            foreach($game as $value){
                echo "<td><a href=\"producto.php?id=".$game['id']."\">$value</a></td>";
            }
            echo "</tr>";
        }
        echo '</table></div>
            </div>';
    }
}else{
    echo '<div id="content">
            <div id="main"><h2>Producto no encontrado.</h2></div></div>';
}
View::end();
