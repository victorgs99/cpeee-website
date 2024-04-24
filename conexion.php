<?php
    class Conexion{
        private $host; //Localhost o IP
        private $db; //Nombre de la base de datos
        
        private $usuario; //Nombre del usuario
        private $pass; //Contraseña del usuario
        private $charset; //utf8

        public function __construct(){
            $this->host = 'localhost';
            $this->db = 'cpeee';
            $this->usuario = 'root';
            $this->pass = '';
            $this->charset = 'utf8';
        }

        public function Conectar(){
            #Conectar a la base de datos -> PDO
            $com = "mysql:host=".$this->host.";dbname=".$this->db.";charset=".$this->charset;
            $enlace = new PDO($com, $this->usuario, $this->pass);
            return $enlace;
        }
    }
?>