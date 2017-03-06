<?php
class View{
    public static function  start($title){
        $html = "
        <!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
        <html xmlns=\"http://www.w3.org/1999/xhtml\">

        <head>
            <meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\" />
            <title>$title</title>
            <link href=\"estilos.css\" rel=\"stylesheet\" type=\"text/css\" />
            <link rel=\"stylesheet\" type=\"text/css\" href=\"fuentes.css\" media=\"all\">
        </head>

        <body>
            <div id=\"logo\">
                <a href=\"index.php\"><img src=\"imagenes/img01.jpg\" alt=\"logo\" /></a>
            </div>";

        User::session_start();
        echo $html;
    }

    public static function navigation(){
        echo "
        <div class='menu_bar'>
            <a href='#' class='bt-menu'><span class='icon-menu'></span>Menu</a>
        </div>

        <nav>
            <ul>
                <li><a href='index.php'><span class='icon-home'></span>Inicio</a></li>
                <li><a href='contacto.php'><span class='icon-bubbles3'></span>Contacto</a></li>";

        if(!isset($_SESSION["user"])){
            echo "<li><a href='login.php'><span class='icon-key2'></span>Acceder</a></li>";
        }else{

            echo "<li><a href='gestionar.php?tipo=" . $_SESSION["tipo"] . "'><span class='icon-cog'></span>Gestionar</a></li>";
            echo "<li><a href='logout.php'><span class='icon-key2'></span>Salir</a></li>";
        }

        echo "    </ul>
        </nav>";
    }

    public static function contenidoIndex(){
        echo "<div id=\"content\">
        <div id=\"main\">
            <p>DBBR es una empresa especializada en venta de bebidas desde hace más de 10 a&ntilde;os. Nos encargamos del reparto en oficinas, locales, bares, restaurantes, hoteles, vending y SPAs.
                <br /> Adem&aacute;s, somos proveedores de caf&eacute; Araibo, marca de la cual somos distribuidores oficiales en la Comunidad de canarias. Ofrecemos caf&eacute; en c&aacute;psula con todos sus complementos. A su vez, y para ofrecer un servicio m&aacute;s completo, tambi&eacute;n distribuimos vasos de pl&aacute;stico de un s&oacute;lo uso y vasos de pl&aacute;stico para hoteles embolsados unitariamente. Todos nuestros productos son de alta calidad, lo que nos permite garantizar un &oacute;ptimo servicio a nuestros clientes.</p>
            <h2>Nuestras oficinas</h2>
            <br/>
            <div id=\"sede\">
                <img src=\"imagenes/sede.jpg\" alt=\"sede\" /> <br />
                <img src=\"imagenes/almacen.jpg\" alt=\"almacen\" />
            </div>
        </div>
    </div>";
    }

    public static function contacto(){
        echo "<div id=\"content\">
			<div id=\"main\">
				<h2>DBBR. Distribuci&oacute;n de Bebidas a Bares y Restaurantes.</h2>
				<p>Calle artenara, 33. 35017 Las Palmas De Gran Canaria. Las Palmas. </p>

				<p>	[Tel&eacute;fono] 928 000 000 - 928 000 001<br/>
					Horario: Lunes-sabado: 13:30 - 17:30 / 20:30 - 23:30<br/>
					<img src=\"imagenes/mapa.jpg\" alt=\"mapa\" id=\"mapa\"/>
				</p>
                <h2>Puede contactarnos llenando el siguiente formulario.</h2>
                <table>
                    <form action=\"\" method=\"post\" name=\"contacto\">
                        <tr>
                            <td> Email </td>
                            <td> <input name=\"eCliente\" type=\"text\"> </td>
                        </tr>
                        <tr>
                            <td> Mensaje </td>
                            <td><textarea name=\"mensaje\" rows=\"10\" cols=\"40\"></textarea></td>
                        <tr>
                        <tr>
                            <td colspan=\"2\"> <a href\"\" onclick=\"contacto.submit()\" class=\"boton\">Enviar</a></td>
                        <tr>
                    </form>
                </table>
			</div>
		</div>";
    }

