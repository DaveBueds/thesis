<?php
  require 'database.php';
  $stadsnaam = "";
  $main = "";
  $temperatuur = 0;
  $kortebeschrijving = "";
  $luchtdruk = 0;
  $vochtigheid = 0;
  $temperatuur_min = 0;
  $temperatuur_max = 0;
  $windsnelheid = 0;
  $windrichting = 0;
  $bewolktheid = 0;

  $valid = true;

  if(!empty($_POST)){
    $stadsnaam = $_POST['stadsnaam'];
    $main = $_POST['main'];
    $temperatuur = $_POST['temperatuur'];
    $kortebeschrijving = $_POST['kortebeschrijving'];
    $luchtdruk = $_POST['luchtdruk'];
    $vochtigheid = $_POST['vochtigheid'];
    $temperatuur_min = $_POST['temperatuur_min'];
    $temperatuur_max = $_POST['temperatuur_max'];
    $windsnelheid = $_POST['windsnelheid'];
    $windrichting = $_POST['windrichting'];
    $bewolktheid = $_POST['bewolktheid'];


    if($valid){
      $pdo = Database::connect();
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "INSERT INTO WeerData (stadsnaam, main, temperatuur, kortebeschrijving, luchtdruk, vochtigheid, temperatuur_min, temperatuur_max, windsnelheid, windrichting, bewolktheid) values(?,?,?,?,?,?,?,?,?,?,?)";
      $q = $pdo->prepare($sql);
      $q->execute(array($stadsnaam,$main,$temperatuur,$kortebeschrijving,$luchtdruk,$vochtigheid,$temperatuur_min,$temperatuur_max,$windsnelheid,$windrichting,$bewolktheid));
      Database::disconnect();
      $flag = 2;
      header("Location: index.php?flag=$flag");
    }
    else {
      $flag = 1;
      header("Location: index.php?flag=$flag");
    }        
  }