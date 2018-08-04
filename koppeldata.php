<?php

require 'database.php';

$data = "";
$valid = true;

if ( !empty($_POST)) {
	$data = $_POST['data'];

	$en_data = json_decode($data);

	if( empty($en_data) ) {
		$flag = 5;
		$valid = false;
		echo json_encode($flag);
	}
	if($valid){
		//$en_data = json_decode($data);
		
		for ($i=0; $i < count($en_data); $i++) {

			$md_val = $en_data[$i]->md_val;
		    $cd_val = $en_data[$i]->cd_val;
		    $ed_val = $en_data[$i]->ed_val;
		    $wd_val = $en_data[$i]->wd_val;
		    $tijd = $en_data[$i]->tijd;
		    $type = $en_data[$i]->type;
		    $data = $en_data[$i]->data;
		    $unit = $en_data[$i]->unit;
		    $gpsid = $en_data[$i]->gpsid;
		    $latitude = $en_data[$i]->latitude;
		    $longitude = $en_data[$i]->longitude;	

	      	$pdo = Database::connect();
	      	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	      	$sql = "INSERT INTO Trainingset (md_val,cd_val,ed_val,wd_val,tijd,type,data,unit,gpsid,latitude,longitude) values(?,?,?,?,?,?,?,?,?,?,?)";
	      	$q = $pdo->prepare($sql);
	      	$q->execute(array($md_val,$cd_val,$ed_val,$wd_val,$tijd,$type,$data,$unit,$gpsid,$latitude,$longitude));
	      	Database::disconnect();
		}

		$flag = 3;
		echo json_encode($flag);
		
    }
    else {
    	$flag = 5;
      	echo json_encode($flag);;
    }  
}

?>