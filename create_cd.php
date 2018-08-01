<?php
  require_once('mongodbconn.php');
  $locatienaam = "";
  $wegtype = "";
  $ondergrond = "";

    if(isset($_POST['btn_cd'])){
        $locatienaam = $_POST['locatienaam'];
        $wegtype = $_POST['wegtype'];
        $ondergrond = $_POST['ondergrond'];

    if(!$locatienaam || !$wegtype || !$ondergrond){
        $flag = 5;
    }
    else{
        $insRec       = new MongoDB\Driver\BulkWrite;
        $insRec->insert(['locatienaam' =>$locatienaam, 'wegtype'=>$wegtype, 'ondergrond'=>$ondergrond]);
        $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
        $result       = $manager->executeBulkWrite('thesis.circuitdata', $insRec, $writeConcern);

        if($result->getInsertedCount()){
            $flag = 3;
        }else{
            $flag = 2;
        }
    }
  }
  header("Location: index.php?flag=$flag");
  exit;
