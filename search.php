<?php

session_start();
include 'authorization.php';
$_SESSION['checkin_date'] = "";
$_SESSION['checkout_date'] = "";


if(isset($_POST["checkin"])){
$_SESSION['checkin_date'] = date('d-m-y', strtotime($_POST['checkin'])); 
$datestart =  date('y-m-d', strtotime($_POST['checkin'])); 
}
if(isset( $_POST["checkout"] ) ){
$_SESSION['checkout_date'] = date('d-m-y', strtotime($_POST['checkout']));
$dateend =  date('y-m-d', strtotime($_POST['checkout']));
}

include './auth.php';

	if(!empty($_POST["checkin"]) && !empty($_POST["checkout"])){
					$_SESSION['result'] = mysqli_query($conn, "SELECT * from booking where
						((booking.checkin_date between '".$datestart."' AND '".$dateend."') OR (booking.checkout_date between '".$dateend."' AND '".$datestart."'))
						");
	}
	else {
			$_SESSION['result'] =  mysqli_query($conn, "select booking.*  from booking;");	echo mysqli_error();			
	}	

	echo mysqli_error($conn);	
	if(mysqli_num_rows($_SESSION['result']) > 0){
				while ($row = mysqli_fetch_array($_SESSION['result']) ){
							print "<tr style=\"\">		 <td>".$row['booking_id']."</td>\n";
							print "                  <td>".$row['checkin_date']."</td>\n";
							print "                  <td>".$row['checkout_date']."</td>\n";
											print "<td>";
											$q = mysqli_query("SELECT homestaybook.totalhomestaybook AS total, homestay.homestay_name AS name
																FROM homestaybook
																LEFT JOIN homestay ON homestaybook.homestay_id = homestay.homestay_id
																WHERE homestaybook.booking_id =".$row['booking_id'].";");
											while($r = mysqli_fetch_array($r))
											{
											print "                  ".$r['total']." ".$r['name']."<br> \n";
											}
											print "</td>";
							print "                  <td>Adult:".$row['total_adult']."<br>Child:".$row['total_children']."</td>\n";
							print "                  <td>".$row['total_amount']."</td>\n";
							print "                  <td>".$row['deposit']."</td>\n";
							print "                  <td>".($row['total_amount']-$row['deposit'])."</td>\n";
							print "                  <td>".$row['payment_status']."</td><td><a href=\"detail.php?booking=".$row['booking_id']."\"  \">More Details</a></td><td><a class=\"delete\" href=\"deletebooking.php?booking=".$row['booking_id']."\"    >Delete</a></td></tr>";					
			
				}
			}
	else{
	print "<tr><td>No Record</td></tr>";
	}
	

		
?>