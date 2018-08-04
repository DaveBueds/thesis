<?php
  require 'database.php';
  $typeEvent = "";

  $valid = true;

  if(!empty($_POST)){
    $typeEvent = $_POST['typeEvent'];

    if(empty($typeEvent) ){
      $flag = 5;
      $valid = false;
    }

    if($valid){
      $pdo = Database::connect();
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "INSERT INTO EventData (typeEvent) values(?)";
      $q = $pdo->prepare($sql);
      $q->execute(array($typeEvent));
      Database::disconnect();
      $flag = 3;
      header("Location: index.php?flag=$flag");
    }
    else {
      $flag = 2;
      header("Location: index.php?flag=$flag");
    }        
  }