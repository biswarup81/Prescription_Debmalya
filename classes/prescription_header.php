<?php 
/*Makes the complete Header */
class Header {
	function Header($doc_username, $chmaber_id) {
		
		$_QUERY= "select * from doctor_master where doctor_id ='".$doc_username."'";
		//echo $_QUERY;
		$result = mysql_query($_QUERY) or die(mysql_error());
		$obj = mysql_fetch_object($result);
		$this->salutation=$obj->salutation;
		$this->doctor_full_name=$obj->doctor_full_name;
		$this->user_name = $obj->user_name;
		$this->doctor_degree=$obj->doctor_degree;
		$this->doctor_affiliation=$obj->doctor_affiliation;
		$this->doctor_email=$obj->doctor_email;
		$this->doctor_mobile=$obj->doctor_mobile;
		$this->doc_reg_num=$obj->doc_reg_num;
		$this->doctor_address = $obj->doctor_address;
		$this->doctor_secondery_contact = $obj->doctor_secondery_contact;
		
		$_QUERY= "select * from chamber_master where chamber_id ='".$chmaber_id."'";
		//echo $_QUERY;
		$result1 = mysql_query($_QUERY) or die(mysql_error());
		$obj1 = mysql_fetch_object($result1);
		$this->primary_phone_number=$obj1->primary_phone_number;
		$this->chamber_footer=$obj1->chamber_footer;
		$this->chamber_name = $obj1->chamber_name;
		$this->chamber_address = $obj1->chamber_address;
		$this->primary_phone_number = $obj1->primary_phone_number;
		$this->secondary_phone_number = $obj1->secondary_phone_number;
		
		
	}
}

?>