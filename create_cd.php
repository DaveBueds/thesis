<?php
  require 'database.php';
  $locatienaam = "";
  $wegtype = "";
  $ondergrond = "";

  $valid = true;

  if(!empty($_POST)){
    $locatienaam = $_POST['locatienaam'];
    $wegtype = $_POST['wegtype'];
    $ondergrond = $_POST['ondergrond'];

    if(empty($locatienaam) || empty($wegtype) || empty($ondergrond)) {
      $flag = 5;
      $valid = false;
    }

    if($valid){
      $pdo = Database::connect();
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "INSERT INTO CircuitData (locatienaam, wegtype, ondergrond) values(?,?,?)";
      $q = $pdo->prepare($sql);
      $q->execute(array($locatienaam,$wegtype,$ondergrond));
      Database::disconnect();
      $flag = 3;
      header("Location: index.php?flag=$flag");
    }
    else {
      $flag = 2;
      header("Location: index.php?flag=$flag");
    }        
  }