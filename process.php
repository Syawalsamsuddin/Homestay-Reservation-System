<?php
require_once('config.php');
?>
<?php
if(isset($_POST)){
	$username 		= $_POST['username'];
	$fullname 		= $_POST['fullname'];
	$email 			= $_POST['email'];
	$phonenumber	= $_POST['phonenumber'];
	$password 		= $_POST['password'];
		$sql = "INSERT INTO user (username, fullname, email, phonenumber, password ) VALUES(?,?,?,?,?)";
		$stmtinsert = $db->prepare($sql);
		$result = $stmtinsert->execute([$username, $fullname, $email, $phonenumber, $password]);
		if($result){
			echo 'Successfully saved.';
		}else{
			echo 'There were erros while saving the data.';
		}
}else{
	echo 'No data';
}