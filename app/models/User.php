<?php
    namespace App\Models;
    
    // define('__ROOT__', dirname(dirname(__FILE__)));
    // require_once(__ROOT__.'/database/Connection.php');
    use App\Database\Connections;
    
    class User{
        private $id;
        private $name;
        private $email;
        private $address;
        private $connection;

        public function __construct(Connection $connec){
            $this->connection = $connec;

        }

        public function list(){
            $sql = "SELECT * FROM users";
            $result = $this->connection->connect->query( $sql );

            return $result->fetchAll();
        }
        
        public function getName($id){
            $sql = "SELECT name FROM users WHERE id = '{$id}'";
            $result = $this->connection->connect->query( $sql );

            return $result->fetchAll();
        }

        public function getAddress($id){
            $sql = "SELECT address FROM users WHERE id = '{$id}'";
            $result = $this->connection->connect->query( $sql );

            return $result->fetchAll();
        }

        public function getEmail($id){
            $sql = "SELECT email FROM users WHERE id = '{$id}'";
            $result = $this->connection->connect->query( $sql );

            return $result->fetchAll();
        }
    }
?>