<?php

require 'database.php';

$data = "";
$valid = true;

if ( !empty($_POST)) {
	$data = $_POST['data'];

	$en_data = json_decode($data);

	if( empty($en_data) ) {
		$flag = 3;
		$valid = false;
		echo json_encode($flag);
	}
	if($valid){
		//$en_data = json_decode($data);
		
		for ($i=0; $i < count($en_data); $i++) {

			$md_val = $en_data[$i]->md_val;
		    $cd_val = $en_data[$i]->cd_val;
		    $wd_val = $en_data[$i]->wd_val;
		    $totaalTijd = $en_data[$i]->totaalTijd;

		    $type_1_avg = $en_data[$i]->type_1_avg;
		    $type_2_avg = $en_data[$i]->type_2_avg;
		    $type_3_avg = $en_data[$i]->type_3_avg;
		    $type_4_avg = $en_data[$i]->type_4_avg;
		    $type_5_avg = $en_data[$i]->type_5_avg;
		    $type_6_avg = $en_data[$i]->type_6_avg;
		    $type_7_avg = $en_data[$i]->type_7_avg;
		    $type_8_avg = $en_data[$i]->type_8_avg;
		    $type_9_avg = $en_data[$i]->type_9_avg;
		    $type_10_avg = $en_data[$i]->type_10_avg;
		    $type_11_avg = $en_data[$i]->type_11_avg;
		    $type_12_avg = $en_data[$i]->type_12_avg;
		    $type_13_avg = $en_data[$i]->type_13_avg;
		    $type_14_avg = $en_data[$i]->type_14_avg;
		    $type_15_avg = $en_data[$i]->type_15_avg;
		    $type_16_avg = $en_data[$i]->type_16_avg;
		    $type_17_avg = $en_data[$i]->type_17_avg;
		    $type_18_avg = $en_data[$i]->type_18_avg;
		    $type_19_avg = $en_data[$i]->type_19_avg;
		    $type_20_avg = $en_data[$i]->type_20_avg;
		    $type_21_avg = $en_data[$i]->type_21_avg;
		    $type_22_avg = $en_data[$i]->type_22_avg;
		    $type_23_avg = $en_data[$i]->type_23_avg;
		    $type_24_avg = $en_data[$i]->type_24_avg;
		    $type_25_avg = $en_data[$i]->type_25_avg;
		    $type_26_avg = $en_data[$i]->type_26_avg;
		    $type_27_avg = $en_data[$i]->type_27_avg;
		    $type_28_avg = $en_data[$i]->type_28_avg;
		    $type_29_avg = $en_data[$i]->type_29_avg;
		    $type_30_avg = $en_data[$i]->type_30_avg;
		    $type_31_avg = $en_data[$i]->type_31_avg;
		    $type_32_avg = $en_data[$i]->type_32_avg;
		    $type_33_avg = $en_data[$i]->type_33_avg;
		    $type_34_avg = $en_data[$i]->type_34_avg;
		    $type_35_avg = $en_data[$i]->type_35_avg;
		    $type_36_avg = $en_data[$i]->type_36_avg;
		    $type_37_avg = $en_data[$i]->type_37_avg;
		    $type_38_avg = $en_data[$i]->type_38_avg;
		    $type_39_avg = $en_data[$i]->type_39_avg;
		    $type_40_avg = $en_data[$i]->type_40_avg;
		    $type_41_avg = $en_data[$i]->type_41_avg;
		    $type_42_avg = $en_data[$i]->type_42_avg;
		    $type_43_avg = $en_data[$i]->type_43_avg;
		    $type_44_avg = $en_data[$i]->type_44_avg;
		    $type_45_avg = $en_data[$i]->type_45_avg;
		    $type_46_avg = $en_data[$i]->type_46_avg;
		    $type_100_avg = $en_data[$i]->type_100_avg;
		    $type_101_avg = $en_data[$i]->type_101_avg;
		    $type_102_avg = $en_data[$i]->type_102_avg;


	      	$pdo = Database::connect();
	      	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	      	
	      	$sql = "INSERT INTO Trainingset (md_val, cd_val, wd_val, totaalTijd,temp_avg, speed_avg,steeringangle_avg, voltage_avg, brakepedal_avg, acc_pedal1_avg, acc_pedal2_avg, brakelight_avg, fanrl_avg, fanrr_avg, drs_avg, lowcellvoltage_avg, highcellvoltage_avg, lowcelltemp,highcelltemp,soc_avg, fs1_avg, fs2_avg, fs3_avg, fs4_avg, regen_avg, current_avg, fan_sl_avg, fan_sr_avg, left_radtemp_avg, right_radtemp_avg, susf1_avg, susf2_avg, susf3_avg, susr1_avg, susr2_avg, susr3_avg, power_avg, mlf_temp_avg, mlr_temp_avg, mrf_temp_avg, mrr_temp_avg, mlf_rpm_avg, mlr_rpm_avg, mrf_rpm_avg, mrr_rpm_avg, speedecu_avg, invtemplf_avg, invtemprf_avg, invtemplr_avg, invtemprr_avg, gforcex_avg, gforcey_avg, balancerf_avg) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
	      	$q = $pdo->prepare($sql);
	      	$q->execute(array($md_val, $cd_val, $wd_val, $totaalTijd,$type_1_avg, $type_2_avg,$type_3_avg,$type_4_avg,$type_5_avg,$type_6_avg,$type_7_avg,$type_8_avg,$type_9_avg,$type_10_avg,$type_11_avg,$type_12_avg,$type_13_avg,$type_14_avg,$type_15_avg,$type_16_avg,$type_17_avg,$type_18_avg,$type_19_avg,$type_20_avg,$type_21_avg,$type_22_avg,$type_23_avg,$type_24_avg,$type_25_avg,$type_26_avg,$type_27_avg,$type_28_avg,$type_29_avg,$type_30_avg,$type_31_avg,$type_32_avg,$type_33_avg,$type_34_avg,$type_35_avg,$type_36_avg,$type_37_avg,$type_38_avg,$type_39_avg,$type_40_avg,$type_41_avg,$type_42_avg,$type_43_avg,$type_44_avg,$type_45_avg,$type_46_avg,$type_100_avg,$type_101_avg,$type_102_avg));
	      	Database::disconnect();
		}

		$flag = 2;
		echo json_encode($flag);
		
    }
    else {
    	$flag = 3;
      	echo json_encode($flag);
    }  
}

?>