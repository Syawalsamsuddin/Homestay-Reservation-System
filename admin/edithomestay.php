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
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" id="formnew" >
		<?php 
		$homestay_id = $_GET['homestay_id'];
		include './auth.php';
		$result = mysqli_query($conn, "SELECT * from homestay where homestay_id ='".$homestay_id."' ");
		if(mysqli_num_rows($result) > 0)
		while($rows = mysqli_fetch_array($result)){
		print "					<form role=\"form\" id=\"formnew\" action=\"updatehomestay.php\" method=\"post\" enctype=\"multipart/form-data\">\n";
		print "						<input type=\"hidden\" class=\"form-control\" name=\"homestay_id\" id=\"homestay_id\" placeholder=\"Homestay ID\" value=\"".$homestay_id."\" required>\n";
		print "					  <div class=\"form-group\">\n";
		print "						<label for=\"homestay_name\">Homestay Name</label>\n";
		print "						<input type=\"text\" class=\"form-control\" name=\"homestay_name\" id=\"homestay_name\" placeholder=\"Homestay Name\" value=\"".$rows['homestay_name']."\" required>\n";
		print "					  </div>\n";
		print "					  <div class=\"form-group\">\n";
		print "						<label for=\"total_homestay\">Total Homestay</label>\n";
		print "						<input type=\"text\" class=\"form-control\" name=\"total_homestay\"   id=\"total_homestay\" placeholder=\"Number of homestay\" value=\"".$rows['total_homestay']."\" required>\n";
		print "					  </div>\n";
		print "					   <div class=\"form-group\">\n";
		print "						<label for=\"total_room\">Total Room</label>\n";
		print "						<input type=\"text\" class=\"form-control\" name=\"total_room\" id=\"total_room\" placeholder=\" Number of Room\" value=\"".$rows['total_room']."\">\n";
		print "					  </div>\n";
		print "					  <div class=\"form-group\">\n";
		print "						<label for=\"type_homestay\">Type Homestay</label>\n";
		print "						<input type=\"text\" class=\"form-control\"  name=\"type_homestay\" id=\"type_homestay\" placeholder=\"Example: Semi-D\" value=\"".$rows['type_homestay']."\">\n";
		print "					  </div>\n";
		print "					  <div class=\"form-group\">\n";
		print "						<label for=\"parking_no\">Parking</label>\n";
		print "						<input type=\"text\" class=\"form-control\" name=\"parking_no\" id=\"parking_no\" placeholder=\"example: 2\" value=\"".$rows['parking_no']."\">\n";
		print "					  </div>\n";
		print "					  <div class=\"form-group\">\n";
		print "						<label for=\"address\">Address</label>\n";
		print "						<input type=\"text\" class=\"form-control\" name=\"address\" id=\"address\" placeholder=\"Make sure easy to find a location\" value=\"".$rows['address']."\">\n";
		print "					  </div>\n";
		print "					  <div class=\"form-group\">\n";
		print "						<label for=\"rate\">Rate</label>\n";
		print "						<input type=\"text\" class=\"form-control\"  name=\"rate\" id=\"rate\" placeholder=\"Write without MYR or RM\" value=\"".$rows['rate']."\" required>\n";
		print "					  </div>\n";
		print "					  <div class=\"form-group\">\n";
		print "						<label for=\"desc\">Descriptions</label>\n";
		print "						<input type=\"text\" class=\"form-control\" name=\"desc\" id=\"desc\" value=\"".$rows['descriptions']."\" placeholder=\"\">\n";
		print "					  </div>\n";
		print "						<img src=\"../".$rows['imgpath']."\" style=\"height:200px; width:200px;\"/>";
		print "					  <div class=\"form-group\">\n";
		print "						<label for=\"img\">Upload Room Image</label>\n";
		print "						<input type=\"file\" id=\"img\" name=\"img\" >\n";
		print "						<!-- p class=\"help-block\">Example block-level help text here.</p-->\n";
		print "					  </div>\n";
		print "					  <button type=\"submit\" class=\"btn btn-default\">Update Room Detail</button>\n";
		print "					</form>";		
		
		
		}


		?>

		</div>
		
      </div>
    </div>
	

  <script>

  </script>

<div id="global-zeroclipboard-html-bridge" class="global-zeroclipboard-container" title="" style="position: absolute; left: 0px; top: -9999px; width: 15px; height: 15px; z-index: 999999999;" data-original-title="Copy to clipboard">      <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" id="global-zeroclipboard-flash-bridge" width="100%" height="100%">         <param name="movie" value="/assets/flash/ZeroClipboard.swf?noCache=1416326489703">         <param name="allowScriptAccess" value="sameDomain">         <param name="scale" value="exactfit">         <param name="loop" value="false">         <param name="menu" value="false">         <param name="quality" value="best">         <param name="bgcolor" value="#ffffff">         <param name="wmode" value="transparent">         <param name="flashvars" value="trustedOrigins=getbootstrap.com%2C%2F%2Fgetbootstrap.com%2Chttp%3A%2F%2Fgetbootstrap.com">         <embed src="/assets/flash/ZeroClipboard.swf?noCache=1416326489703" loop="false" menu="false" quality="best" bgcolor="#ffffff" width="100%" height="100%" name="global-zeroclipboard-flash-bridge" allowscriptaccess="sameDomain" allowfullscreen="false" type="application/x-shockwave-flash" wmode="transparent" pluginspage="http://www.macromedia.com/go/getflashplayer" flashvars="trustedOrigins=getbootstrap.com%2C%2F%2Fgetbootstrap.com%2Chttp%3A%2F%2Fgetbootstrap.com" scale="exactfit">                </object></div><svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" viewBox="0 0 200 200" preserveAspectRatio="none" style="visibility: hidden; position: absolute; top: -100%; left: -100%;"><defs></defs><text x="0" y="10" style="font-weight:bold;font-size:10pt;font-family:Arial, Helvetica, Open Sans, sans-serif;dominant-baseline:middle">200x200</text></svg></body></html>