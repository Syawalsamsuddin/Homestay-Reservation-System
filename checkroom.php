<?php
session_start();
if(isset($_POST["checkin"]) && isset($_POST["checkout"])){
$_SESSION['checkin_date'] = date('d-m-y', strtotime($_POST['checkin'])); 
$_SESSION['checkout_date'] = date('d-m-y', strtotime($_POST['checkout']));
$_SESSION['checkin_db'] = date('y-m-d', strtotime($_POST['checkin'])); 
$_SESSION['checkout_db'] = date('y-m-d', strtotime($_POST['checkout']));
$datetime1 = new DateTime($_SESSION['checkin_db']);
$datetime2 = new DateTime($_SESSION['checkout_db']);
$_SESSION['checkin_unformat'] = $_POST["checkin"]; 
$_SESSION['checkout_unformat'] = $_POST["checkout"];
$interval = $datetime1->diff($datetime2);
 $_SESSION['total_night'] = $interval->format('%d');

}
if(isset( $_POST["totaladults"] ) ){
$_SESSION['adults'] = $_POST["totaladults"];
}

if(isset( $_POST["totalchildrens"] ) ){
$_SESSION['childrens'] = $_POST["totalchildrens"];
}


?>
<!DOCTYPE html>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Unisel HomestayReservation</title>
<link rel="stylesheet" href="scss/foundation.css">
<link rel="stylesheet" href="scss/style.css">
<link href='http://fonts.googleapis.com/css?family=Slabo+13px' rel='stylesheet' type='text/css'>
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
<link href='http://fonts.googleapis.com/css?family=Slabo+27px' rel='stylesheet' type='text/css'>
<meta class="foundation-data-attribute-namespace"><meta class="foundation-mq-xxlarge"><meta class="foundation-mq-xlarge"><meta class="foundation-mq-large"><meta class="foundation-mq-medium"><meta class="foundation-mq-small"><style></style><meta class="foundation-mq-topbar"></head>
<body class="fontbody" style="background-image : url(img/unisel.jpg); no-repeat center center fixed; background-size: cover;">
<div class="row foo" style="margin:30px auto 30px auto;">
<div class="large-12 columns">
		<div class="large-3 columns centerdiv">
			<a href="index.php" class="button round blackblur fontslabo" >1</a>
			<p class="fontgrey">Please select Date</p>
		</div>
		<div class="large-3 columns centerdiv">
			<a href="#" class="button round fontslabo" style="background-color:#2ecc71;">2</a>
			<p class="fontgrey">Select Homestay</p>
		</div>
		<div class="large-3 columns centerdiv">
			<a href="#" class="button round blackblur fontslabo" >3</a>
			<p class="fontgrey">Guest Details</p>
		</div>
		<div class="large-3 columns centerdiv">
			<a href="#" class="button round blackblur fontslabo" >4</a>
			<p class="fontgrey">Reservation Complete</p>
		</div>
</div>

</div>
</div>
 
