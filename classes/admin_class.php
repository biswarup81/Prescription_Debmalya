<?php

class admin{
    function calcAge ($birthday){

	 $birth = strtotime($birthday);

	$age_in_seconds = time() - $birth;
	$AgeYears = floor($age_in_seconds / 31536000); // 31536000 seconds in year
	$AgeMonth  = floor(($age_in_seconds  - $AgeYears * 31536000) / 2628000); // 2628000 seconds in a month
	$AgeDays = floor(($age_in_seconds - $AgeYears * 31536000 - $AgeMonth * 2628000)/ 86400) ; //86400 seconds in a day
		
	//$result = $AgeYears . " years " . $AgeMonth . " months " . $AgeDays . " days";
        $result = $AgeYears . " Y " . $AgeMonth . " M ";
    
    return $result;
    }
    
    function calcAge1 ($birthday, $visitday){

	 $birth = strtotime($birthday);
         $visit = strtotime($visitday);

	$age_in_seconds = $visit - $birth;
	$AgeYears = floor($age_in_seconds / 31536000); // 31536000 seconds in year
	$AgeMonth  = floor(($age_in_seconds  - $AgeYears * 31536000) / 2628000); // 2628000 seconds in a month
	$AgeDays = floor(($age_in_seconds - $AgeYears * 31536000 - $AgeMonth * 2628000)/ 86400) ; //86400 seconds in a day
        
        if($AgeMonth > 6){
            $AgeYears = $AgeYears + 1;
        }
  
		
	//$result = $AgeYears . " years " . $AgeMonth . " months " . $AgeDays . " days";
        //$result = $AgeYears . " Y " . $AgeMonth . " M ";
        $result = $AgeYears . " Y ";
        return $result;
    }
    
    function calcBMI($weight, $height){
        $bmi = floor(($weight / ($height * $height)) * 10000);
        return $bmi;
    }
    function calcEGFR($sex, $cr, $age){
        $k = 0;
        if($sex == 'Male'){
            $k = 1.210;
        } else {
            $k = 0.742 ;
        }
        $eGFR = floor($k * 186 * pow($cr, -1.154) * pow($age,-0.203));
        return $eGFR;
    }
    function deriveClinicalImpressionFromEGFR($eGFR){
        $cf = "";
        if($eGFR >= 90 ){
            $cf = "CKD-1";
        } else if($eGFR < 90 && $eGFR >= 60 ){
            $cf = "CKD-2";
        }else if($eGFR < 60 && $eGFR >= 30 ){
            $cf = "CKD-3";
        }else if($eGFR < 30 && $eGFR >= 15 ){
            $cf = "CKD-4";
        }else if($eGFR < 15 ){
            $cf = "CKD-5";
        }
        return $cf;
    }
    
    function insertUpdatePatientInvestigation($investigation_name, $type, $unit, $value, $patient_id, $visit_id,$chamber_name,$doc_name){
        $admin = new admin();
        if(strtoupper($investigation_name) == "CREATININE" ){
        	$patient = $admin->getPatientDetailsPatientId($patient_id,$chamber_name,$doc_name);
        	$age = $admin->calcAge($patient->patient_dob);
            //echo $age;
            $sex = $patient->GENDER;
            $cr = $value;
            $eGFR = $admin->calcEGFR($sex, $cr, $age);
            //echo $eGFR;
            //INSERT $eGFR in C/F
            $admin->insertUpdateCF("eGFR", $eGFR, $visit_id,$chamber_name,$doc_name);
            //echo "inserted";
            $clinicalImpression = $admin->deriveClinicalImpressionFromEGFR($eGFR);
            
            //GET PRESCRIPTION ID FROM VISIT ID
            $prescription = $admin->getPrescriptionFromVisitId($visit_id,$chamber_name,$doc_name);
            $prescription_id = $prescription->PRESCRIPTION_ID;
            $admin->insertUpdateClinicalImpression($prescription_id, $clinicalImpression,$chamber_name,$doc_name);
        }
        
        $query_getinvestigation_details_from_master = "select * from investigation_master a where  a.investigation_name  = '".$investigation_name."' and a.chamber_id='$chamber_name' AND a.doc_id='$doc_name' and a.STATUS='ACTIVE'" ;

        $result = mysql_query($query_getinvestigation_details_from_master) or die(mysql_error());
        if (mysql_num_rows($result) > 0){
            //Investigation exists in Master. Only insert into patient_investigation table
            $rowresult = mysql_fetch_object($result) or die(mysql_error());
            //Get the investigation Id
            $inv_id = $rowresult->ID;
            
            //update investigation master
            mysql_query("update investigation_master a set  a.unit = '$unit' where a.ID ='$inv_id' AND a.chamber_id='$chamber_name' AND a.doc_id='$doc_name'" ) or die(mysql_error());

        //INsert into patient_investigation
            $query_insert_into_patient_investigation = "insert into patient_investigation (patient_id, visit_id, investigation_id, value, chamber_id, doc_id) 
                                                    values ('".$patient_id."','".$visit_id."','".$inv_id."','".$value."','".$chamber_name."','".$doc_name."')";
            mysql_query($query_insert_into_patient_investigation) or die(mysql_error());
        } else {
        	$inv_id = $admin->getMaxInvestigationID($chamber_name, $doc_name);
            //Investigation does not exists in database
            //Insert into investigation_master 
            $query_insert_into_investigation_master = "insert into investigation_master (ID	, investigation_name , investigation_type, unit, chamber_id, doc_id)
                                                        values('".$inv_id."','".$investigation_name."','".$type."','".$unit."','".$chamber_name."','".$doc_name."')";
            echo $query_insert_into_investigation_master;
            mysql_query($query_insert_into_investigation_master) or die(mysql_error());
            //Get the investigation Id
            //$inv_id = mysql_insert_id() or die(mysql_error());

            //INsert into patient_investigation
            
            $query_insert_into_patient_investigation = "insert into patient_investigation (patient_id, visit_id, investigation_id, value, chamber_id, doc_id) 
                                                    values ('".$patient_id."','".$visit_id."','".$inv_id."','".$value."','".$chamber_name."','".$doc_name."')";
            echo $query_insert_into_patient_investigation;
            mysql_query($query_insert_into_patient_investigation) or die(mysql_error());

        }
    }
    
