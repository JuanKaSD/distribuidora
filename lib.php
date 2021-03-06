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

    public static function error($mensaje){
         echo " <div id=\"content\">
                    <div id=\"main\"><h2>$mensaje</h2></div>
                </div>";
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
        echo "
        <div id=\"content\">
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
        echo "
        <div id=\"content\">
            <div id=\"main\">
                <h2>DBBR. Distribuci&oacute;n de Bebidas a Bares y Restaurantes.</h2>
                <p>Calle artenara, 33. 35017 Las Palmas De Gran Canaria. Las Palmas. </p>

                <p>	[Tel&eacute;fono] 928 000 000 - 928 000 001<br/>
                    Horario: Lunes-sabado: 07:30 - 12:30 / 15:30 - 18:30<br/>
                    <img src=\"imagenes/mapa.jpg\" alt=\"mapa\" id=\"mapa\"/>
                </p>
                <h2>Puede contactarnos llenando el siguiente formulario.</h2>
                <form action=\"\" method=\"post\" name=\"contacto\">
                    <div id=\"contenedor\">
                        <div id=\"contenidos\">
                            <div id=\"columna1\"> Email </div>
                            <div id=\"columna2\"> <input name=\"eCliente\" type=\"text\"> </div>
                        </div>
                        <div id=\"contenidos\">
                            <div id=\"columna1\"> Mensaje </div>
                            <div id=\"columna2\"><textarea name=\"mensaje\" rows=\"10\" cols=\"40\"></textarea></div>
                        </div>
                    </div>
                    <div id=\"contenedor\">
                        <div id=\"contenidos\">
                            <div id=\"columna3\"><a href\"\" onclick=\"contacto.submit()\" class=\"boton\">Enviar</a></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>";
    }

    public static function login(){
        echo "
        <div id=\"content\">
            <div id=\"main\">
                <form action=\"\" method=\"post\" name=\"login\">
                     <div id=\"contenedor\">
                            <div id=\"contenidos\">
                                <div id=\"columna1\"> Usuario </div>
                                <div id=\"columna2\"> <input name=\"user\" type=\"text\"> </div>
                            </div>
                            <div id=\"contenidos\">
                                <div id=\"columna1\"> Contrase&ntilde;a </div>
                                <div id=\"columna2\"><input name=\"password\" type=\"password\"></div>
                            </div>
                        </div>
                        <div id=\"contenedor\">
                            <div id=\"contenidos\">
                                <div id=\"columna3\"> <a href\"\" onclick=\"login.submit()\" class=\"boton\">Ingresar</a></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>";
    }

    public static function gestionAdmin(){
        echo "
        <div id=\"content\">
            <div id=\"main\">
                <div id=\"contenedor\">
                    <div id=\"contenidos\">
                        <div id=\"columna1\"><a href=\"gestionar.php?tipo=".$_SESSION["tipo"]."&pag=gUsuarios\"  class=\"boton\">Gestionar Usuarios</a></div>
                        <div id=\"columna2\"><a href=\"gestionar.php?tipo=".$_SESSION["tipo"]."&pag=gStock\" class=\"boton\">Gestionar Stock</a></div>
                    </div>
                </div>
                <div id=\"contenedor\">
                    <div id=\"contenidos\">
                        <div id=\"columna3\"> <a href=\"gestionar.php?tipo=".$_SESSION["tipo"]."&pag=gPedidos\" class=\"boton\">Listar Pedidos</a></div>
                    </div>
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
                    echo "
                    <div id=\"content\">
                        <div id=\"main\">
                            <div id=\"contenedor\">
                                <div id=\"contenidos\">
                                    <div id=\"columna1\"><a href=\"usuarios.php?tipo=1&accion=crear\"><h1> Agregar Nuevo Usuario <span class='icon-user-plus'></span></h1></a></div>
                                </div>
                            </div>
                            <div id=\"contenedor\">
                                <div id=\"contenidos\">";
                    foreach($game as $field=>$value){
                        if(!($field=="clave"))
                        echo "
                                    <div id=\"cabecera\">$field</div>";
                    }
                    $first = false;
                    echo "
                                    <div id=\"cabecera\"></div>
                                    <div id=\"cabecera\"></div>
                                </div>";
                }
                echo "          <div id=\"contenidos\">";
                foreach($game as $value){
                    if(!($game['clave']==$value)){
                        $id = $game['id'];
                        echo "      <div id=\"columna2\">$value</div>";
                    }
                }

                echo "                  <div id=\"columna3\"><a href=\"usuarios.php?tipo=1&id=".$id."&accion=editar\"><span class='icon-pencil'></span></a></div>
                                        <div id=\"columna3\"><a href=\"usuarios.php?tipo=1&id=".$id."&accion=borrar\"><span class='icon-bin'></span></a></div>
                                    </div>";
            }
            echo '              </div>
                            </div>';
        }

    }

    public static function formularioUsuarios($res=null){
        echo "
        <div id=\"content\">
            <div id=\"main\">
                <form action=\"usuarios.php\" method=\"post\" name=\"crear\">
                    <div id=\"contenedor\">
                        <div id=\"contenidos\">";
        if($res){
            $res->setFetchMode(PDO::FETCH_NAMED);
            foreach($res as $campo){
                echo "
                            <div id=\"columna1\">id: ".$campo['id']."
                                <input type='hidden' name='id' value='".$campo['id']."' />
                                <input type='hidden' name='tipo' value='".$_GET['tipo']."' />
                                <input type='hidden' name='accion' value='".$_GET['accion']."' />
                            </div>
                        </div>
                    </div>
                    <div id=\"contenedor\">
                        <div id=\"contenidos\">
                            <div id=\"columna1\">Nombre</div>
                            <div id=\"columna2\"><input type='text' name='nombre' value=\"".$campo['nombre']."\"/></div>
                            <div id=\"columna2\">
                                Tipo de usuario<br /><br />
                                <input type=\"radio\" name=\"tipo2\" value=\"1\"";if($campo['tipo']==1) echo "checked"; echo "> Administrador<br />
                                <input type=\"radio\" name=\"tipo2\" value=\"3\"";if($campo['tipo']==3) echo "checked"; echo "> Repartidor<br />
                                <input type=\"radio\" name=\"tipo2\" value=\"2\"";if($campo['tipo']==2) echo "checked"; echo "> Cliente<br />
                            </div>
                        </div>
                    </div>
                    <div id=\"contenedor\">
                        <div id=\"contenidos\">
                            <div id=\"columna1\">Usuario</div>
                            <div id=\"columna2\"><input type='text' name='usuario' value=\"".$campo['usuario']."\" /></div>
                        </div>
                        <div id=\"contenidos\">
                            <div id=\"columna1\">Direcci&oacute;n</div>
                            <div id=\"columna2\"><input type='text' name='direccion' value=\"".$campo['direccion']."\" /></div>
                        </div>
                        <div id=\"contenidos\">
                            <div id=\"columna1\">Poblaci&oacute;n</div>
                            <div id=\"columna2\"><input type='text' name='poblacion' value=\"".$campo['poblacion']."\" /></div>
                        </div>
                        <div id=\"contenidos\">
                            <div id=\"columna1\">Clave</div>
                            <div id=\"columna2\"><input type='password' name='clave' value=\"\" /> deje vacia para mantener la anterior.</div>
                        </div>
                    </div>
                    <div id=\"contenedor\">
                        <div id=\"contenidos\">
                            <div id=\"columna3\"><a href\"\" onclick=\"crear.submit()\" class=\"boton\">actualizar</a>";
            }
        }else{
                echo "      <div id=\"columna1\">Nombre</div>
                            <div id=\"columna2\"><input type='text' name='nombre' \"/></div>
                            <div id=\"columna2\">
                                Tipo de usuario<br /><br />
                                <input type=\"radio\" name=\"tipo2\"> Administrador<br />
                                <input type=\"radio\" name=\"tipo2\"> Repartidor<br />
                                <input type=\"radio\" name=\"tipo2\"> Cliente<br />
                                <input type='hidden' name='tipo' value='".$_GET['tipo']."' />
                                <input type='hidden' name='accion' value='".$_GET['accion']."' />
                            </div>
                        </div>
                    </div>
                    <div id=\"contenedor\">
                        <div id=\"contenidos\">
                            <div id=\"columna1\">Usuario</div>
                            <div id=\"columna2\"><input type='text' name='usuario' /></div>
                        </div>
                        <div id=\"contenidos\">
                            <div id=\"columna1\">Direcci&oacute;n</div>
                            <div id=\"columna2\"><input type='text' name='direccion' /></div>
                        </div>
                        <div id=\"contenidos\">
                            <div id=\"columna1\">Poblaci&oacute;n</div>
                            <div id=\"columna2\"><input type='text' name='poblacion' /></div>
                        </div>
                        <div id=\"contenidos\">
                            <div id=\"columna1\">Clave</div>
                            <div id=\"columna2\"><input type='password' name='clave' /> deje vacia para mantener la anterior.</div>
                        </div>
                    </div>
                    <div id=\"contenedor\">
                        <div id=\"contenidos\">
                            <div id=\"columna3\"><a href\"\" onclick=\"crear.submit()\" class=\"boton\">actualizar</a>";
        }
            echo "          </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>";
    }

    public static function gestionStock($res){
        if($res){
            echo '
            <div id="content">
                <div id="main">
                    <h2>Listado de bebidas</h2>
                    <img src="imagenes/img03.png" alt="bebidas" />';
            $res->setFetchMode(PDO::FETCH_NAMED);
            $first=true;
            foreach($res as $game){
                if($first){
                    echo "
                    <div id=\"contenedor\">
                        <div id=\"contenidos\">
                                 <div id=\"columna1\">
                                    <a href=\"bebidas.php?tipo=1&accion=crear\">
                                        <h1> Agregar Nueva bebida <span class='icon-glass2'></span></h1>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div id=\"contenedor\">
                            <div id=\"contenidos\">";
                    foreach($game as $field=>$value){
                        echo "  <div id=\"cabecera\">$field</div>";
                    }
                    $first = false;
                    echo "      <div id=\"cabecera\"></div>
                                <div id=\"cabecera\"></div>
                            </div>";
                }
                echo "      <div id=\"contenidos\">";
                foreach($game as $value){
                    $id = $game['id'];
                    echo "      <div id=\"columna2\">$value</div>";
                }

                echo "          <div id=\"columna3\"><a href=\"bebidas.php?tipo=1&id=".$id."&accion=editar\"><span class='icon-pencil'></span></a></div>
                                <div id=\"columna3\"><a href=\"bebidas.php?tipo=1&id=".$id."&accion=borrar\"><span class='icon-bin'></span></a></div>
                            </div>";
            }
            echo '      </div>
                    </div>
                </div>';
        }
    }

    public static function formularioBebidas($res=null){
        echo "
        <div id=\"content\">
            <div id=\"main\">
                <form action=\"bebidas.php\" method=\"post\" name=\"crear\">
                    <div id=\"contenedor\">
                        <div id=\"contenidos\">";
        if($res){
            $res->setFetchMode(PDO::FETCH_NAMED);
            foreach($res as $campo){
                echo "
                            <div id=\"columna1\">id: ".$campo['id']."
                                <input type='hidden' name='id' value='".$campo['id']."' />
                                <input type='hidden' name='tipo' value='".$_GET['tipo']."' />
                                <input type='hidden' name='accion' value='".$_GET['accion']."' />
                            </div>
                        </div>
                    </div>
                    <div id=\"contenedor\">
                        <div id=\"contenidos\">
                            <div id=\"columna1\">Marca</div>
                            <div id=\"columna2\"><input type='text' name='marca' value=\"".$campo['marca']."\"/> </div>
                        </div>
                        <div id=\"contenidos\">
                            <div id=\"columna1\">Stock</div>
                            <div id=\"columna2\"><input type='text' name='stock' value=\"".$campo['stock']."\" /></div>
                        </div>
                        <div id=\"contenidos\">
                            <div id=\"columna1\">P.V.P</div>
                            <div id=\"columna2\"><input type='text' name='PVP' value=\"".$campo['PVP']."\" /></div>
                        </div>
                    </div>
                    <div id=\"contenedor\">
                        <div id=\"contenidos\">
                            <div id=\"columna3\"><a href\"\" onclick=\"crear.submit()\" class=\"boton\">actualizar</a>";
            }
        }else{
            echo "
                            <div id=\"columna1\">id:
                                <input type='hidden' name='tipo' value='".$_GET['tipo']."' />
                                <input type='hidden' name='accion' value='".$_GET['accion']."' />
                            </div>
                        </div>
                    </div>
                    <div id=\"contenedor\">
                        <div id=\"contenidos\">
                            <div id=\"columna1\">Marca</div>
                            <div id=\"columna2\"><input type='text' name='marca' /> </div>
                        </div>
                        <div id=\"contenidos\">
                            <div id=\"columna1\">Stock</div>
                            <div id=\"columna2\"><input type='text' name='stock' /></div>
                        </div>
                        <div id=\"contenidos\">
                            <div id=\"columna1\">P.V.P</div>
                            <div id=\"columna2\"><input type='text' name='PVP' /></div>
                        </div>
                    </div>
                    <div id=\"contenedor\">
                        <div id=\"contenidos\">
                            <div id=\"columna3\"><a href\"\" onclick=\"crear.submit()\" class=\"boton\">agregar</a>";
        }
        echo "              </div>
                        </div>
                    </div>
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
                    echo "<div id=\"contenedor\">
                            <div id=\"contenidos\">";
                    foreach($game as $field=>$value){
                        echo "  <div id=\"cabecera\">$field</div>";
                    }
                    $first = false;
                    echo "      <div id=\"cabecera\"></div>
                            </div>";
                }
                echo "      <div id=\"contenidos\">";
                foreach($game as $value){
                    $id = $game['id'];
                    if($game['horacreacion'] === $value || $game['horaasignacion'] === $value || $game['horareparto'] === $value || $game['horaentrega'] === $value) {
                        if($value == null || $value == 0 ){
                            echo "
                                <div id=\"columna2\"></div>";
                        }else{
                            echo "
                                <div id=\"columna2\">".date("d-m-Y H:i",$value)."</div>";
                        }
                    }else{
                        echo "<div id=\"columna2\">$value</div>";
                    }

                }

            echo "              <div id=\"columna3\"><a href=\"pedidos.php?tipo=1&id=".$id."&accion=ver\"><span class='icon-eye'></span></a></div>
                            </div>";
            }
            echo '      </div>
                    </div>
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
                    echo "<div id=\"contenedor\">
                            <div id=\"contenidos\">";
                    foreach($game as $field=>$value){
                        echo "  <div id=\"cabecera\">$field</div>";
                    }
                    $first = false;
                    echo "      <div id=\"cabecera\"></div>
                            </div>";
                }
                echo "      <div id=\"contenidos\">";
                foreach($game as $value){
                    $id = $game['id'];
                    if($game['horacreacion'] === $value || $game['horaasignacion'] === $value || $game['horareparto'] === $value || $game['horaentrega'] === $value) {
                        if($value == null || $value == 0 ){
                            echo "<div id=\"columna1\"></div>";
                        }else{
                            echo "<div id=\"columna1\">".date("d-m-Y H:i",$value)."</div>";
                        }
                    }else{
                        echo "<div id=\"columna1\">$value</div>";
                    }

                }

                echo "  <div id=\"columna1\"><a href=\"pedidos.php?tipo=2&id=".$id."&accion=ver\"><span class='icon-eye'></span></a></div>
                    </div>";
            }
            echo '</div></div>
                </div>';
        }
    }

    public static function gestionClientes($res=null){
        if($res){
            echo "
            <div id=\"content\">
                <div id=\"main\">
                    <h2>Listado de bebidas</h2>";
            $res->setFetchMode(PDO::FETCH_NAMED);
            $first=true;
            foreach($res as $game){
                if($first){
                    echo "
                    <form action=\"clientes.php\" method=\"post\" name=\"crear\">
                        <div id=\"contenedor\">
                            <div id=\"contenidos\">
                                <div id=\"columna1\"><a onclick=\"crear.submit()\"><h1> Hacer Pedido<span class='icon-cart'></span></h1></a></div>
                            </div>
                        </div>
                        <div id=\"contenedor\">
                            <div id=\"contenidos\">
                                <div id=\"columna2\">Poblac&oacute;n de entrega: <input type='text' name='poblacion' /></div>
                                <div id=\"columna2\">Direcc&oacute;n de entrega: <input type='text' name='direccion' /></div>
                            </div>
                        </div>
                        <div id=\"contenedor\">
                            <div id=\"contenidos\">";
                    foreach($game as $field=>$value){
                        echo "  <div id=\"cabecera\">$field</div>";
                    }
                    $first = false;
                    echo "      <div id=\"cabecera\">Cantidad</div>
                            </div>";
                }
                echo "      <div id=\"contenidos\">";
                foreach($game as $value){
                    echo "      <div id=\"columna2\">$value</div>";
                }
                $id = $game['id'];
                $PVP = $game['PVP'];

                echo "          <div id=\"columna3\"><input type='text' name='cantidad_$id' size='5'/></div>
                             </div>";
            }
            echo "      </div>
                    </form>
                </div>
            </div>";
        }else{
            echo "<div id=\"content\">
                    <div id=\"main\">
                        <div id=\"login\">
                            <div id=\"contenedor\">
                                <div id=\"contenidos\">
                                    <div id=\"columna1\"><a href=\"gestionar.php?tipo=".$_SESSION["tipo"]."&pag=gPedidos\" class=\"boton\">Ver Pedidos</a></div>
                                    <div id=\"columna1\"><a href=\"gestionar.php?tipo=".$_SESSION["tipo"]."&pag=gProductos\" class=\"boton\">Hacer pedido nuevo</a></div>
                                </div>
                            </div>
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
                    echo "<div id=\"contenedor\">
                            <div id=\"contenidos\">";
                    foreach($game as $field=>$value){
                        echo "  <div id=\"cabecera\">$field</div>";
                    }
                    $first = false;
                    echo "  </div>";
                }
                echo "      <div id=\"contenidos\">";
                foreach($game as $value){
                    echo "      <div id=\"columna1\">$value</div>";
                }
                $total+=$game['PVP']*$game['unidades'];
                echo "      </div>";

            }
            echo "      </div>
                        <div id=\"contenedor\">
                            <div id=\"contenidos\">
                                <div id=\"columna2\"> Total: $total&euro;</div>
                            </div>
                        </div>
                    </div>
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
                            <div id=\"contenedor\">
                                <div id=\"contenidos\">
                                    <div id=\"columna1\"><a onclick=\"crear.submit()\"><h1> Asignarse Pedido<span class='icon-cart'></span></h1></a></div>
                                </div>
                            </div>
                            <div id=\"contenedor\">
                                <div id=\"contenidos\">";
                    foreach($game as $field=>$value){
                        echo "      <div id=\"cabecera\">$field</div>";
                    }
                    $first = false;
                    echo "          <div id=\"cabecera\"></div>
                                </div>";
                }
                echo "          <div id=\"contenidos\">";
                foreach($game as $value){
                    echo "          <div id=\"columna1\">$value</div>";
                }
                $id = $game['id'];
                echo "              <div id=\"columna3\"><input type='checkbox' name='$id' value='$id'/></div>
                                </div>";
            }
            echo '          </div>
                        </form>
                    </div>
                </div>';
        }else{
            echo "<div id=\"content\">
                    <div id=\"main\">
                        <div id=\"login\">
                            <div id=\"contenedor\">
                                <div id=\"contenidos\">
                                    <div id=\"columna1\"><a href=\"gestionar.php?tipo=".$_SESSION["tipo"]."&pag=gMPedidos\" class=\"boton\">Modificar Pedidos</a></div>
                                    <div id=\"columna1\"><a href=\"gestionar.php?tipo=".$_SESSION["tipo"]."&pag=gAPedidos\" class=\"boton\">Asignarse pedido nuevo</a></div>
                                </div>
                            </div>
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
                    echo "<div id=\"contenedor\">
                            <div id=\"contenidos\">";
                    foreach($game as $field=>$value){
                        echo "  <div id=\"cabecera\">$field</div>";
                    }
                    $first = false;
                    echo "      <div id=\"cabecera\">Repartir</div>
                                <div id=\"cabecera\">Entregar</div>
                            </div>";
                }
                echo "      <div id=\"contenidos\">";
                foreach($game as $value){

                        echo "  <div id=\"columna1\">$value</div>";

                }
                $id = $game['id'];

                echo "          <div id=\"columna1\"><a href=\"repartidores.php?tipo=".$_SESSION["tipo"]."&id=$id&pagina=repartir\"><span class='icon-truck big'></span></a></div>
                                <div id=\"columna1\"><a href=\"repartidores.php?tipo=".$_SESSION["tipo"]."&id=$id&pagina=entregar\"><span class='icon-stopwatch big'></span></a></div>
                            </div>";
            }
            echo '      </div>
                    </div>
                </div>';
        }
    }

    public static function end(){
        echo '</body>
</html>';
    }
}

