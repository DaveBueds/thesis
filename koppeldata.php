<?php

require_once('mongodbconn.php');

$data = "";
$d = array();
$flag = 2;

if(isset($_POST['data'])){
	$data = $_POST['data'];

	if(!$data) {
		$flag = 5;
		echo json_encode($flag);
	}
	else {
		$en_data = json_decode($data);
		//$d['status'] = $en_data[1]->type;
		//$d['length'] = count($en_data);
		//echo json_encode($flag);


	        for ($i=0; $i < count($en_data); $i++) { 
	        	$insRec       = new MongoDB\Driver\BulkWrite;
	        	$insRec->insert([	
	        		'md_val' => $en_data[$i]->md_val,
	        		'cd_val' => $en_data[$i]->cd_val,
	        		'ed_val' => $en_data[$i]->ed_val,
	        		'wd_val' => $en_data[$i]->wd_val,
	        		'tijd' => $en_data[$i]->tijd,
	        		'type' => $en_data[$i]->type,
	        		'data' => $en_data[$i]->data,
	        		'unit' => $en_data[$i]->unit,
	        		'GPSid' => $en_data[$i]->gpsid,
	        		'Latitude' => $en_data[$i]->latitude,
	        		'Longitude' => $en_data[$i]->longitude	
	        	]);
	        	$writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
	        	$result       = $manager->executeBulkWrite('thesis.telemetriedata', $insRec, $writeConcern);

	        	
	        	if($result->getInsertedCount()){
	        		$flag = 3;
	        		//echo json_encode($flag);
	        	}else{
	        		$flag = 2;
	        		break;
	        		//echo json_encode($flag);
	        	}	
	        	
	        }
	        echo json_encode($flag);
	    }
	}

	?>