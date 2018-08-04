<?php
  require_once('mongodbconn.php');
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

    if(isset($_POST['btn_wd'])){
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

    /*if(!$stadsnaam || !$main || !$temperatuur || !$kortebeschrijving || !$luchtdruk || !$vochtigheid || !$temperatuur_min || !$temperatuur_max || !$windsnelheid || !$windrichting || !$bewolktheid ){
        $flag = 5;
    }
    else{*/
        $insRec       = new MongoDB\Driver\BulkWrite;
        $insRec->insert(['stadsnaam' =>$stadsnaam, 'main' => $main, 'temperatuur'=>$temperatuur, 'kortebeschrijving'=>$kortebeschrijving, 'luchtdruk'=>$luchtdruk, 'vochtigheid'=>$vochtigheid, 'temperatuur_min'=>$temperatuur_min, 'temperatuur_max'=>$temperatuur_max, 'windsnelheid'=>$windsnelheid, 'windrichting'=>$windrichting, 'bewolktheid'=>$bewolktheid]);
        $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
        $result       = $manager->executeBulkWrite('thesis.weerdata', $insRec, $writeConcern);

        if($result->getInsertedCount()){
            $flag = 3;
        }else{
            $flag = 2;
        }
    //}
  }
  header("Location: index.php?flag=$flag");
  exit;
