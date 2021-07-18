<?php
class Database
{

    private $server;
    private $db;
    private $user;
    private $clave;
    private $charset;

    public function __construct()
    {
        //error_log("DATABASE => Clase Database instanciada");
        $this->server = constant("SERVER");
        $this->db = constant("DB");
        $this->user = constant("USER");
        $this->clave = constant("CLAVE");
        $this->charset = constant("CHARSET");
    }

    public function connect()
    {
        try{

            $cadenaConexion = "mysql:host=".$this->server.";dbname=".$this->db.";charset=".$this->charset;
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];

            $cnx = new PDO($cadenaConexion,$this->user,$this->clave,$options);
            //error_log("DATABASE :: connect() => Retornando objeto de conexion exitosa");
            return $cnx;
            
            
        }catch(PDOException $e)
        {
            error_log("\n DATABASE_ERROR:::::: Error en la conexion :\n ".$e->getMessage());
            //print_r("Connection failed : ".$e->getMessage());
        }
    }

}

?>