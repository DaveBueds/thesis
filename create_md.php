<?php

  require 'database.php';

  $toespoor = 0;
  $camber = 0;
  $banden = "";
  $bandendruk = 0;
  $hoogte = 0;
  $veer = "";
  $torsieveer = "";
  $LR_LSB = 0;
  $LR_HSB = 0;
  $LR_R = 0;
  $M_HSB = 0;
  $M_LSB = 0;
  $M_R = 0;

  $valid = true;

  if(!empty($_POST)){
    $toespoor = $_POST['toespoor'];
    $camber = $_POST['camber'];
    $banden = $_POST['banden'];
    $bandendruk = $_POST['bandendruk'];
    $hoogte = $_POST['hoogte'];
    $veer = $_POST['veer'];
    $torsieveer = $_POST['torsieveer'];
    $LR_HSB = $_POST['LR_HSB'];
    $LR_LSB = $_POST['LR_LSB'];
    $LR_R = $_POST['LR_R'];
    $M_HSB = $_POST['M_HSB'];
    $M_LSB = $_POST['M_LSB'];
    $M_R = $_POST['M_R'];

    if( empty($toespoor) || empty($camber) || empty($banden) || empty($bandendruk) || empty($hoogte) || empty($veer) || empty($torsieveer) || empty($LR_HSB) || empty($LR_LSB) || empty($LR_R) || empty($M_HSB) || empty($M_LSB) || empty($M_R)){
      $flag = 3;
      $valid = false;
    }
    
    if($valid){
      $pdo = Database::connect();
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "INSERT INTO MechanicalData (toespoor,camber,banden,bandendruk,hoogte,veer,torsieveer,LR_HSB,LR_LSB,LR_R,M_HSB,M_LSB,M_R) values(?,?,?,?,?,?,?,?,?,?,?,?,?)";
      $q = $pdo->prepare($sql);
      $q->execute(array($toespoor,$camber,$banden,$bandendruk,$hoogte,$veer,$torsieveer,$LR_HSB,$LR_LSB,$LR_R,$M_HSB,$M_LSB,$M_R));
      Database::disconnect();
      $flag = 2;
      header("Location: index.php?flag=$flag");
    }
    else {
      $flag = 1;
      header("Location: index.php?flag=$flag");
    }        
  }
?>