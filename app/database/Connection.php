<?php
    namespace App\Models;

    class Connection{

        private $dbhost = 'localhost';
        private $user = 'root';
        private $dbname = 'wls_db';
        private $password = '';
        public $connect;
        private $teste;

        public function __construct(){
            try {
                $this->connect = new \PDO('mysql:host=' . $this->dbhost . ';dbname=' . $this->dbname, $this->user, $this->password);
                
            } catch ( PDOException $e ) {
                echo 'Erro ao conectar com o MySQL: ' . $e->getMessage();
            }
            
        }

    }

?>