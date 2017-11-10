<?php
include './inc/datacon.php';
include './classes/admin_class.php';
include_once './inc/header.php';
include_once './classes/prescription_header.php';
$admin = new admin();



/* class Foo {
	public $aMemberVar = 'aMemberVar Member Variable';
	public $aFuncName = 'aMemberFunc';
	
	
	function aMemberFunc() {
		print 'Inside `aMemberFunc()`';
	}
}

$foo = new Foo; 
$element = 'aMemberVar';
print $foo->$element; */

echo $admin->calcBMI(84, 178);
echo "ideal body weight ->".$admin->calIdealBodyWeight('Male', 178);

$admin->insertUpdatePatientInvestigation('CREATININE', '', '', '1.2', '4918', '21152','dsanyal','anandaclinic');



 include_once './inc/footer.php';
?>
</body>
</html>

