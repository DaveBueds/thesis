<?php
  require_once('mongodbconn.php');
  $toespoor = 0;
  $camber = 0;
  $banden = "";
  $hoogte = 0;
  $veer = "";
  $torsieveer = "";
  $LR_LSB = 0;
  $LR_HSB = 0;
  $LR_R = 0;
  $M_HSB = 0;
  $M_LSB = 0;
  $M_R = 0;

  if(isset($_POST['btn_md'])){
        $toespoor = $_POST['toespoor'];
        $camber = $_POST['camber'];
        $banden = $_POST['banden'];
        $hoogte = $_POST['hoogte'];
        $veer = $_POST['veer'];
        $torsieveer = $_POST['torsieveer'];
        $LR_HSB = $_POST['LR_HSB'];
        $LR_LSB = $_POST['LR_LSB'];
        $LR_R = $_POST['LR_R'];
        $M_HSB = $_POST['M_HSB'];
        $M_LSB = $_POST['M_LSB'];
        $M_R = $_POST['M_R'];

    if(!$toespoor || !$camber || !$banden || !$hoogte || !$veer || !$torsieveer || !$LR_HSB || !$LR_LSB || !$LR_R || !$M_HSB || !$M_LSB || !$M_R){
        $flag = 5;
    }
    else{
        $insRec       = new MongoDB\Driver\BulkWrite;
        $insRec->insert(['toespoor' =>$toespoor, 'camber'=>$camber, 'banden'=>$banden, 'hoogte'=>$hoogte, 'veer'=>$veer, 'torsieveer'=>$torsieveer, 
        'LR_HSB'=>$LR_HSB, 'LR_LSB'=>$LR_LSB, 'LR_R'=>$LR_R, 'M_HSB'=>$M_HSB, 'M_LSB'=>$M_LSB, 'M_R'=>$M_R ]);
        $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
        $result       = $manager->executeBulkWrite('thesis.mechanischedata', $insRec, $writeConcern);

        if($result->getInsertedCount()){
            $flag = 3;
        }else{
            $flag = 2;
        }
    }
  }
  header("Location: index.php?flag=$flag");
  exit;