    public static function login(){
        echo "
        <div id=\"content\">
            <div id=\"main\">
                <div id=\"login\">
                    <table>
                        <form action=\"\" method=\"post\" name=\"login\">
                            <tr>
                                <td> Usuario </td>
                                <td> <input name=\"user\" type=\"text\"> </td>
                            </tr>
                            <tr>
                                <td> Contraseña </td>
                                <td><input name=\"password\" type=\"password\"></td>
                            <tr>
                            <tr>
                                <td colspan=\"2\"> <a href\"\" onclick=\"login.submit()\" class=\"boton\">Ingresar</a></td>
                            <tr>
                        </form>
                    </table>
                </div>
            </div>
        </div>";
    }

    public static function gestionAdmin(){
        echo "
        <div id=\"content\">
            <div id=\"main\">
                <div id=\"login\">
                    <table>
                        <tr>
                            <td><a href=\"gestionar.php?tipo=".$_SESSION["tipo"]."&pag=gUsuarios\"  class=\"boton\">Gestionar Usuarios</a></td>
                            <td><a href=\"gestionar.php?tipo=".$_SESSION["tipo"]."&pag=gStock\" class=\"boton\">Gestionar Stock</a></td>
                        <tr>
                        <tr>
                            <td colspan='2'> <a href=\"gestionar.php?tipo=".$_SESSION["tipo"]."&pag=gPedidos\" class=\"boton\">Listar Pedidos</a></td>
                        <tr>
                    </table>
                </div>
            </div>
        </div>";
    }

    public static function gestionUsuarios($res){
        if($res){
            $res->setFetchMode(PDO::FETCH_NAMED);
            $first=true;
            foreach($res as $game){
                if($first){
                    echo "<div id=\"content\">
                            <div id=\"main\"><table><tr>
                                 <td colspan=\"8\" class=\"right\"><a href=\"usuarios.php?tipo=1&accion=crear\"><h1> Agregar Nuevo Usuario <span class='icon-user-plus'></span></h1></a></td>
                </tr>
                <tr>";
                    foreach($game as $field=>$value){
                        if(!($field=="clave"))
                        echo "<th>$field</th>";
                    }
                    $first = false;
                    echo "<th></th><th></th></tr>";
                }
                echo "<tr>";
                foreach($game as $value){
                    if(!($game['clave']==$value)){
                        $id = $game['id'];
                        echo "<td>$value</td>";
                    }
                }

                echo "  <td><a href=\"usuarios.php?tipo=1&id=".$id."&accion=editar\"><span class='icon-pencil'></span></a></td>
                        <td><a href=\"usuarios.php?tipo=1&id=".$id."&accion=borrar\"><span class='icon-bin'></span></a></td>
                    </tr>";
            }
            echo '</table></div>
                </div>';
        }

    }

