<html>

<head>
<title>Unisel Homestay Reservation</title>
</head>
<body>

	<?php
	$checkin_date =  date('y-m-d', strtotime($_POST['checkin']));
	$checkout_date =  date('y-m-d', strtotime($_POST['checkout']));
	echo "<br>".$checkin_date."<br>";
	echo $checkout_date;
	include './auth.php';
	
	
	$result = mysqli_query($conn, "select * from homestay  where homestay.homestay_id in 
		  (
              select booking.homestay_id
              from booking 
	       )");
	while ($row = mysqli_fetch_array($result)) {
	   echo "<br>homestay_id:".$row{'homestay_id'}." Homestay_type:".$row{'bed_type'}."Occupany: ".$row{'occupancy'}."<br>"; 
		print "<div class=\"row\">\n";
		print "				<div class=\"large-4 columns\" >\n";
		print "					<img src=\"".$row{'imgpath'}."\" alt=\"homestay #1\" ></img>\n";
		print "				</div>\n";
		print "				<div class=\"large-4 columns\" style=\"font-size: 18px;\">\n";
		print "					Occupancy : ".$row{'occupancy'}."<br>\n";
		print "					Size : ".$row{'size'}."<br>\n";
		print "					View : ".$row{'view'}."\n";
		print "					Bed : ".$row{'bed_type'}."\n";
		print "				</div>\n";
		print "				<div class=\"large-4 columns\" style=\"font-size: 18px;\">\n";
		print "					From: $ ".$row{'rate'}." / night\n";
		print "					<button type=\"button\" href=\"#\" class=\"button small selecthomestay fontslabo\" style=\"background-color:#2ecc71;\"  value=\"".$row{'homestay_id'}."\">Select Homestay</button>\n";
		print "					\n";
		print "				</div>\n";
		print "			</div><hr>";


	   
	}
	mysql_close($dbhandle);
	
	?>
</body>
</html>