<div class="row">
	<div class="large-4 columns blackblur fontcolor" style="margin-left:-10px; padding:10px;">
	
		<div class="large-12 columns " >
		<p><b>Your Reservation</b></p><hr class="line">
				<form action="index.php" method="post">
				<div class="row">
					<div class="large-12 columns">
						<div class="row">
						
							<div class="large-6 columns" style="max-width:100%;">
								<span class="fontgrey">Check In
								</span>
							</div>
							
							<div class="large-4 columns" style="max-width:100%;">
								<span class="">: <?php echo $_SESSION['checkin_date'];?>
								</span>				
							
							</div>
						</div>
						<div class="row">
							<div class="large-6 columns" style="max-width:100%;">
								<span class="fontgrey">Check Out
								</span>
							</div>
							
							<div class="large-4 columns" style="max-width:100%;">
								<span class="">: <?php echo $_SESSION['checkout_date'];?>
								</span>				
							
							</div>
						</div>
						<div class="row">
							<div class="large-6 columns" style="max-width:100%;">
								<span class="fontgrey">Adults
								</span>
							</div>
							
							<div class="large-4 columns" style="max-width:100%;">
								<span class="">: <?php echo $_SESSION['adults'];?>
								</span>				
							
							</div>
						</div>
						<div class="row">
							<div class="large-6 columns" style="max-width:100%;">
								<span class="fontgrey">Childrens
								</span>
							</div>
							
							<div class="large-4 columns" style="max-width:100%;">
								<span class="">: <?php echo $_SESSION['childrens'];?>
								</span>				
							
							</div>
						</div>
						<div class="row">
							<div class="large-6 columns" style="max-width:100%;">
								<span class="fontgrey" style="font-size:13.2px;">No. of Night Stay(s)
								</span>
							</div>
							
							<div class="large-4 columns" style="max-width:100%;">
								<span class="">: <?php echo  $_SESSION['total_night'];?>
								</span>				
							
							</div>
						</div>
						
					</div>	
				</div>
						

				
				  <div class="row">
					<div class="large-12 columns" >
						<br><button name="submit" href="#" class="button small fontslabo" style="background-color:#2ecc71; width:100%;" >Edit Reservation</button>
					</div>
				  </div>
				</form>
		</div>
	


	</div>
	<div class="large-8 columns blackblur fontcolor" style="padding:10px">
	
		<div class="large-12 columns" >
			<?php
				include './auth.php';
				$datestart =  date('y-m-d', strtotime($_SESSION['checkin_unformat']) );
				$dateend =  date('y-m-d', strtotime($_SESSION['checkout_unformat']));
				$result = mysqli_query($conn, "SELECT r.homestay_id, (r.total_homestay-br.total) as availablehomestay from homestay as r LEFT JOIN ( 
				
										SELECT homestaybook.homestay_id, sum(homestaybook.totalhomestaybook) as total from homestaybook where homestaybook.booking_id IN 
											(
												SELECT b.booking_id as bookingID from booking as b 
												where 
												(b.checkin_date between '".$datestart."' AND '".$dateend."') 
												OR 
												(b.checkout_date between '".$dateend."' AND '".$datestart."')
												
												
											)
										
										group by homestaybook.homestay_id
										)
										as br
					 
					 ON r.homestay_id = br.homestay_id");

				if (!$result) {
					die('query failed' . mysqli_error($conn));
					exit();
				}
										
				if(mysqli_num_rows($result) > 0){
					echo "<p><b>Choose Your Homestay</b></p><hr class=\"line\">";
					while ($row = mysqli_fetch_array($result)) {
						if($row['availablehomestay'] != null && $row['availablehomestay'] > 0  )
						{
							
							$sub_result = mysqli_query($conn, "select homestay.* from homestay where homestay.homestay_id = ".$row['homestay_id']." ");
							
							if(mysqli_num_rows($sub_result) > 0)
							{
								while($sub_row = mysqli_fetch_array($sub_result)){
								
								print "				<form name=\"form".$sub_row['homestay_id']."\" action=\"guestform.php\" method=\"post\" onsubmit=\"return validateForm(".$sub_row['homestay_id'].");\">\n";
								print "					<p><h4>".$sub_row['homestay_name']."</h4></p>\n";
								print "					<div class=\"row\">\n";
								print "					\n";
								print "						<div class=\"large-4 columns\">\n";
								print "							<img src=\"".$sub_row['imgpath']."\"></img>\n";
								print "						</div>\n";
								print "						<div class=\"large-4 columns\">\n";
								print "						<p><span class=\"fontgrey\">Occupancy : </span> ".$sub_row['occupancy']."<br>\n";
								print "						<span class=\"fontgrey\">Size : </span> ".$sub_row['size']."\n";
								print "						<br><span class=\"fontgrey\">View : </span> ".$sub_row['view']."</p>\n";
								print "\n";
								print "						</div>\n";
								print "						<div class=\"large-4 columns\">\n";
								print "						<p ><span class=\"fontgrey\">Rate : MYR </span><span style=\"font-size:24px;\">".$sub_row['rate']."</span><span class=\"fontgrey\">/ night</span><br>\n";
								print "						<span style=\"text-align:right;\">".$row['availablehomestay']." homestay available</span>\n";
								print "						</p>\n";
								print "							<div class=\"row\">\n";
								print "								<div class=\"large-6 columns\">\n";
								print "									<label class=\"fontcolor\">\n";
								print "										<select  class=\"no_of_homestay\" name=\"totalhomestay\" id=\"homestay".$sub_row['homestay_id']."\" style=\"width:100%; color:black; height:45px;\" onchange=\"validateHomestay(this);\">\n";
								print "											<option selected=\"selected\" value=\"0\">0</option>\n";
																				$i = 1;
																				while($i <= $row['availablehomestay'])
																				{
								print "											<option value=\"".$i."\">".$i."</option>\n";	
																				$i = $i+1;
																				}
								print "										</select>\n";
								print "									</label>\n";
								print "								</div>\n";
								print "								<div class=\"large-6 columns\">\n";
							    print "<input type=hidden name=\"selectedhomestay\" value=\"".$sub_row['homestay_id']."\">";
								print "<input type=hidden name=\"homestay_name\" value=\"".$sub_row['homestay_name']."\">";
								print "									<button type=\"submit\"  class=\"book button small\" style=\"background-color:#2ecc71; width:100%; height:45px; !important;\" onclick=\"validateClick(this);\">Book</button>\n";
								print "								</div>\n";
								print "							</div>\n";
								print "						</div>\n";
								print "						\n";
								print "					</div>\n";
								print "					\n";
								print "				</form><hr>";
								}
							}
						}
						else if($row['availablehomestay'] == null ){
							$sub_result2 = mysqli_query($conn, "select homestay.* from homestay where homestay.homestay_id = ".$row['homestay_id']." ");
							if(mysqli_num_rows($sub_result2) > 0)
							{
								while($sub_row2 = mysqli_fetch_array($sub_result2)){
								print "				<form name=\"form".$sub_row2['homestay_id']."\" action=\"guestform.php\" method=\"post\" onsubmit=\"return validateForm(".$sub_row2['homestay_id'].");\">\n";
								print "					<p><h4>".$sub_row2['homestay_name']."</h4></p>\n";
								print "					<div class=\"row\">\n";
								print "					\n";
								print "						<div class=\"large-4 columns\">\n";
								print "							<img src=\"".$sub_row2['imgpath']."\"></img>\n";
								print "						</div>\n";
								print "						<div class=\"large-4 columns\">\n";
								print "						<p><span class=\"fontgrey\">Occupancy : </span> ".$sub_row2['occupancy']."<br>\n";
								print "						<span class=\"fontgrey\">Size : </span> ".$sub_row2['size']."\n";
								print "						<br><span class=\"fontgrey\">View : </span> ".$sub_row2['view']."</p>\n";
								print "\n";
								print "						</div>\n";
								print "						<div class=\"large-4 columns\">\n";
								print "						<p ><span class=\"fontgrey\">Rate : MYR </span><span style=\"font-size:24px;\">".$sub_row2['rate']."</span><span class=\"fontgrey\">/ night</span><br>\n";
								print "						<span style=\"text-align:right;\">".$sub_row2['total_homestay']." homestay available</span>\n";
								print "						</p>\n";
								print "							<div class=\"row\">\n";
								print "								<div class=\"large-6 columns\">\n";
								print "									<label class=\"fontcolor\">\n";
								print "										<select  class=\"no_of_homestay\" name=\"totalhomestay\" id=\"homestay".$sub_row2['homestay_id']."\" style=\"width:100%; color:black; height:45px;\" onchange=\"validateHomestay(this);\">\n";
								print "											<option selected=\"selected\" value=\"0\">0</option>\n";
																				$i = 1;
																				while($i <= $sub_row2['total_homestay'])
																				{
								print "											<option value=\"".$i."\">".$i."</option>\n";	
																				$i = $i+1;
																				}
								print "										</select>\n";
								print "									</label>\n";
								print "								</div>\n";
								print "								<div class=\"large-6 columns\">\n";
							    print "<input type=hidden name=\"selectedhomestay\" value=\"".$sub_row2['homestay_id']."\">";
								print "<input type=hidden name=\"homestay_name\" value=\"".$sub_row2['homestay_name']."\">";
								print "									<button type=\"submit\"  class=\"book button small\" style=\"background-color:#2ecc71; width:100%; height:45px; !important;\" onclick=\"validateClick(this);\">Book</button>\n";
								print "								</div>\n";
								print "							</div>\n";
								print "						</div>\n";
								print "						\n";
								print "					</div>\n";
								print "					\n";
								print "				</form><hr>";
								}
								//print
							}
						}
					}
				}
				else{
				echo "<p><b>No homestay available</b></p><hr>";
				}

			?>
		</div>
	


	</div>


</div>
<script>


		var selectCount = 0;
        var old_ddl = "";
        var changed_ddl = false;

        function validateHomestay(ddl) {
			
            if (selectCount == null) {
                selectCount = 0;
            }

            if (old_ddl != ddl.id) {
                changed_ddl = true;
            }else{
                changed_ddl = false;
            }

            if (old_ddl == "") {
                old_ddl = ddl.id;
            }

            if (changed_ddl == true) {
                selectCount = selectCount + 1;
                old_ddl = ddl.id;
            }
            
            var val = ddl.value;
            var homestayid = ddl.id.replace("homestay","");

            $(".no_of_homestay").val("0");

            ddl.value = val;
                        
             if (selectCount > 2) {
                changed_ddl = false;
                old_ddl = "";

                selectCount = 0;
                alert("Sorry, you can only book one homestay type per booking");
                FireEvent(77, "");
                return false;
            }

        }

	function validateForm(homestay_id) {
    var x = $("#homestay"+homestay_id).val();
    if (x == 0) {
        alert("Please choose total homestay to book");
        return false;
    }
}

</script>
</body></html>