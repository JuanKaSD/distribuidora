<?php
class Mod{
    public static function conectar(){
        if ($db = new PDO('sqlite:./datos.db')){
            $db->exec('PRAGMA foreign_keys = ON;'); //Activa la integridad referencial para esta conexión
            return($db);
        }
    }

    public static function borrarRegistro($tabla,$id){
        Mod::conectar()->query('DELETE FROM ['.$tabla.'] WHERE id='.$id.';');
    }

    public static function editarUsuario($datos){
        //        Mod::conectar()->query('DELETE FROM ['.$tabla.'] WHERE id='.$id.';');
    }

    public static function crearUsuario($datos){
       Mod::conectar()->query("INSERT INTO [usuarios] ([usuario], [clave], [nombre], [tipo], [poblacion], [direccion]) VALUES ('".$datos['usuario']."', '".$datos['clave']."', '".$datos['nombre']."', '".$datos['tipo2']."', '".$datos['poblacion']."', '".$datos['direccion']."');");
        // Mod::conectar()->query('DELETE FROM ['.$tabla.'] WHERE id='.$id.';');
    }

    public static function iniDb(){                             //función para inicar la base de datos
        //conectando con base de datos
        $db = Mod::conectar();
        //borrando tablas si ya han estado creadas
        $db->query("DROP TABLE IF EXISTS [usuarios];
                DROP TABLE IF EXISTS [bebidas];
                DROP TABLE IF EXISTS [pedidos];
                DROP TABLE IF EXISTS [lineaspedidos];");

        //creando tablas nuevas
        $db->query("CREATE TABLE [usuarios]
                (
                    [id] INTEGER PRIMARY KEY,
                    [usuario] NVARCHAR(20) NOT NULL,
                    [clave] NVARCHAR(32) NOT NULL,
                    [nombre] NVARCHAR(200) DEFAULT '',
                    [tipo] INTEGER DEFAULT 2,
                    [poblacion] NVARCHAR(200) DEFAULT '',
                    [direccion] NVARCHAR(200) DEFAULT ''
                );");

        //creando el indice
        $db->query("CREATE UNIQUE INDEX IF NOT EXISTS [indexusuario] on [usuarios] ([usuario]);");


        $db->query("CREATE TABLE [bebidas]
                (
                    [id] INTEGER PRIMARY KEY,
                    [marca] NVARCHAR(60),
                    [stock] INTEGER,
                    [PVP] DECIMAL(10,2)
                );");

        $db->query("CREATE TABLE [pedidos]
                (
                    [id] INTEGER PRIMARY KEY,
                    [idcliente] INTEGER NOT NULL,
                    [poblacionentrega] NVARCHAR(200) DEFAULT '',
                    [direccionentrega] NVARCHAR(200) DEFAULT '',
                    [horacreacion] INTEGER NOT NULL,
                    [idrepartidor] INTEGER DEFAULT NULL,
                    [horaasignacion] INTEGER,
                    [horareparto] INTEGER DEFAULT 0,
                    [horaentrega] INTEGER DEFAULT 0,
                    [PVP] INTEGER DEFAULT 0,
                    FOREIGN KEY ([idcliente]) REFERENCES [usuarios] ([id])
                    FOREIGN KEY ([idrepartidor]) REFERENCES [usuarios] ([id])
                );");

        $db->query("CREATE TABLE [lineaspedido]
                (
                    [id] INTEGER PRIMARY KEY,
                    [idpedido] INTEGER  NOT NULL,
                    [idbebida] INTEGER  NOT NULL,
                    [unidades] INTEGER  DEFAULT 0,
                    [PVP] INTEGER NOT NULL,
                    FOREIGN KEY ([idpedido]) REFERENCES [pedidos] ([id])
                        ON DELETE CASCADE,
                    FOREIGN KEY ([idbebida]) REFERENCES [bebidas] ([id])
                        ON DELETE CASCADE
                );");


        if(!fopen("datos.db","r")){  //compruebo que la base de datos ya fue creada para meter los datos solo la primera vez
            //insertando valores por defecto
            $db->query("INSERT INTO [usuarios] ([usuario], [clave], [nombre], [tipo]) VALUES ('adm', 'c4ca4238a0b923820dcc509a6f75849b', 'El Manda Más', 1);");

            $db->query("INSERT INTO [usuarios] ([usuario], [clave], [nombre], [tipo], [poblacion], [direccion]) VALUES ('cli1', 'c81e728d9d4c2f636f067f89cc14862c', 'Bar Vaso Obrero', 2, 'Arucas', 'Calle Mayor Nº 33');");

            $db->query("INSERT INTO [usuarios] ([usuario], [clave], [nombre], [tipo], [poblacion], [direccion]) VALUES ('cli2', 'eccbc87e4b5ce2fe28308fd9f2a7baf3', 'Restaurante El Almorzador', 2, 'Telde', 'San Greorio Nº 44');");

            $db->query("INSERT INTO [usuarios] ([usuario], [clave], [nombre], [tipo]) VALUES ('rep1', 'a87ff679a2f3e71d9181a67b7542122c', 'Perengano de Na', 3);");

            $db->query("INSERT INTO [usuarios] ([usuario], [clave], [nombre], [tipo]) VALUES ('rep2', 'e4da3b7fbbce2345d7772b0674a318d5', 'Perengano de Na', 3);");

            $db->query("INSERT INTO [bebidas] ([marca], [stock], [PVP]) VALUES ('Agua artificial', 12000, 1.05);");

            $db->query("INSERT INTO [bebidas] ([marca], [stock], [PVP]) VALUES ('Poca Cola', 10000, 1.85);");

            $db->query("INSERT INTO [bebidas] ([marca], [stock], [PVP]) VALUES ('Falta Naranja', 100200, 1.75);");

            $db->query("INSERT INTO [bebidas] ([marca], [stock], [PVP]) VALUES ('Six Up', 102500, 1.60);");

            $db->query("INSERT INTO [bebidas] ([marca], [stock], [PVP]) VALUES ('Cerveza Subtropical', 30234, 1.90);");

            $db->query("INSERT INTO [bebidas] ([marca], [stock], [PVP]) VALUES ('Vino Pinto', 9008, 5.35);");

            $db->query("INSERT INTO [bebidas] ([marca], [stock], [PVP]) VALUES ('Vino Azul', 3350, 10.75);");

            $db->query("INSERT INTO [pedidos] ([idcliente], [horacreacion], [PVP]) VALUES (2, 1487755441, 952.5);");

            $db->query("INSERT INTO [lineaspedido] ([idpedido], [idbebida], [unidades], [PVP]) VALUES (1, 1, 300, 1.05);");

            $db->query("INSERT INTO [lineaspedido] ([idpedido], [idbebida], [unidades], [PVP]) VALUES (1, 2, 250, 1.85);");

            $db->query("INSERT INTO [lineaspedido] ([idpedido], [idbebida], [unidades], [PVP]) VALUES (1, 3, 100, 1.75);");

            $db->query("INSERT INTO [pedidos] ([idcliente], [horacreacion], [PVP]) VALUES (1, 1487758501, 2982.5);");

            $db->query("INSERT INTO [lineaspedido] ([idpedido], [idbebida], [unidades], [PVP]) VALUES (2, 5, 300, 1.90);");

            $db->query("INSERT INTO [lineaspedido] ([idpedido], [idbebida], [unidades], [PVP]) VALUES (2, 6, 250, 5.35);");

            $db->query("INSERT INTO [lineaspedido] ([idpedido], [idbebida], [unidades], [PVP]) VALUES (2, 7, 100, 10.75);");


        }
    }
}

class DB{
    private static $connection=null;

    public static function get(){
        if(self::$connection === null){
            self::$connection = $db = new PDO("sqlite:./datos.db");
            self::$connection->exec('PRAGMA foreign_keys = ON;');
            self::$connection->exec('PRAGMA encoding="UTF-8";');
            self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$connection;
    }

    public static function execute_sql($sql,$parms=null){
        try {
            $db = self::get();
            $ints= $db->prepare ( $sql );
            if ($ints->execute($parms)) {
                return $ints;
            }
        }
        catch (PDOException $e) {
            echo '<h1>Error en la base de datos: ' . $e->getMessage() . '</h1>';
        }
        return $false;
    }
}


class User{
    public static function session_start(){
        if(session_status () === PHP_SESSION_NONE){
            session_start();
        }
    }

    public static function getLoggedUser(){ //Devuelve un array con los datos del cuenta o false
        self::session_start();
        if(!isset($_SESSION['user'])) return false;
        return $_SESSION['user'];
    }

    public static function login($usuario,$pass){ //Devuelve verdadero o falso según
        self::session_start();
        $db=DB::get();
        $inst=$db->prepare('SELECT * FROM usuarios WHERE usuario=? and clave=?');
        $inst->execute(array($usuario,md5($pass)));
        $inst->setFetchMode(PDO::FETCH_NAMED);
        $res=$inst->fetchAll();
        if(count($res)==1){
            $_SESSION['user']=$res[0]; //Almacena datos del usuario en la sesión
            return true;
        }
        return false;
    }

    public static function logout(){
        self::session_start();
        unset($_SESSION['user']);
    }
}
