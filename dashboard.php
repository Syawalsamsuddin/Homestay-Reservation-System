<?php session_start();
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

 ?>
<!DOCTYPE html>

<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Booking System</title>

  
   <link href="css/bootstrap.min.css" rel="stylesheet">

    
    <link href="css/dashboard.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	<link href="css/datepicker.css" rel="stylesheet" type="text/css"/>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
	<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
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
          <a class="navbar-brand" href="#" style="color: #ffffff;">User Panel</a>
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
            <li class="active"><a href="dashboard.php"><i class="icon-gauge"></i> Dashboard <span class="sr-only">(current)</span></a></li>
            <li><a href="myprofile.php" style="color: blue;"><i class="icon-key"></i> My Profile </a></li>
			<li><a href="homestay.php"style="color: blue;"><i class="icon-key"></i> Manage Homestay</a></li>
			<li><a href="paymentproof.php" style="color: blue;"><i class="icon-key"></i> Payment </a></li>
			
			
          </ul>

        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
         
		 
			<div class="container-fluid">
			 <h4 class="sub-header">Dashboard</h4>
				<div class="row">	
					<?php
					include './auth.php';
					$re = mysqli_query($conn , "select count(booking_id) as total_row from booking WHERE DATEDIFF(NOW(), booking_date) <= 7;");
					$re2 = mysqli_query($conn , "select count(booking_id) as total_row from booking WHERE payment_status like 'pend%';");
					$re3 = mysqli_query($conn , "select count(booking_id) as total_row from booking WHERE payment_status like 'conf%';");
					if(mysqli_num_rows($re) > 0)
					{
						while($row = mysqli_fetch_array($re))
						{
						echo "					<div class=\"col-xs-4\">\n";
						echo "							<div class=\"small-box bg-aqua\">\n";
						echo "                                <div class=\"inner\">\n";
						echo "                                    <h3>\n";
						echo "                                        ".$row['total_row']."\n";
						echo "                                    </h3>\n";
						echo "                                    <p>\n";
						echo "                                        New Booking in Last 7 days\n";
						echo "                                    </p>\n";
						echo "                                </div>\n";
						echo "                                <div class=\"icon\">\n";
						echo "                                    <i class=\"ion ion-person-add\"></i>\n";
						echo "                                </div>                                <a href=\"#\" onClick='more1();' class=\"small-box-footer\">
                                    View Details <i class=\"fa fa-arrow-circle-right\"></i>
                                </a>\n";
						echo "\n";
						echo "                            </div>			\n";
						echo "					</div>";

						}
					}
					if(mysqli_num_rows($re2) > 0)
					{
						while($row2 = mysqli_fetch_array($re2))
						{
						echo "					<div class=\"col-xs-4\">\n";
						echo "							<div class=\"small-box bg-green\">\n";
						echo "                                <div class=\"inner\">\n";
						echo "                                    <h3>\n";
						echo "                                        ".$row2['total_row']."\n";
						echo "                                    </h3>\n";
						echo "                                    <p>\n";
						echo "                                        Booking with Pending Payment\n";
						echo "                                    </p>\n";
						echo "                                </div>\n";
						echo "                                <div class=\"icon\">\n";
						echo "                                    <i class=\"ion ion-person-add\"></i>\n";
						echo "                                </div>                                <a href=\"#\" onClick='more2();' class=\"small-box-footer\">
                                    View Details <i class=\"fa fa-arrow-circle-right\"></i>
                                </a>\n";
						echo "\n";
						echo "                            </div>			\n";
						echo "					</div>";
						
						}
					}
					if(mysqli_num_rows($re3) > 0)
					{
						while($row3 = mysqli_fetch_array($re3))
						{
						echo "					<div class=\"col-xs-4\">\n";
						echo "							<div class=\"small-box bg-yellow\">\n";
						echo "                                <div class=\"inner\">\n";
						echo "                                    <h3>\n";
						echo "                                        ".$row3['total_row']."\n";
						echo "                                    </h3>\n";
						echo "                                    <p>\n";
						echo "                                        Paid Booking\n";
						echo "                                    </p>\n";
						echo "                                </div>\n";
						echo "                                <div class=\"icon\">\n";
						echo "                                    <i class=\"ion ion-person-add\"></i>\n";
						echo "                                </div>                                <a href=\"#\" onClick='more3();' class=\"small-box-footer\">
                                    View Details <i class=\"fa fa-arrow-circle-right\"></i>
                                </a>\n";
						echo "\n";
						echo "                            </div>			\n";
						echo "					</div>";
						
						}
					}
					
					?>


					
				</div>
				
				<div class="row">
						<div class="col-xs-6" >
						<h4 class="sub-header">Search Booking</h4>
									<form class="form-inline" method="post" action="" >
									  <div class="form-group">
										 
										<input class="form-control datepicker" name="checkin" id="checkin" placeholder="Start Date">
									  </div>
									  <div class="form-group">
										
										<input  class="form-control datepicker" name="checkout" id="checkout" placeholder="End Date">
									  </div>
									  <input class="btn" id="search" name="search" value="Search" onClick="return fnSearch();" style="width: 100px; background-color: #4aa3df; color: white;" type="button">
									  
									</form>
						</div>	
		
						<div class="col-xs-6" id="statistics" style="display:block;">
						<h4 class="sub-header">Booking Made</h4>
								<div id="bookingstat" style="height: 250px;"></div>
						</div>
						
				</div>
				<div class="row" id="bookindetails" style="display:none;">
					<hr>        <div class="col-xs-12 "  >
							  
							  <div class="table-responsive">
								<table class="table table-striped">
								  <thead>
									<tr>
									  <th>Booking No.</th>
									  <th>Check In</th>
									  <th>Check Out</th>
									  <th>Homestay</th>
									  <th>Total Amount</th>
									  <th>Deposit</th>
									  <th>Balance</th>
									  <th>Payment Status</th>
									</tr>
								  </thead>
								  <tbody id="bookinginfo"  >
									
									
								   
								  </tbody>
								</table>
							  </div>
							</div>
				</div>
				<div class="row" id="bookinginfo0" style="display:none;">
					<hr>        <div class="col-xs-12 "  >
							  
							  <div class="table-responsive">
								<table class="table table-striped">
								  <thead>
									<tr>
									  <th>Booking No.</th>
									  <th>Check In</th>
									  <th>Check Out</th>
									  <th>Homestay</th>
									   <th>Total Amount</th>
									  <th>Deposit</th>
									  <th>Balance</th>
									  <th>Payment Status</th>
									</tr>
								  </thead>
								  <tbody id="info0"  >
				<?php include './auth.php';
					$re = mysqli_query($conn, "select booking.* from booking WHERE DATEDIFF(NOW(), booking_date) <= 7 ;");
					if(mysqli_num_rows($re) > 0){
								while ($row = mysqli_fetch_array($re) ){
											
											
											print "<tr style=\"\">		 <td>".$row['booking_id']."</td>\n";
											print "                  <td>".$row['checkin_date']."</td>\n";
											print "                  <td>".$row['checkout_date']."</td>\n";
											print "<td>";
											$q = mysqli_query($conn, "SELECT homestaybook.totalhomestaybook AS total, homestay.homestay_name AS name
																FROM homestaybook
																LEFT JOIN homestay ON homestaybook.homestay_id = homestay.homestay_id
																WHERE homestaybook.booking_id =".$row['booking_id'].";");
											while($r = mysqli_fetch_array($q))
											{
											print "                  ".$r['total']." ".$r['name']." <br>\n";
											}
											print "</td>";
											
											print "                  <td>".$row['total_amount']."</td>\n";
											print "                  <td>".$row['deposit']."</td>\n";
											print "                  <td>".($row['total_amount']-$row['deposit'])."</td>\n";
											print "                  <td>".$row['payment_status']."</td><td><a href=\"detail.php?booking=".$row['booking_id']."\"  \">More Details</a></td><td><a class=\"delete\" href=\"deletebooking.php?booking=".$row['booking_id']."\"  onclick=\"return confirm('Are you sure want to delete this?')\">Delete</a></td></tr>";					
							
								}
					}
				?>
								  </tbody>
								</table>
							  </div>
							</div>
				</div>
				<div class="row" id="bookinginfo1" style="display:none;">
					 <hr>       <div class="col-xs-12 "  >
							  
							  <div class="table-responsive">
								<table class="table table-striped">
								  <thead>
									<tr>
									  <th>Booking No.</th>
									  <th>Check In</th>
									  <th>Check Out</th>
									  <th>Homestay</th>
									   <th>Total Amount</th>
									  <th>Deposit</th>
									  <th>Balance</th>
									  <th>Payment Status</th>
									</tr>
								  </thead>
								  <tbody id="info1"  >
				<?php include './auth.php';
					$re = mysqli_query($conn, "select * from booking WHERE payment_status like 'pend%';");
					if(mysqli_num_rows($re) > 0){
								while ($row = mysqli_fetch_array($re) ){
											print "<tr style=\"\">		 <td>".$row['booking_id']."</td>\n";
											print "                  <td>".$row['checkin_date']."</td>\n";
											print "                  <td>".$row['checkout_date']."</td>\n";
											$q = mysqli_query($conn, "SELECT homestaybook.totalhomestaybook AS total, homestay.homestay_name AS name
																FROM homestaybook
																LEFT JOIN homestay ON homestaybook.homestay_id = homestay.homestay_id
																WHERE homestaybook.booking_id =".$row['booking_id'].";");
											print "<td>";
											while($r = mysqli_fetch_array($q))
											{
											print "                  ".$r['total']." ".$r['name']."<br> \n";
											}
											print "</td>";
											
											print "                  <td>".$row['total_amount']."</td>\n";
											print "                  <td>".$row['deposit']."</td>\n";
											print "                  <td>".($row['total_amount']-$row['deposit'])."</td>\n";
											print "                  <td>".$row['payment_status']."</td><td><a href=\"detail.php?booking=".$row['booking_id']."\"  \">More Details</a></td><td><a class=\"delete\" href=\"deletebooking.php?booking=".$row['booking_id']."\"  onclick=\"return confirm('Are you sure want to delete this?')\">Delete</a></td></tr>";					
							
								}
							}
				?>
								  </tbody>
								</table>
							  </div>
							</div>
				</div>
				<div class="row" id="bookinginfo2" style="display:none;">
					      <hr>  <div class="col-xs-12 "  >
							  
							  <div class="table-responsive">
								<table class="table table-striped">
								  <thead>
									<tr>
									  <th>Booking No.</th>
									  <th>Check In</th>
									  <th>Check Out</th>
									  <th>Homestay</th>
									  <th>Total Amount</th>
									  <th>Deposit</th>
									  <th>Balance</th>
									  <th>Payment Status</th>
									</tr>
								  </thead>
								  <tbody id="info2"  >
				<?php include './auth.php';
					$re = mysqli_query($conn, "select * from booking WHERE payment_status like 'conf%';");
					if(mysqli_num_rows($re) > 0){
								while ($row = mysqli_fetch_array($re) ){
											print "<tr style=\"\">		 <td>".$row['booking_id']."</td>\n";
											print "                  <td>".$row['checkin_date']."</td>\n";
											print "                  <td>".$row['checkout_date']."</td>\n";
											print "<td>";
											$q = mysqli_query($conn, "SELECT homestaybook.totalhomestaybook AS total, homestay.homestay_name AS name
																FROM homestaybook
																LEFT JOIN homestay ON homestaybook.homestay_id = homestay.homestay_id
																WHERE homestaybook.booking_id =".$row['booking_id'].";");
											while($r = mysqli_fetch_array($q))
											{
											print "                  ".$r['total']." ".$r['name']." <br>\n";
											}
											print "</td>";
											
											print "                  <td>".$row['total_amount']."</td>\n";
											print "                  <td>".$row['deposit']."</td>\n";
											print "                  <td>".($row['total_amount']-$row['deposit'])."</td>\n";
											print "                  <td>".$row['payment_status']."</td><td><a href=\"detail.php?booking=".$row['booking_id']."\"  \">More Details</a></td><td><a class=\"delete\" href=\"deletebooking.php?booking=".$row['booking_id']."\" onclick=\"return confirm('Are you sure want to delete this?')\" >Delete</a></td></tr>";					
							
								}
							}
				?>
								  </tbody>
								</table>
							  </div>
							</div>
				</div>
				
			</div>


        </div>
      </div>
    </div>

   
  <script>
		new Morris.Line({
		 
		  element: 'bookingstat',
		  
		  data: [
		  <?php
					include './auth.php';
					$re = mysqli_query($conn, "select MONTH(booking_date) as month, YEAR(booking_date) as year, count(booking_date) as value from booking group by MONTH(booking_date);");

					if(mysqli_num_rows($re) > 0)
					{
						echo "{ month: '2019-01', value: 0},";
						echo "{ month: '2019-12', value: 0},";
						$count=0;
						while($row = mysqli_fetch_array($re))
						{
						echo "{ month: '".$row['year']."-".$row['month']."', value: ".$row['value']." },";
						}
						
					}
			?>
			
		  ],
		 
		  xkey: 'month',
	
		  ykeys: ['value'],
		  
		  labels: ['Value']
		});
  </script>


</body></html>