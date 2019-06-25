<?php
require_once('config.php');
?>
<?php
if(isset($_POST)){
	$email 			= $_POST['email'];
	$phonenumber	= $_POST['phonenumber'];



	$file_name = $_FILES['file']['name'];
	$file_tmp = $_FILES['file']['tmp_name'];

	$destination = "admin/upload/".$file_name;

	if (move_uploaded_file($file_tmp, $destination)) {
		$sql = "INSERT INTO uploadfile (email, phonenumber, file ) VALUES(?,?,?)";
		$stmtinsert = $db->prepare($sql);
		$result = $stmtinsert->execute([$email, $phonenumber, $file_name]);
		if($result){
			echo 'Successfully saved.';
		}else{
			echo 'There were erros while saving the data.';
		}
	}
		
}else{
	echo 'No data';
}