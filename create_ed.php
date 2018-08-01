<?php
  require_once('mongodbconn.php');
  $typeEvent = "";

    if(isset($_POST['btn_ed'])){
        $typeEvent = $_POST['typeEvent'];

    if(!$typeEvent ){
        $flag = 5;
    }
    else{
        $insRec       = new MongoDB\Driver\BulkWrite;
        $insRec->insert(['typeEvent' =>$typeEvent]);
        $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
        $result       = $manager->executeBulkWrite('thesis.eventdata', $insRec, $writeConcern);

        if($result->getInsertedCount()){
            $flag = 3;
        }else{
            $flag = 2;
        }
    }
  }
  header("Location: index.php?flag=$flag");
  exit;