    public static function formularioUsuarios($res=null){
        echo "<div id=\"content\">
                    <div id=\"main\">
                        <form action=\"usuarios.php\" method=\"post\" name=\"crear\">
                            <table>
                                <tr>";
        if($res){
            $res->setFetchMode(PDO::FETCH_NAMED);
            foreach($res as $campo){
                echo "                 <td colspan='3' class='right'>id: ".$campo['id']."
                                            <input type='hidden' name='id' value='".$campo['id']."' />
                                            <input type='hidden' name='tipo' value='".$_GET['tipo']."' />
                                            <input type='hidden' name='accion' value='".$_GET['accion']."' />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Nombre</td>
                                        <td><input type='text' name='nombre' value=\"".$campo['nombre']."\"/> </td>
                                        <td rowspan='3'>Tipo de usuario<br /><br />
                                            <input type=\"radio\" name=\"tipo2\" value=\"1\"";if($campo['tipo']==1) echo "checked"; echo "> Administrador<br />
                                            <input type=\"radio\" name=\"tipo2\" value=\"3\"";if($campo['tipo']==3) echo "checked"; echo "> Repartidor<br />
                                            <input type=\"radio\" name=\"tipo2\" value=\"2\"";if($campo['tipo']==2) echo "checked"; echo "> Cliente<br /> </td>
                                    </tr>
                                    <tr>
                                        <td>Usuario</td>
                                        <td><input type='text' name='usuario' value=\"".$campo['usuario']."\" /></td>
                                    </tr>
                                    <tr>
                                        <td>Direcci&oacute;n</td>
                                        <td><input type='text' name='direccion' value=\"".$campo['direccion']."\" /></td>
                                    </tr>
                                    <tr>
                                        <td>Poblaci&oacute;n</td>
                                        <td colspan='2'><input type='text' name='poblacion' value=\"".$campo['poblacion']."\" /></td>
                                    </tr>
                                    <tr>
                                        <td>Clave</td>
                                        <td colspan='2'><input type='password' name='clave' value=\"\" /> deje vacia para mantener la anterior.</td>
                                    </tr>
                                    <tr>
                                        <td colspan='3'><a href\"\" onclick=\"crear.submit()\" class=\"boton\">actualizar</a>";
            }
        }else{
            echo "                      <td colspan='3' class='right'>id
                                            <input type='hidden' name='tipo' value='".$_GET['tipo']."' />
                                            <input type='hidden' name='accion' value='".$_GET['accion']."' />
                                        </td>
                                </tr>
                                <tr>
                                    <td>Nombre</td>
                                    <td><input type='text' name='nombre' /> </td>
                                    <td rowspan='3'>Tipo de usuario<br /><br /><input type=\"radio\" name=\"tipo2\" value=\"1\"> Administrador<br /> <input type=\"radio\" name=\"tipo2\" value=\"3\"> Repartidor<br /> <input type=\"radio\" name=\"tipo2\" value=\"2\"> Cliente<br /> </td>
                                </tr>
                                <tr>
                                    <td>Usuario</td>
                                    <td><input type='text' name='usuario' /></td>
                                </tr>
                                <tr>
                                    <td>Direcci&oacute;n</td>
                                    <td><input type='text' name='direccion' /></td>
                                </tr>
                                <tr>
                                    <td>Poblaci&oacute;n</td>
                                    <td colspan='2'><input type='text' name='poblacion' /></td>
                                </tr>
                                <tr>
                                    <td>Clave</td>
                                    <td colspan='2'><input type='password' name='clave' /></td>
                                </tr>
                                <tr>
                                    <td colspan='3'><a href\"\" onclick=\"crear.submit()\" class=\"boton\">Agregar</a>";
        }
        echo "                      </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>";
    }

    public static function gestionStock($res){
        if($res){
            echo '<div id="content">
                    <div id="main">
                        <h2>Listado de bebidas</h2>
                        <img src="imagenes/img03.png" alt="bebidas" />';
            $res->setFetchMode(PDO::FETCH_NAMED);
            $first=true;
            foreach($res as $game){
                if($first){
                    echo "<table><tr>
                                 <td colspan=\"6\" class=\"right\"><a href=\"bebidas.php?tipo=1&accion=crear\"><h1> Agregar Nueva bebida <span class='icon-glass2'></span></h1></a></td>
                </tr><tr>";
                    foreach($game as $field=>$value){
                        echo "<th>$field</th>";
                    }
                    $first = false;
                    echo "<th></th><th></th></tr>";
                }
                echo "<tr>";
                foreach($game as $value){
                    $id = $game['id'];
                    echo "<td>$value</td>";
                }

                echo "  <td><a href=\"bebidas.php?tipo=1&id=".$id."&accion=editar\"><span class='icon-pencil'></span></a></td>
                        <td><a href=\"bebidas.php?tipo=1&id=".$id."&accion=borrar\"><span class='icon-bin'></span></a></td>
                    </tr>";
            }
            echo '</table></div>
                </div>';
        }
    }

