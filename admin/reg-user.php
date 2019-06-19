
<?php
session_start();
include './auth.php';
$re = mysqli_query($conn , "select * from user where username = '".$_SESSION['username']."'  AND password = '".$_SESSION['password']."' " );
echo mysqli_error($conn);
if(mysqli_num_rows($re) > 0)
{

} 
else
{

session_destroy();
header("location: index.htm");
}
?>
<!doctype html>
<html lang="en" class="no-js">

<head>
	<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="http://getbootstrap.com/favicon.ico">

    <title>Booking System</title>

  
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <
    <link href="css/dashboard.css" rel="stylesheet">

    
	<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	<link href="css/datepicker.css" rel="stylesheet" type="text/css"/>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
    
 
  <link rel="stylesheet" href="css/fontello.css">
    <link rel="stylesheet" href="css/animation.css">
 

</head>
<script>
	  $(document).ready(function() {
			$("#checkout").datepicker();
			$("#checkin").datepicker({
			minDate : new Date(),
			onSelect: function (dateText, inst) {
			var date = $.datepicker.parseDate($.datepicker._defaults.dateFormat, dateText);
			$("#checkout").datepicker("option", "minDate", date);
			}
			});
			
		
	  });

function fnSearch()
		{
			var checkin=document.getElementById('checkin').value;
			var checkout=document.getElementById('checkout').value;
			var bookingid=document.getElementById('bookingid').value;
			var firstname=document.getElementById('firstname').value;
			$.ajax({
				type: "POST",
				url: "search.php",
				data: "checkin=" + checkin + "&checkout=" + checkout + "&bookingid=" + bookingid + "&firstname=" + firstname,
				success: function(resPonsE) 
					{
						document.getElementById('bookinginfo').innerHTML=resPonsE;
						return true;
					}
			});
		}
	  
	</script>
<body>
	
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid" style="background-color: #4aa3df;">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#" style="color: #ffffff;">Admin Booking Panel</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="signout.php" style="color: #ffffff;">Sign Out</a></li>
          </ul>
        </div>
      </div>
    </nav>
	
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li ><a href="dashboard.php"><i class="icon-gauge"></i> Dashboard <span class="sr-only">(current)</span></a></li>
            
			<li><a href="homestay.php"><i class="icon-key"></i> Homestay</a></li>
			<li class="active"><a href="reg-user.php"><i class="icon-key"></i> Registered User</a></li>
			
			
          </ul>

        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

						<h2 class="sub-header">Registered Homestay</h2>
          				<div class="table-responsive">
           					 <table class="table table-striped">
             				 <thead>
										<tr>
										<th>Username</th>
										<th>Full Name</th>
										<th>Email</th>
										<th>Phone Number</th>
										<th>Password</th>										
										</tr>
									</thead>
									<tbody>

									<?php 
//$query = $dbh -> prepare($sql);
//$query->execute();
//$results=$query->fetchAll(PDO::FETCH_OBJ);
//$cnt=1;
//if($query->rowCount() > 0)
//{
//foreach($results as $result)
//{				//
$servername="localhost";
$username="root";
$passwrod="";
$dbname="uniselhomestay";

$conn = new mysqli($servername,$username,$passwrod,$dbname);
if ($conn->connect_error){
	die("Connection Failed : " . $conn->connect_error);
}
$sql ="SELECT username,fullname,email,phonenumber,password FROM user";
$result=$conn->query($sql);

if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()){

	echo "<tr>";
	echo "<td>" . $row['username'] . "</td>";
	echo "<td>" . $row['fullname'] . "</td>";
	echo "<td>" . $row['email'] . "</td>";
	echo "<td>" . $row['phonenumber'] . "</td>";
	echo "<td>" . $row['password'] . "</td>";

	echo "</tr>";
	}
} else{
	echo "0 results";

}
$conn->close();
?>

								</table>

						

							</div>
						</div>

					

					</div>
				</div>

			</div>
		</div>
	</div>

	<!-- Loading Scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>
</body>
</html>
 ?>