    function deletePatientInvestigation($investigation_id,$visit_id,$chamber_name,$doc_name ){
        
    	$deletQuery = "delete from patient_investigation
    	where investigation_id = '$investigation_id'
    	and visit_id ='$visit_id' AND chamber_id='$chamber_name' AND doc_id='$doc_name'";
    	//echo $deletQuery;
    	mysql_query($deletQuery) or die(mysql_error());
        
        
        $admin = new admin();
        //get prescription id
        $prescription = $admin->getPrescriptionFromVisitId($visit_id,$chamber_name,$doc_name);
        $prescription_id = $prescription->PRESCRIPTION_ID;
        
        //get investigation
        $investigation = $admin->getInvestigationFromId($investigation_id,$chamber_name,$doc_name);
        $investigation_name = $investigation->investigation_name;
        
       
                
         if(strtoupper($investigation_name) == "CREATININE" ){
            //Delete from clinical impression
             //get ci_id
            $_QUERY12 = "select a.clinical_impression_id from prescribed_cf a, clinical_impression b
						where b.type in ( 'CKD-1', 'CKD-2', 'CKD-3', 'CKD-4', 'CKD-5' ) and
						a.chamber_id=b.chamber_id and a.doc_id = b.doc_id and 
						a.clinical_impression_id = b.ID and
						a.prescription_id = '$prescription_id' and a.chamber_id='$chamber_name' and a.doc_id='$doc_name'";
            
            $result12 = mysql_query($_QUERY12)or die(mysql_error());
            $ci_id = "";
            if(mysql_num_rows($result12) > 0){
                while($rs12 = mysql_fetch_array($result12)){
                    $ci_id = $rs12['clinical_impression_id'];
                }
            }
            
            $admin->deleteClinicalImpression($prescription_id, $ci_id, $chamber_name, $doc_name);
            //Delete from Health Details (CF)
            //Get Id from NAME from patient_health_details_master
            $healthDetails = $admin->getHealthDetailsbyName("eGFR",$chamber_name,$doc_name);
            $id = $healthDetails->ID;
            $admin->deleteCF("DELETE", $id, $visit_id, "BLANK", $chamber_name, $doc_name);
            
        }
        
        

    }
    function getHealthDetailsbyName($name,$chamber_name,$doc_name){
        $_QUERY = "select * from patient_health_details_master a where a.NAME = '".$name."' and a.chamber_id='$chamber_name' and a.doc_id='$doc_name'";
        //echo $_QUERY;
        $result = mysql_query($_QUERY) or die(mysql_error());
        $obj = mysql_fetch_object($result);
        
        return $obj;
    }
    function deleteCF($mode, $cf_id, $visit_id, $cfvalue,$chamber_name,$doc_name){
        $result = "";
        $admin = new admin();
        if($mode == 'UPDATE'){
    
            mysql_query("update patient_health_details a
                        set a.VALUE = '$cfvalue' where a.VISIT_ID = '$visit_id' 
                        and a.ID  ='$cf_id' and a.chamber_id='$chamber_name' and a.doc_id='$doc_name'") or die(mysql_error());
                if (mysql_affected_rows() > 0){
                    $result =  "<tr><td colspan='3'>". mysql_affected_rows() ." item(s) updated</td></tr>";
                }

            } else if($mode == 'DELETE'){
                mysql_query("delete from patient_health_details 
                        where VISIT_ID = '$visit_id' 
                        and ID  ='$cf_id' and chamber_id='$chamber_name' and doc_id='$doc_name'") or die(mysql_error());
                if (mysql_affected_rows() > 0){
                    $result =  "<tr><td colspan='3'>". mysql_affected_rows() ." item(s) deleted</td></tr>";
                }
            }

        if($cf_id == '1' || $cf_id = '2'){
            //Modify BMI
            $result1 = mysql_query("select a.VALUE from patient_health_details a 
                    where a.ID = '1' and a.VISIT_ID = '$visit_id' and a.chamber_id='$chamber_name' and a.doc_id='$doc_name'") or die(mysql_error());

            if(mysql_num_rows($result1) > 0){
                $obj = mysql_fetch_object($result1);
                $height = $obj->VALUE;
            }
            $result2 = mysql_query("select a.VALUE from patient_health_details a 
                    where a.ID = '2' and a.VISIT_ID = '$visit_id' and a.chamber_id='$chamber_name' and a.doc_id='$doc_name'") or die(mysql_error());

            if(mysql_num_rows($result2) > 0){
                $obj = mysql_fetch_object($result2);
                $weight = $obj->VALUE;
            }

            if($height != "" && $weight != ""){
                $bmi = $admin->calcBMI($weight, $height);

                $result_id_f = mysql_query("select * from patient_health_details a where a.ID = '3' AND a.chamber_id='$chamber_name' AND a.doc_id='$doc_name'") or die(mysql_error());
                if(mysql_num_rows($result_id_f) > 0 ){
                    $query_b = "update patient_health_details a set a.VALUE = '$bmi' where a.ID ='3' and VISIT_ID = '".$visit_id."' AND a.chamber_id='$chamber_name' AND a.doc_id='$doc_name'";
                } else {
                $query_b = "insert into patient_health_details(ID, VALUE, VISIT_ID, chamber_id, doc_id) 
                values('3' , '$bmi', '$visit_id', '$chamber_name', '$doc_name')";
                }
                mysql_query($query_b) or die(mysql_error());
            }
        }
        return $result;
    }
    function getPatientDetailsPatientId($patientId,$chamber_name,$doc_name){
        $_QUERY = "select * from patient a where a.patient_id = '".$patientId."' AND a.chamber_id='$chamber_name' AND a.doc_id='$doc_name'";
        $result = mysql_query($_QUERY) or die(mysql_error());
        $obj = mysql_fetch_object($result);
        
        return $obj;
    }
    function getInvestigationFromId($investigation_id,$chamber_name,$doc_name){
        $_QUERY = "select * from investigation_master a where a.ID = '".$investigation_id."' AND a.chamber_id='$chamber_name' AND a.doc_id='$doc_name'";
        $result = mysql_query($_QUERY) or die(mysql_error());
        $obj = mysql_fetch_object($result);
        
        return $obj;
    }
    function getClinicalImpressionfromName($ci_name,$chamber_name,$doc_name){
        $_QUERY = "select * from clinical_impression where TYPE = '".$ci_name."' AND a.chamber_id='$chamber_name' AND a.doc_id='$doc_name'";
        //echo $_QUERY;
        $result = mysql_query($_QUERY) or die(mysql_error());
        $obj = mysql_fetch_object($result);
        
        return $obj;
    }
    function insertUpdateCF($cfname,$cfvalue,$visit_id,$chamber_name,$doc_name){
        
        $admin = new admin();
        $query = "select a.ID from patient_health_details_master a where a.NAME = '$cfname' AND a.chamber_id='$chamber_name' AND a.doc_id='$doc_name'";

        //echo $query;
        $result = mysql_query($query);
        $id = "";
        $height = "";
        $weight = "";
        $bmi = "";
        $ideal_body_weight = "";
        if(mysql_num_rows($result) > 0){
            //Clinical Impression Type exists in the Database. Get the ID
            while($rs = mysql_fetch_array($result)){
                $id = $rs['ID'];
            }
            //echo "id = ".$id;
        } else {
        	$id = $admin->getMaxpatient_health_details_master_id($chamber_name,$doc_name);
            //Insert into master and then add
            $query = "insert into patient_health_details_master (ID, NAME, create_date, chamber_id, doc_id) values('$id', '$cfname', NOW(), '$chamber_name', '$doc_name')";
            echo $query;
            mysql_query($query) or die(mysql_error());
            
        }
        $query = "insert into patient_health_details(ID, VALUE, VISIT_ID, create_date, chamber_id, doc_id) 
                    values('$id' , '$cfvalue', '$visit_id', NOW(), '$chamber_name', '$doc_name')";
        //echo $query;
        mysql_query($query) or die(mysql_error());

        $result1 = mysql_query("select a.VALUE from patient_health_details a 
                where a.ID = '1' and a.VISIT_ID = '$visit_id' AND a.chamber_id='$chamber_name' AND a.doc_id='$doc_name'") or die(mysql_error());
        
        if(mysql_num_rows($result1) > 0){
            $obj = mysql_fetch_object($result1);
            $height = $obj->VALUE;
        }
        $result2 = mysql_query("select a.VALUE from patient_health_details a 
                where a.ID = '2' and a.VISIT_ID = '$visit_id' AND a.chamber_id='$chamber_name' AND a.doc_id='$doc_name'") or die(mysql_error());

        if(mysql_num_rows($result2) > 0){
            $obj = mysql_fetch_object($result2);
            $weight = $obj->VALUE;
        }
        
        if($height != "" && $weight != ""){
            $bmi = $admin->calcBMI($weight, $height);
            $result_id_f = mysql_query("select * from patient_health_details a where 
                a.ID = '3' and a.VISIT_ID = '$visit_id' AND a.chamber_id='$chamber_name' AND a.doc_id='$doc_name'") or die(mysql_error());
            if(mysql_num_rows($result_id_f) > 0 ){
                $query_b = "update patient_health_details a set VALUE = '$bmi' where 
                a.ID ='3' and a.VISIT_ID = '".$visit_id."' AND a.chamber_id='$chamber_name' AND a.doc_id='$doc_name'";
            } else {
            $query_b = "insert into patient_health_details(ID, VALUE, VISIT_ID, create_date, chamber_id, doc_id) 
                    values('3' , '$bmi', '$visit_id', NOW(), '$chamber_name', '$doc_name')";
            }
            mysql_query($query_b) or die(mysql_error());
            
            //Insert BMI as master in master table
            //$admin->insertIntoCFMaster($name,$chamber_name,$doc_name);
            
            //Insert ideal body weight
            $sex = $admin->getPatientDetailsFromVisit($visit_id, $chamber_name, $doc_name)->GENDER;
            //echo "SEX ===>>> ".$sex;
            $ideal_body_weight = $admin->calIdealBodyWeight($sex, $height);
            
            $result_ideal_body_weight = mysql_query("select * from patient_health_details a,  patient_health_details_master b where
														a.ID = b.ID and a.chamber_id = b.chamber_id and a.doc_id = b.doc_id 
														and a.chamber_id='$chamber_name' and a.doc_id='$doc_name'
														and a.VISIT_ID = '$visit_id' and b.NAME = 'Ideal Body Weight (KG)'") or die(mysql_error());
            
            if(mysql_num_rows($result_ideal_body_weight) > 0 ){
            	$query_ideal_body_weight= "update patient_health_details b set b.VALUE = '$ideal_body_weight' where
            	b.ID = (select ID from patient_health_details_master a where a.name='Ideal Body Weight (KG)' and status='ACTIVE' and a.chamber_id='$chamber_name' and a.doc_id='$doc_name') and b.VISIT_ID = '".$visit_id."'";
            	//echo "UPDATE ->".$query_ideal_body_weight;
            } else {
            	$query_ideal_body_weight= "insert into patient_health_details(ID, VALUE, VISIT_ID, chamber_id, doc_id)
            	values( (select b.ID from patient_health_details_master b where b.name='Ideal Body Weight (KG)' and b.status='ACTIVE' and b.chamber_id='$chamber_name' and b.doc_id='$doc_name' ) , '$ideal_body_weight', '$visit_id', '$chamber_name' , '$doc_name')";
            	//echo $query_ideal_body_weight;
            }
            //echo $query_ideal_body_weight;
            mysql_query($query_ideal_body_weight) or die(mysql_error());
        }
        
    }
    function getMaxpatient_health_details_master_id($chamber_name,$doc_name){
    	$_QUERY = "SELECT MAX( ID ) +1 as max_id FROM patient_health_details_master WHERE doc_id =  '$doc_name' and chamber_id = '$chamber_name'  ";
    	$result = mysql_query($_QUERY) or die(mysql_error());
    	$obj = mysql_fetch_object($result);
    	$max_id = $obj->max_id;
    	if($max_id == NULL){
    		$max_id=1;
    	}
    	return $max_id;
    }
    function insertIntoCFMaster($name, $chamber_name,$doc_name){
    	$_QUERY = "insert into patient_health_details_master (ID, NAME) values ($id, $name) ";
    	
    	
    }
    function calIdealBodyWeight($sex, $height){
    	/* Ideal Body Weight (men) = 50kg + 2.3kg*( Height(in) - 60 )
    	Ideal Body Weight (women) = 45.5kg + 2.3kg *( Height(in) - 60 ) */
    	$result = "";
    	if($sex == 'Male'){
    		$result = 50 + 2.3 * ($height*0.393701 - 60);
    	} else if($sex == 'Female'){
    		$result = 45 + 2.3 * ($height*0.393701 - 60);
    	}
    	return round($result);
    	
    }
    function insertUpdateClinicalImpression($prescription_id, $type,$chamber_name,$doc_name){
        $admin = new admin();
        $query = "select  ID from clinical_impression a where a.TYPE = '$type' AND a.chamber_id='$chamber_name' AND a.doc_id='$doc_name'";
        //echo $query;
        $result = mysql_query($query) or die(mysql_error());
        $rows = mysql_num_rows($result);
        $id = $admin->getMaxClinicalImpression($chamber_name, $doc_name);
        //echo "MAX =".$id;
        //echo $rows;
       
        if($rows > 0){
        	while($rs = mysql_fetch_array($result)){
        		$id = $rs['ID'];
        	}
          
        } else {
        	
        	//echo "max id -> ".$id;
            //Insert into master and then add
        	$query = "insert into clinical_impression (ID, TYPE, DESCRIPTION,create_date,chamber_id,doc_id ) values('$id','$type','$type', NOW(), '$chamber_name', '$doc_name')";
            //echo $query;
            mysql_query($query) or die(mysql_error());
            //$id = mysql_insert_id();
        }
        $query = "insert into prescribed_cf(clinical_impression_id, prescription_id,create_date,chamber_id,doc_id) 
        values('$id' , '$prescription_id', NOW(), '$chamber_name', '$doc_name')";
        //echo $query;
        mysql_query($query) or die(mysql_error());
    }
    function deleteClinicalImpression($prescription_id,$ci_id, $chamber_name, $doc_name){
    	$_QUERY = "delete from prescribed_cf 
    	where prescription_id = '$prescription_id'
    	and clinical_impression_id  ='$ci_id' AND chamber_id='$chamber_name' AND doc_id='$doc_name'";
    	//echo $_QUERY;
    	mysql_query($_QUERY) or die(mysql_error());
        
        
    }
    
    function deleteSocialHistory($prescription_id,$ci_id, $chamber_name, $doc_name){
        //$message = "";
        
        mysql_query("delete from prescribed_social_history
             where prescription_id = '$prescription_id'
             and social_history_id  ='$ci_id' and chamber_id='$chamber_name' AND doc_id='$doc_name'") or die(mysql_error());
        
    }
    function deleteAllergy($prescription_id,$allergy_id, $chamber_name, $doc_name){
        //$message = "";
        mysql_query("delete from prescribed_allergy
             where prescription_id = '$prescription_id'
             and ALLERGY_ID  ='$allergy_id' and chamber_id='$chamber_name' AND doc_id='$doc_name'") or die(mysql_error());
    }
    
    function deletePastMedicalHistory($prescription_id,$ci_id, $chamber_name, $doc_name){
        //$message = "";
        mysql_query("delete from prescribed_past_med_history
             where prescription_id = '$prescription_id'
             and clinical_impression_id  ='$ci_id' and chamber_id='$chamber_name' AND doc_id='$doc_name'") or die(mysql_error());
        
        
    }
    function getPrescriptionFromVisitId($visitid,$chamber_name,$doc_name){
        $_QUERY="select * from prescription a where a.VISIT_ID = '".$visitid."' AND a.chamber_id='$chamber_name' AND a.doc_id='$doc_name'";
        
        $result = mysql_query($_QUERY) or die(mysql_error());
        $obj = mysql_fetch_object($result);
        
        return $obj;
    }
    function getClinicalImpressionFromId($ci_id,$chamber_name,$doc_name){
        $_QUERY="select * from clinical_impression a where a.ID = '".$ci_id."' AND a.chamber_id='$chamber_name' AND a.doc_id='$doc_name'";
        
        $result = mysql_query($_QUERY) or die(mysql_error());
        $obj = mysql_fetch_object($result);
        
        return $obj;
    }
    function getVisitFromId($visit_id,$chamber_name,$doc_name){
        $_QUERY="select * from visit a where a.VISIT_ID  = '".$visit_id."' AND a.chamber_id='$chamber_name' AND a.doc_id='$doc_name'";
        
        $result = mysql_query($_QUERY) or die(mysql_error());
        $obj = mysql_fetch_object($result);
        
        return $obj;
    }
    function getChamberDetails($chamber_id){
        $_QUERY="select * from chamber_master where chamber_id  = '".$chamber_id."'";
        
        $result = mysql_query($_QUERY) or die(mysql_error());
        $obj = mysql_fetch_object($result);
        
        return $obj;
    }
    function getUserDetails($user_id){
        $_QUERY="select * from user where user_id  = '".$user_id."'";
        
        $result = mysql_query($_QUERY) or die(mysql_error());
        $obj = mysql_fetch_object($result);
        
        return $obj;
    }
    
    function getDoctorDetails($user_id){
        $_QUERY="select * from doctor_master where user_id  = '".$user_id."'";
        
        $result = mysql_query($_QUERY) or die(mysql_error());
        $obj = mysql_fetch_object($result);
        
        return $obj;
    }
    function getPatientInformationForPrescription($patient_id, $chamber_name, $doc_name){
    	
    	$_QUERY="SELECT a.patient_id, a.GENDER, a.patient_first_name, a.patient_last_name, a.patient_name,
    	a.patient_address, a.patient_city, a.patient_dob, a.patient_cell_num, a.patient_alt_cell_num, a.age,
    	a.patient_email, data_entry_date, b.VISIT_ID, b.PATIENT_ID, b.VISIT_DATE,
    	b.APPOINTMENT_TO_DOC_NAME, b.VISITED
    	FROM patient a, visit b
    	WHERE b.PATIENT_ID = a.patient_id and a.chamber_id='".$chamber_name."' and a.doc_id='".$doc_name."' and a.chamber_id=b.chamber_id and a.doc_id=b.doc_id
    	AND a.patient_id = '$patient_id'
    	AND b.visited = 'no'";
    			
    	$result = mysql_query($_QUERY) or die(mysql_error());
    	$obj = mysql_fetch_object($result);
    	
    	return $obj;
    }
    
    function getPatientInformationforArchievePrescription($prescription_id, $chamber_name, $doc_name){
    	$_QUERY= "select a.visit_id, c.patient_id, c.GENDER, c.patient_first_name, c.patient_name, 
                        c.patient_last_name, c.patient_address, c.patient_city, c.patient_dob, c.age,
                        c.patient_cell_num, c.patient_alt_cell_num, c.patient_email , b.VISIT_DATE
                        from prescription a, visit b, patient c
                        where a.visit_id = b.visit_id
                        and b.patient_id=c.patient_id and a.chamber_id='".$chamber_name."' and a.doc_id='".$doc_name."' and a.chamber_id=b.chamber_id and a.doc_id=b.doc_id and 
						b.chamber_id=c.chamber_id and b.doc_id = c.doc_id
                        and a.prescription_id = '".$prescription_id."' and a.chamber_id='".$chamber_name."' and a.doc_id='".$doc_name."'";
    	$result = mysql_query($_QUERY) or die(mysql_error());
    	$obj = mysql_fetch_object($result);
    	
    	return $obj;
    }
    
    function getPatientDetailsFromVisit($visit_id, $chamber_name, $doc_name){
    	$_QUERY = "select a.patient_id, a.GENDER, a.patient_first_name, a.patient_last_name, a.patient_name, a.patient_address, 
					a.patient_city, a.patient_dob, a.age, a.patient_cell_num, a.patient_alt_cell_num, a.patient_email, a.data_entry_date, 
					a.chamber_id, a.created_by_user_id, a.create_date, a.isSync 
				    from patient a, visit b where a.patient_id = b.PATIENT_ID and b.VISIT_ID = '".$visit_id."' 
					and a.chamber_id='".$chamber_name."' and a.doc_id='".$doc_name."' and a.chamber_id=b.chamber_id and a.doc_id=b.doc_id";
    	$result = mysql_query($_QUERY) or die(mysql_error());
    	$obj = mysql_fetch_object($result);
    	
    	return $obj;
    }
    
    function getMaxVisitId($chamber_name, $doc_name){
        $_QUERY = "SELECT MAX( visit_id ) +1 as max_id FROM visit WHERE doc_id =  '$doc_name' and chamber_id = '$chamber_name' ";
        $result = mysql_query($_QUERY) or die(mysql_error());
        $obj = mysql_fetch_object($result);
        
        $max_id = $obj->max_id;
        if($max_id == NULL){
        	$max_id=1;
        }
        return $max_id;
    }
    
    function getMaxPrescriptionId($chamber_name, $doc_name){
        $_QUERY = "SELECT MAX( PRESCRIPTION_ID ) +1 as max_id FROM prescription WHERE doc_id =  '$doc_name' and chamber_id = '$chamber_name' ";
        $result = mysql_query($_QUERY) or die(mysql_error());
        $obj = mysql_fetch_object($result);
        $max_id = $obj->max_id;
        if($max_id == NULL){
        	$max_id=1;
        }
        return $max_id;
    }
    
    function getMaxClinicalImpression($chamber_name, $doc_name){
    	$_QUERY = "select max(id)+1 as max_id from clinical_impression where chamber_id = '$chamber_name' and doc_id='$doc_name' ";
    	
    	$result = mysql_query($_QUERY) or die(mysql_error());
    	$obj = mysql_fetch_object($result);
    	
    	//echo "End: getMaxClinicalImpression($chamber_name, $doc_name) :".$obj->max_id;
    	$max_id = $obj->max_id;
    	if($max_id == NULL){
    		$max_id=1;
    	}
    	return $max_id;
    }
    
    function getMaxInvestigationID($chamber_name, $doc_name){
    	$_QUERY = "select max(ID)+1 as max_id from investigation_master where chamber_id = '$chamber_name' and doc_id='$doc_name' ";
    	
    	$result = mysql_query($_QUERY) or die(mysql_error());
    	$obj = mysql_fetch_object($result);
    	
    	//echo "End: getMaxClinicalImpression($chamber_name, $doc_name) :".$obj->max_id;
    	$max_id = $obj->max_id;
    	if($max_id == NULL){
    		$max_id=1;
    	}
    	return $max_id;
    }
    
    function getMaxPatientInvestigationID($chamber_name, $doc_name){
    	$_QUERY = "select max(investigation_id)+1 as max_id from patient_investigation where chamber_id = '$chamber_name' and doc_id='$doc_name' ";
    	
    	$result = mysql_query($_QUERY) or die(mysql_error());
    	$obj = mysql_fetch_object($result);
    	
    	//echo "End: getMaxClinicalImpression($chamber_name, $doc_name) :".$obj->max_id;
    	$max_id = $obj->max_id;
    	if($max_id == NULL){
    		$max_id=1;
    	}
    	return $max_id;
    }
    function getMaxInvestigationIdfromMaster($chamber_name, $doc_name){
    	$_QUERY = "select max(ID)+1 as max_id from investigation_master where chamber_id = '$chamber_name' and doc_id='$doc_name' ";
    	
    	$result = mysql_query($_QUERY) or die(mysql_error());
    	$obj = mysql_fetch_object($result);
    	
    	//echo "End: getMaxClinicalImpression($chamber_name, $doc_name) :".$obj->max_id;
    	$max_id = $obj->max_id;
    	if($max_id == NULL){
    		$max_id=1;
    	}
    	return $max_id;
    }
    
    function getMaxDoseDetailsMasterID($chamber_name, $doc_name){
    	$_QUERY = "select max(DOSE_DETAILS_MASTER_ID)+1 as max_id from dose_details_master where chamber_id = '$chamber_name' and doc_id='$doc_name' ";
    	
    	$result = mysql_query($_QUERY) or die(mysql_error());
    	$obj = mysql_fetch_object($result);
    	
    	//echo "End: getMaxClinicalImpression($chamber_name, $doc_name) :".$obj->max_id;
    	$max_id = $obj->max_id;
    	if($max_id == NULL){
    		$max_id=1;
    	}
    	return $max_id;
    }
    
    function insertintoDoseMasterTable ($dose, $chamber_name, $doc_name){
    	
    	//search for the dose
    	$admin = new admin();
    	//echo "2";
    	$query_search = "select * from dose_details_master a where a.DOSE_DETAILS = '".$dose."' AND a.chamber_id='$chamber_name' AND a.doc_id='$doc_name'";
    	//echo $query_search;
    	$id = $admin->getMaxDoseDetailsMasterID($chamber_name, $doc_name);
    	//echo "Id ==>>".$id;
    	$query_insert = "insert into dose_details_master(DOSE_DETAILS_MASTER_ID, DOSE_DETAILS, chamber_id, doc_id) values ('".$id."','".$dose."','".$chamber_name."','".$doc_name."')";
    	//echo $query_insert;
    	$result = mysql_query($query_search) or die(mysql_error());
    	$num_res = mysql_num_rows($result);
    	//echo "num_res=".$num_res;
    	 if ($num_res<= 0){
    		//Insert into dose_details_master
    		//echo "Exceuted the query";
    		mysql_query($query_insert) or die(mysql_error());
    	} 
    	
    }
    
    function getMaxMedicineID($chamber_name, $doc_name){
    	$_QUERY = "select max(MEDICINE_ID)+1 as max_id from medicine_master where chamber_id = '$chamber_name' and doc_id='$doc_name' ";
    	
    	$result = mysql_query($_QUERY) or die(mysql_error());
    	$obj = mysql_fetch_object($result);
    	
    	//echo "End: getMaxClinicalImpression($chamber_name, $doc_name) :".$obj->max_id;
    	$max_id = $obj->max_id;
    	if($max_id == NULL){
    		$max_id=1;
    	}
    	
    	return $max_id;
    }
    
    function getMaxPatientId($chamber_name, $doc_name){
    	$_QUERY = "select max(patient_id)+1 as max_id from patient where chamber_id = '$chamber_name' and doc_id='$doc_name' ";
    	
    	
    	$result = mysql_query($_QUERY) or die(mysql_error());
    	$obj = mysql_fetch_object($result);
    	
    	//echo "End: getMaxClinicalImpression($chamber_name, $doc_name) :".$obj->max_id;
    	$max_id = $obj->max_id;
    	if($max_id == NULL){
    		$max_id=1;
    	}
    	return $max_id;
    }
    
    function getmaxPrescribedInvestigationID($chamber_name, $doc_name){
    	$_QUERY = "select max(PRESCRIBED_INVESTIGATION_ID)+1 as max_id from prescribed_investigation where chamber_id = '$chamber_name' and doc_id='$doc_name' ";
    	
    	
    	$result = mysql_query($_QUERY) or die(mysql_error());
    	$obj = mysql_fetch_object($result);
    	
    	//echo "End: getMaxClinicalImpression($chamber_name, $doc_name) :".$obj->max_id;
    	$max_id = $obj->max_id;
    	if($max_id == NULL){
    		$max_id=1;
    	}
    	return $max_id;
    }
    
    function getTestID($chamber_name, $doc_name){
    	$_QUERY = "select max(ID)+1 as max_id from test ";
    	
    	$result = mysql_query($_QUERY) or die(mysql_error());
    	$obj = mysql_fetch_object($result);
    	
    	//echo "End: getMaxClinicalImpression($chamber_name, $doc_name) :".$obj->max_id;
    	$max_id = $obj->max_id;
    	if($max_id == NULL){
    		$max_id=1;
    	}
    	return $max_id;
    }
    
    function preparepatientDatails($fullname){
    	
    	$name = explode(" ", $fullname);
    	
    	if(count($name) == 2){
    		$fname = $name[0];
    		$lname = $name[1];
    	} else {
    		$fname = $name[0]. " ".$name[1];
    		$lname = $name[2];
    	}
    	
    	$obj = (object) array('fname' => $fname, 'lname' => $lname);
    	
    	return  $obj;
    }
    function getListOfChambersbyOwners($doc_name){
    	$query = "select a.chamber_id, b.chamber_name, b.chamber_address from chamber_owner a, chamber_master b where a.owner_id= '$doc_name' and a.chamber_id=b.chamber_id";
    	//echo $query;
    	$result = mysql_query($query)or die(mysql_error());
    	
    	/* $result_array = array();
    	
    	
    	
    	while ($row = mysql_fetch_array($result))
    	{
    		$data['chamber_id'] = $row['chamber_id'];
    		$data['chamber_name'] = $row['chamber_name'];
    		$data['chamber_address'] = $row['chamber_address'];
    		array_push($result_array, $data);
    	} 
    	
    	echo json_encode($result_array);
    	return json_encode($result_array); */
    	
    	return $result;
    }
    
    function insertUpdatepastMedicalHistory($prescription_id, $type, $chamber_name, $doc_name){
        $admin = new admin();
        $query = "select a.ID from past_medical_history_master a where a.TYPE = '$type' AND a.chamber_id='$chamber_name' AND a.doc_id='$doc_name'";
        $result = mysql_query($query) or die(mysql_error());
        $id = "";
        if(mysql_num_rows($result) > 0){
            //Clinical Impression Type exists in the Database. Get the ID
            while($rs = mysql_fetch_array($result)){
                $id = $rs['ID'];
            }
        } else {
            //Insert into master and then add. Get maximum master id
            $max_id = $admin->getmaxPastMedicalHistory($chamber_name, $doc_name);
            $query = "insert into past_medical_history_master (ID, TYPE, DESCRIPTION, chamber_id, doc_id) values('$max_id','$type','$type','$chamber_name','$doc_name')";
            mysql_query($query) or die(mysql_error());
            $id = $max_id;
        }
        $query = "insert into prescribed_past_med_history(clinical_impression_id, prescription_id,chamber_id, doc_id)
                    values('$id' , '$prescription_id','$chamber_name','$doc_name' )";
        mysql_query($query) or die(mysql_error());
        
    }
    
    function getmaxPastMedicalHistory($chamber_name, $doc_name){
        $_QUERY = "select max(ID)+1 as max_id from past_medical_history_master where chamber_id = '$chamber_name' and doc_id='$doc_name' ";
        
        
        $result = mysql_query($_QUERY) or die(mysql_error());
        $obj = mysql_fetch_object($result);
        
        //echo "End: getMaxClinicalImpression($chamber_name, $doc_name) :".$obj->max_id;
        $max_id = $obj->max_id;
        if($max_id == NULL){
            $max_id=1;
        }
        return $max_id;
    }
    
    function insertUpdateSocialHistory($prescription_id, $type,$chamber_name, $doc_name){
        
        $query = "select ID from social_history_master where TYPE = '$type' and chamber_id = '$chamber_name' and doc_id='$doc_name'";
        $admin = new admin();
        $result = mysql_query($query) or die(mysql_error());
        $id = "";
        if(mysql_num_rows($result) > 0){
            //Clinical Impression Type exists in the Database. Get the ID
            while($rs = mysql_fetch_array($result)){
                $id = $rs['ID'];
            }
        } else {
            //Insert into master and then add
            $max_id = $admin->getMaxSocialHistoryID($chamber_name, $doc_name);
            $query = "insert into social_history_master (ID, TYPE, DESCRIPTION,chamber_id,doc_id) values('$max_id','$type','$type','$chamber_name','$doc_name')";
            mysql_query($query) or die(mysql_error());
            $id = $max_id;
        }
        $query = "insert into prescribed_social_history(social_history_id, prescription_id, chamber_id,doc_id)
                    values('$id' , '$prescription_id','$chamber_name','$doc_name')";
        mysql_query($query) or die(mysql_error());
    }
    function getMaxSocialHistoryID($chamber_name, $doc_name){
        $_QUERY = "select max(ID)+1 as max_id from social_history_master where chamber_id = '$chamber_name' and doc_id='$doc_name' ";
        
        
        $result = mysql_query($_QUERY) or die(mysql_error());
        $obj = mysql_fetch_object($result);
        
        //echo "End: getMaxClinicalImpression($chamber_name, $doc_name) :".$obj->max_id;
        $max_id = $obj->max_id;
        if($max_id == NULL){
            $max_id=1;
        }
        return $max_id;
    }
    function insertUpdateAllergy($PRESCRIPTION_ID, $ALLERGY,$chamber_name,$doc_name){
        $query = "select ALLERGY_ID from allergy_master where allergy_name = '$ALLERGY' and chamber_id = '$chamber_name' and doc_id='$doc_name'";
        $result = mysql_query($query);
        $id = "";
        if(mysql_num_rows($result) > 0){
            //Clinical Impression Type exists in the Database. Get the ID
            while($rs = mysql_fetch_array($result)){
                $id = $rs['ALLERGY_ID'];
            }
        } else {
            //Insert into master and then add
            $max_id = $admin->getMaxAllergyId($chamber_name,$doc_name);
            $query = "insert into allergy_master (ALLERGY_ID, ALLERGY_NAME, chamber_id, doc_id) values('$max_id','$allergy','$chamber_name','$doc_name')";
            mysql_query($query) or die(mysql_error());
            $id = $max_id;
        }
        $query1 = "insert into prescribed_allergy(allergy_id, prescription_id,chamber_id, doc_id)
                    values('$id' , '$PRESCRIPTION_ID','$chamber_name','$doc_name')";
        mysql_query($query1) or die(mysql_error());
    }
    function getMaxAllergyId($chamber_name, $doc_name){
        $_QUERY = "select max(ALLERGY_ID)+1 as max_id from allergy_master where chamber_id = '$chamber_name' and doc_id='$doc_name' ";
        
        
        $result = mysql_query($_QUERY) or die(mysql_error());
        $obj = mysql_fetch_object($result);
        
        //echo "End: getMaxClinicalImpression($chamber_name, $doc_name) :".$obj->max_id;
        $max_id = $obj->max_id;
        if($max_id == NULL){
            $max_id=1;
        }
        return $max_id;
    }
}
?>