    public static function formularioBebidas($res=null){
        echo "<div id=\"content\">
                    <div id=\"main\">
                        <form action=\"bebidas.php\" method=\"post\" name=\"crear\">
                            <table>
                                <tr>";
        if($res){
            $res->setFetchMode(PDO::FETCH_NAMED);
            foreach($res as $campo){
                echo "                  <td colspan='2' class='right'>id: ".$campo['id']."
                                            <input type='hidden' name='id' value='".$campo['id']."' />
                                            <input type='hidden' name='tipo' value='".$_GET['tipo']."' />
                                            <input type='hidden' name='accion' value='".$_GET['accion']."' />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Marca</td>
                                        <td><input type='text' name='marca' value=\"".$campo['marca']."\"/> </td>
                                    </tr>
                                    <tr>
                                        <td>Stock</td>
                                        <td><input type='text' name='stock' value=\"".$campo['stock']."\" /></td>
                                    </tr>
                                    <tr>
                                        <td>P.V.P</td>
                                        <td><input type='text' name='PVP' value=\"".$campo['PVP']."\" /></td>
                                    </tr>
                                    <tr>
                                        <td colspan='2'><a href\"\" onclick=\"crear.submit()\" class=\"boton\">actualizar</a>";
            }
        }else{
            echo "                  <td colspan='2' class='right'>id:
                                            <input type='hidden' name='tipo' value='".$_GET['tipo']."' />
                                            <input type='hidden' name='accion' value='".$_GET['accion']."' />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Marca</td>
                                        <td><input type='text' name='marca' /> </td>
                                    </tr>
                                    <tr>
                                        <td>Stock</td>
                                        <td><input type='text' name='stock' /></td>
                                    </tr>
                                    <tr>
                                        <td>P.V.P</td>
                                        <td><input type='text' name='PVP' /></td>
                                    </tr>
                                    <tr>
                                        <td colspan='2'><a href\"\" onclick=\"crear.submit()\" class=\"boton\">agregar</a>";
        }
        echo "                      </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>";
    }

    public static function gestionPedidos($res){
        if($res){
            echo '<div id="content">
                    <div id="main">';
            $res->setFetchMode(PDO::FETCH_NAMED);
            $first=true;
            foreach($res as $game){
                if($first){
                    echo "<table><tr>";
                    foreach($game as $field=>$value){
                        echo "<th>$field</th>";
                    }
                    $first = false;
                    echo "<th></th></tr>";
                }
                echo "<tr>";
                foreach($game as $value){
                    $id = $game['id'];
                    if($game['horacreacion'] === $value || $game['horaasignacion'] === $value || $game['horareparto'] === $value || $game['horaentrega'] === $value) {
                        if($value == null || $value == 0 ){
                            echo "<td></td>";
                        }else{
                            echo "<td>".date("d-m-Y H:i",$value)."</td>";
                        }
                    }else{
                        echo "<td>$value</td>";
                    }

                }

                echo "  <td><a href=\"pedidos.php?tipo=1&id=".$id."&accion=ver\"><span class='icon-eye'></span></a></td>
                    </tr>";
            }
            echo '</table></div>
                </div>';
        }
    }

    public static function gestionPedidosCliente($res){
        if($res){
            echo '<div id="content">
                    <div id="main">';
            $res->setFetchMode(PDO::FETCH_NAMED);
            $first=true;
            foreach($res as $game){
                if($first){
                    echo "<table><tr>";
                    foreach($game as $field=>$value){
                        echo "<th>$field</th>";
                    }
                    $first = false;
                    echo "<th></th></tr>";
                }
                echo "<tr>";
                foreach($game as $value){
                    $id = $game['id'];
                    if($game['horacreacion'] === $value || $game['horaasignacion'] === $value || $game['horareparto'] === $value || $game['horaentrega'] === $value) {
                        if($value == null || $value == 0 ){
                            echo "<td></td>";
                        }else{
                            echo "<td>".date("d-m-Y H:i",$value)."</td>";
                        }
                    }else{
                        echo "<td>$value</td>";
                    }

                }

                echo "  <td><a href=\"pedidos.php?tipo=2&id=".$id."&accion=ver\"><span class='icon-eye'></span></a></td>
                    </tr>";
            }
            echo '</table></div>
                </div>';
        }
    }

