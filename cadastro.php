<?php

  $dbhost = 'localhost';
  $user = 'root';
  $dbname = 'wls_db';
  $password = '';

  try {
    $PDO = new PDO( 'mysql:host=' . $dbhost . ';dbname=' .  $dbname, $user, $password );


  }
  catch ( PDOException $e ) {
    echo 'Erro ao conectar com o MySQL: ' . $e->getMessage();
  }

    // echo "{$_POST['date']}";
    // echo "{$_POST['hour']}";
    // echo "{$_POST['meetingPoint']}";
    // echo "{$_POST['destiny']}";

    // $sql = "INSERT INTO user_races VALUES ('{$_POST['userID']}', '{$_POST['data']}', '{$_POST['hour']}', 'OK', '{$_POST['meetingPoint']}', '{$_POST['destiny']}')";
    
    // $result = $PDO->prepare($sql);
    // $rows = $result->fetchAll();

    $sql_query = "INSERT INTO user_races (user_id, date, hour, status, meeting_point, delivery_point) VALUES (:user_id, :date, :hour, :status, :meeting_point, :delivery_point)";

    $insert_data = $PDO->prepare($sql_query);
    $insert_data->bindParam(':user_id', $_POST['userID']);
    $insert_data->bindParam(':date', $_POST['date']);
    $insert_data->bindParam(':hour', $_POST['hour']);
    $insert_data->bindParam(':status', $_POST['status']);
    $insert_data->bindParam(':meeting_point', $_POST['meetingPoint']);
    $insert_data->bindParam(':delivery_point', $_POST['destiny']);

    if($insert_data->execute()){
      $_SESSION['msg'] = "<p style='color:green;'>Deu certo</p>";
      header("Location: index.php");
    }else{
      $_SESSION['msg'] = "<p style='color:red;'>Erro</p>";
      header("Location: index.php");

    }

?>