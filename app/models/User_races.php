<?php
    namespace App\Models;

    // require_once(__ROOT__.'/database/Connection.php');
    use App\Database\Connections;
    use App\Models\User;

    class UserRace{
        private $id;
        private $user_id;
        private $data;
        private $hour;
        private $status;
        private $meeting_point;
        private $delivery_point;

        private $user;

        public function __construct(Connection $connec){
            $this->connection = $connec;

            $this->user = new User(new Connection);
        }

        public function list(){
            $userRaces = array();
            $sql = "SELECT * FROM user_races";
            $result = $this->connection->connect->prepare($sql);
            
            if($result->execute()){
                while ($outputData = $result->fetch(\PDO::FETCH_ASSOC)) {
                    $userRaces[$outputData['id']] = array(
                        'id' => $outputData['id'],
                        'user_id' => $outputData['user_id'],
                        'data' => $outputData['date'],
                        'status' => $outputData['status'],
                        'meeting_point' => $outputData['meeting_point'],
                        'delivery_point' => $outputData['delivery_point']
                    );
                }

                return json_encode($userRaces);
            }else{
                return false;
            }

            
        }

        public function listUsersRaces(){
            $userRaces = array();
            $sql = "SELECT * FROM user_races";
            $result = $this->connection->connect->prepare($sql);
            
            if($result->execute()){
                while ($outputData = $result->fetch(\PDO::FETCH_ASSOC)) {
                    $userRaces[$outputData['id']] = array(
                        'id' => $outputData['id'],
                        'user_name' => $this->user->getName($outputData['user_id']),
                        'data' => $outputData['date'],
                        'status' => $outputData['status'],
                        'meeting_point' => $outputData['meeting_point'],
                        'delivery_point' => $outputData['delivery_point']
                    );
                }

                return json_encode($userRaces);
            }else{
                return false;
            }

        }
        
        public function getUserId($id){
            $sql = "SELECT user_id FROM user_races WHERE id = '{$id}'";
            $result = $this->connection->connect->query( $sql );

            return $result->fetchAll();
        }

        public function getData($id){
            $sql = "SELECT data FROM user_races WHERE id = '{$id}'";
            $result = $this->connection->connect->query( $sql );

            return $result->fetchAll();
        }

        public function getHour($id){
            $sql = "SELECT hour FROM user_races WHERE id = '{$id}'";
            $result = $this->connection->connect->query( $sql );

            return $result->fetchAll();
        }
        
        public function setHour($id, $hour){
            $sql_query = "UPDATE user_races SET hour = :hour WHERE id = '{$id}'";

            $update_data = $this->connection->connect->prepare($sql_query);
            $update_data->bindParam(':hour', $hour);

            if($update_data->execute()){
                return true;
            }else{
                return false;
            }
        }

        public function getStatus($id){
            $sql = "SELECT status FROM user_races WHERE id = '{$id}'";
            $result = $this->connection->connect->query( $sql );

            return $result->fetchAll();
        }
        
        public function setStatus($id, $status){
            $sql_query = "UPDATE user_races SET status = :status WHERE id = '{$id}'";

            $update_data = $this->connection->connect->prepare($sql_query);
            $update_data->bindParam(':status', $status);

            if($update_data->execute()){
                return true;
            }else{
                return false;
            }
        }

        public function getMeetingPoint($id){
            $sql = "SELECT meeting_point FROM user_races WHERE id = '{$id}'";
            $result = $this->connection->connect->query( $sql );

            return $result->fetchAll();
        }
        
        public function setMeetingPoint($id, $meetingPoint){
            $sql_query = "UPDATE user_races SET meeting_point = :meetingPoint WHERE id = '{$id}'";

            $update_data = $this->connection->connect->prepare($sql_query);
            $update_data->bindParam(':meetingPoint', $meetingPoint);

            if($update_data->execute()){
                return true;
            }else{
                return false;
            }
        }

        public function getDeliveryPoint($id){
            $sql = "SELECT delivery_point FROM user_races WHERE id = '{$id}'";
            $result = $this->connection->connect->query( $sql );

            return $result->fetchAll();
        }
        
        public function setDeliveryPoint($id, $deliveryPoint){
            $sql_query = "UPDATE user_races SET delivery_point = :deliveryPoint WHERE id = '{$id}'";

            $update_data = $this->connection->connect->prepare($sql_query);
            $update_data->bindParam(':deliveryPoint', $deliveryPoint);

            if($update_data->execute()){
                return true;
            }else{
                return false;
            }
        }

        public function create($user_id, $date, $hour, $status, $meetingPoint, $deliveryPoint){
            $sql_query = "INSERT INTO user_races (user_id, date, hour, status, meeting_point, delivery_point) VALUES (:user_id, :date, :hour, :status, :meeting_point, :delivery_point)";

            $insert_data = $this->connection->connect->prepare($sql_query);
            $insert_data->bindParam(':user_id', $user_id);
            $insert_data->bindParam(':date',$date);
            $insert_data->bindParam(':hour', $hour);
            $insert_data->bindParam(':status', $status);
            $insert_data->bindParam(':meeting_point', $meetingPoint);
            $insert_data->bindParam(':delivery_point', $deliveryPoint);

            if($insert_data->execute()){
                return true;
            }else{
                return false;

            }
        }
    }
?>