    public static function gestionClientes($res=null){
        if($res){
            echo '<div id="content">
                    <div id="main">
                        <h2>Listado de bebidas</h2>';
            $res->setFetchMode(PDO::FETCH_NAMED);
            $first=true;
            foreach($res as $game){
                if($first){
                    echo "<form action=\"clientes.php\" method=\"post\" name=\"crear\">
                            <table><tr>
                                 <td colspan=\"5\" class=\"right\"><a onclick=\"crear.submit()\"><h1> Hacer Pedido<span class='icon-cart'></span></h1></a></td>
                </tr>
                <tr>
                                 <td colspan=\"2\" class=\"right\">Poblac&oacute;n de entrega: <input type='text' name='poblacion' /></td>
                                 <td colspan=\"3\" class=\"right\">Direcc&oacute;n de entrega: <input type='text' name='direccion' /></td>
                </tr>
                <tr>";
                    foreach($game as $field=>$value){
                        echo "<th>$field</th>";
                    }
                    $first = false;
                    echo "<th>Cantidad</th></tr>";
                }
                echo "<tr>";
                foreach($game as $value){
                    echo "<td>$value</td>";
                }
                $id = $game['id'];
                $PVP = $game['PVP'];

                echo "    <td class=\"right\"><input type='text' name='cantidad_$id' size='5'/></td>
                    </tr>";
            }
            echo '</table></form></div>
                </div>';
        }else{
            echo "<div id=\"content\">
                    <div id=\"main\">
                        <div id=\"login\">
                            <table>
                                <tr>
                                    <td><a href=\"gestionar.php?tipo=".$_SESSION["tipo"]."&pag=gPedidos\" class=\"boton\">Ver Pedidos</a></td>
                                    <td><a href=\"gestionar.php?tipo=".$_SESSION["tipo"]."&pag=gProductos\" class=\"boton\">Hacer pedido nuevo</a></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>";
        }
    }

    public static function verPedido($res){
        $total=0;
        if($res){
            echo '<div id="content">
                    <div id="main">';
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
                    echo "<td>$value</td>";
                }
                $total+=$game['PVP']*$game['unidades'];

            }
            echo "<tr><td colspan='4' class='right'> Total: $total&euro;</td></tr></table></div>
                </div>";
        }
    }

    public static function gestionRepartidores($res=null){
        if($res){
            echo '<div id="content">
                    <div id="main">
                        <h2>Listado de pedidos</h2>';
            $res->setFetchMode(PDO::FETCH_NAMED);
            $first=true;
            foreach($res as $game){
                if($first){
                    echo "<form action=\"repartidores.php\" method=\"post\" name=\"crear\">
                            <table><tr>
                                 <td colspan=\"5\" class=\"right\"><a onclick=\"crear.submit()\"><h1> Asignarse Pedido<span class='icon-cart'></span></h1></a></td>
                </tr>
                <tr>";
                    foreach($game as $field=>$value){
                        echo "<th>$field</th>";
                    }
                    $first = false;
                    echo "<th></th></tr>";
                }
                echo "<tr>";
                foreach($game as $value){
                    echo "<td>$value</td>";
                }
                $id = $game['id'];
                echo "<td class=\"right\"><input type='checkbox' name='$id' value='$id'/></td></tr>";
            }
            echo '</table></form></div>
                </div>';
        }else{
            echo "<div id=\"content\">
                    <div id=\"main\">
                        <div id=\"login\">
                            <table>
                                <tr>
                                    <td><a href=\"gestionar.php?tipo=".$_SESSION["tipo"]."&pag=gMPedidos\" class=\"boton\">Modificar Pedidos</a></td>
                                    <td><a href=\"gestionar.php?tipo=".$_SESSION["tipo"]."&pag=gAPedidos\" class=\"boton\">Asignarse pedido nuevo</a></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>";
        }
    }

    public static function gestionPedidosRepartidores($res){
        if($res){
            echo '<div id="content">
                    <div id="main">';
            $res->setFetchMode(PDO::FETCH_NAMED);
            $first=true;
            foreach($res as $game){
                if($first){
                    echo "<table><tr>";
                    foreach($game as $field=>$value){
                        echo "<th>$field</th>";
                    }
                    $first = false;
                    echo "<th>Repartir</th><th>Entregar</th></tr>";
                }
                echo "<tr>";
                foreach($game as $value){

                        echo "<td>$value</td>";

                }
                $id = $game['id'];

                echo "  <td><a href=\"repartidores.php?tipo=".$_SESSION["tipo"]."&id=$id&pagina=repartir\"><span class='icon-truck big'></span></td>
                        <td><a href=\"repartidores.php?tipo=".$_SESSION["tipo"]."&id=$id&pagina=entregar\"><span class='icon-stopwatch big'></span></td>
                    </tr>";
            }
            echo '</table></div>
                </div>';
        }
    }

    public static function end(){
        echo '</body>
</html>';
    }
}

