<?php
session_start();
include './auth.php';
$re = mysqli_query($conn, "select * from user where username = '".$_SESSION['username']."'  AND password = '".$_SESSION['password']."' " );
echo mysqli_error($conn);
if(mysqli_num_rows($re) > 0)
{

} 
else
{

session_destroy();
header("location: index.htm");
}
$id  = $_POST['homestay_id'];
$total_homestay = "";
$total_room = "";
$type_homestay= "";
$rate ="";
$desc ="";
$parking_no ="";
$address ="";
$homestay_name ="";

	$homestay_name = $_POST['homestay_name'];
	if(isset($_POST['total_homestay'])){
	$total_homestay =$_POST['total_homestay'];}
	if(isset($_POST['total_room'])){
	$total_room =$_POST['total_room'];}
	if(isset($_POST['type_homestay'])){
	$type_homestay = $_POST['type_homestay'];}
	if(isset($_POST['parking_no'])){
	$parking_no = $_POST['parking_no'];}
	if(isset($_POST['address'])){
	$address = $_POST['address'];}
	if(isset($_POST['rate'])){
	$rate =$_POST['rate'];}
	if(isset($_POST['desc'])){
	$desc =$_POST['desc'];}
	
	
if(isset($_FILES['img']['name']) && !empty($_FILES['img']['name']))
{
$imgpath = "";
$imageFileType = pathinfo($imgpath,PATHINFO_EXTENSION);
$uploadDir = "../img/";
$imagename= $_FILES['img']['name'];
$imgpath = $uploadDir.$imagename.$imageFileType;
$uploadDirForSql = "img/";
$imgpathForSQL = $uploadDirForSql.$imagename.$imageFileType;


	
	$sql = "UPDATE homestay 
	SET total_homestay='".$total_homestay."', total_room='".$total_room."', type_homestay='".$type_homestay."', parking_no ='".$parking_no."', address ='".$address."', homestay_name ='".$homestay_name."', descriptions ='".$desc."', rate ='".$rate."', imgpath ='".$imgpathForSQL."'
	WHERE homestay_id='".$id."';";
	$result = mysqli_query($sql);
	echo mysqli_error($conn);
	move_uploaded_file($_FILES["img"]["tmp_name"], $imgpath);
	header('Refresh: 3;url=homestay.php');
	echo "<!DOCTYPE html>\n";
echo "<html lang=\"en\"><head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">\n";
echo "\n";
echo "    <!-- Bootstrap core CSS -->\n";
echo "    <link href=\"css/bootstrap.min.css\" rel=\"stylesheet\">\n";
echo "    <!-- Custom styles for this template -->\n";
echo "    <link href=\"css/dashboard.css\" rel=\"stylesheet\">\n";
echo "	<link href=\"css/style.css\" rel=\"stylesheet\">\n";
echo "	<link rel=\"stylesheet\" href=\"css/fontello.css\">\n";
echo "    <link rel=\"stylesheet\" href=\"css/animation.css\"><!--[if IE 7]><link rel=\"stylesheet\" href=\"css/fontello-ie7.css\"><![endif]-->\n";
echo "    \n";
echo "<body>\n";
echo "<div class=\"container\">\n";
echo "	<div class=\"row\">\n";
echo "		<div class=\"col-xs-3\">\n";
echo "		</div>\n";
echo "		<div class=\"col-xs-6 \">\n";
echo "		<h4> Success. Please wait few seconds for redirection...<i class=\"icon-spin4 animate-spin\" style=\"font-size:28px;\"></i></h4>\n";
echo "		\n";
echo "		</div>\n";
echo "		<div class=\"col-xs-3\">\n";
echo "		</div>\n";
echo "	</div>\n";
echo "</div>\n";
echo "\n";
echo "\n";
echo "</body></html>";

}else
{
	
	$sql2 = "UPDATE homestay
	SET total_homestay='".$total_homestay."', total_room='".$total_room."', type_homestay='".$type_homestay."', parking_no ='".$parking_no."', address ='".$address."', homestay_name ='".$homestay_name."', descriptions ='".$desc."', rate ='".$rate."'
	WHERE homestay_id='".$id."';";
	$result2 = mysqli_query($conn,$sql2);
	echo mysqli_error($conn);
	header('Refresh: 3;url=homestay.php');
	echo "<!DOCTYPE html>\n";
echo "<html lang=\"en\"><head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">\n";
echo "\n";
echo "    <!-- Bootstrap core CSS -->\n";
echo "    <link href=\"css/bootstrap.min.css\" rel=\"stylesheet\">\n";
echo "    <!-- Custom styles for this template -->\n";
echo "    <link href=\"css/dashboard.css\" rel=\"stylesheet\">\n";
echo "	<link href=\"css/style.css\" rel=\"stylesheet\">\n";
echo "	<link rel=\"stylesheet\" href=\"css/fontello.css\">\n";
echo "    <link rel=\"stylesheet\" href=\"css/animation.css\"><!--[if IE 7]><link rel=\"stylesheet\" href=\"css/fontello-ie7.css\"><![endif]-->\n";
echo "    \n";
echo "<body>\n";
echo "<div class=\"container\">\n";
echo "	<div class=\"row\">\n";
echo "		<div class=\"col-xs-3\">\n";
echo "		</div>\n";
echo "		<div class=\"col-xs-6 \">\n";
echo "		<h4> Success. Please wait few seconds for redirection...<i class=\"icon-spin4 animate-spin\" style=\"font-size:28px;\"></i></h4>\n";
echo "		\n";
echo "		</div>\n";
echo "		<div class=\"col-xs-3\">\n";
echo "		</div>\n";
echo "	</div>\n";
echo "</div>\n";
echo "\n";
echo "\n";
echo "</body></html>";
	


}



?>