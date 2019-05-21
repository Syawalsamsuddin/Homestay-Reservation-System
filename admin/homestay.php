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
<!DOCTYPE html>
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
            
			<li class="active"><a href="homestay.php"><i class="icon-key"></i> Homestay</a></li>
			
			
          </ul>

        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" id="roomdetail">
          

          <h2 class="sub-header">Homestay Details</h2>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Homestay Name</th>
                  <th>Total Homestay</th>
                  <th>Thumbnail</th>
                  <th>Total Room</th>
				  <th>Type Homestay</th>
                  <th>Parking</th>
			      <th>Address</th>
                  <th>Rate</th>
                  <th>Description</th>
                </tr>
              </thead>
              <tbody id="homestayinfo"  >
					<?php 
						include './auth.php';
						$result = mysqli_query($conn , "select * from homestay ");
						if(mysqli_num_rows($result) > 0){
							while ($row = mysqli_fetch_array($result) ){
								print "<tr style=\"\">		 <td>".$row['homestay_name']."</td>\n";
								print "                  <td>".$row['total_homestay']."</td>\n";
								print "                  <td><img src=\"../".$row['imgpath']."\" style=\"height:50px;width:50px;\"\"></td>\n";
								print "                  <td>".$row['total_room']."</td>\n";
								print "                  <td>".$row['type_homestay']." </td>\n";
								print "                  <td>".$row['parking_no']."</td>\n";
								print "                  <td>".$row['address']."</td>\n";
								print "                  <td>".$row['rate']."</td>\n";
								print "                  <td>".$row['descriptions']."</td>\n";
								print "                  <td><a href=\"edithomestay.php?homestay_id=".$row['homestay_id']."\" \">Edit</a></td><td><a class=\"delete\" href=\"deletehomestay.php?homestay_id=".$row['homestay_id']."\">Delete</a></td></tr>";					
				
							}
						}			
					
					?>
				
               
              </tbody>
            </table>
          </div>
		 
		  <button type="button" class="btn" id="addhomestay">Add Homestay</button>
        </div>
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" id="formnew" style="display:none;">
		<button type="button" class="btn" id="back">Back</button>
					<form role="form" id="formnew" action="addhomestay.php" method="post" enctype="multipart/form-data">
					  <div class="form-group">
						<label for="homestay_name">Homestay Name</label>
						<input type="text" class="form-control" name="homestay_name" id="homestay_name" placeholder="Homestay Name" required>
					  </div>
					  <div class="form-group">
						<label for="total_homestay">Total Homestay</label>
						<input type="text" class="form-control" name="total_homestay"   id="total_homestay" placeholder="Number of Homestay" required>
					  </div>
					  <div class="form-group">
						<label for="total_room">Total Room</label>
						<input type="text" class="form-control" name="total_room"   id="total_room" placeholder="Number of room" required>
					  </div>
					   <div class="form-group">
						<label for="type_homestay">Type Homestay</label>
						<input type="text" class="form-control" name="type_homestay" id="type_homestay" placeholder=" example: Semi-D">
					  </div>
					  <div class="form-group">
						<label for="parking_no">Parking </label>
						<input type="text" class="form-control"  name="parking_no" id="size" placeholder="Number space for parking a car ">
					  </div>
					  <div class="form-group">
						<label for="address">Address</label>
						<input type="text" class="form-control" name="address" id="address" placeholder="Make sure easy to find it ">
					  </div>
					  <div class="form-group">
						<label for="rate">Rate</label>
						<input type="text" class="form-control"  nsme="rate" id="rate" placeholder="Write without MYR or RM" required>
					  </div>
					  <div class="form-group">
						<label for="desc">Descriptions</label>
						<input type="text" class="form-control" name="desc" id="desc" placeholder="">
					  </div>
					  <div class="form-group">
						<label for="img">Upload Homestay Image [recommended size is 400 X 400]</label>
						<input type="file" id="img" name="img" required>
						<input type="file" id="img" name="img" required>
						<input type="file" id="img" name="img" required>
						<input type="file" id="img" name="img">
						<input type="file" id="img" name="img">
						
					  </div>
					  <button type="submit" class="btn btn-default">Submit</button>
					</form>
		</div>
		
      </div>
    </div>
	

    
  <script>
  $( document ).ready(function() {
      $("#addhomestay").click(function(){
		$("#formnew").toggle();
		$("#homestaydetail").toggle();
	  });
	  $("#back").click(function(){
		$("#formnew").toggle();
		$("#homestaydetail").toggle();
	  });
	});
	function moredetail(id)
	{
	var x = "booking"+id;
	document.getElementById(x).style.display = "block";
	}
	
	$('.delete').click (function () {
		return confirm ("Are you sure you want to delete?") ;
	}); 
	
  </script>

<div id="global-zeroclipboard-html-bridge" class="global-zeroclipboard-container" title="" style="position: absolute; left: 0px; top: -9999px; width: 15px; height: 15px; z-index: 999999999;" data-original-title="Copy to clipboard">      <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" id="global-zeroclipboard-flash-bridge" width="100%" height="100%">         <param name="movie" value="/assets/flash/ZeroClipboard.swf?noCache=1416326489703">         <param name="allowScriptAccess" value="sameDomain">         <param name="scale" value="exactfit">         <param name="loop" value="false">         <param name="menu" value="false">         <param name="quality" value="best">         <param name="bgcolor" value="#ffffff">         <param name="wmode" value="transparent">         <param name="flashvars" value="trustedOrigins=getbootstrap.com%2C%2F%2Fgetbootstrap.com%2Chttp%3A%2F%2Fgetbootstrap.com">         <embed src="/assets/flash/ZeroClipboard.swf?noCache=1416326489703" loop="false" menu="false" quality="best" bgcolor="#ffffff" width="100%" height="100%" name="global-zeroclipboard-flash-bridge" allowscriptaccess="sameDomain" allowfullscreen="false" type="application/x-shockwave-flash" wmode="transparent" pluginspage="http://www.macromedia.com/go/getflashplayer" flashvars="trustedOrigins=getbootstrap.com%2C%2F%2Fgetbootstrap.com%2Chttp%3A%2F%2Fgetbootstrap.com" scale="exactfit">                </object></div><svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" viewBox="0 0 200 200" preserveAspectRatio="none" style="visibility: hidden; position: absolute; top: -100%; left: -100%;"><defs></defs><text x="0" y="10" style="font-weight:bold;font-size:10pt;font-family:Arial, Helvetica, Open Sans, sans-serif;dominant-baseline:middle">200x200</text></svg></body></html>