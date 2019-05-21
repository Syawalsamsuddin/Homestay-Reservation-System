<?php
session_start();
?>
 
<!DOCTYPE html>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Unisel Homestay Reservation</title>
<link rel="stylesheet" href="scss/normalize.css">
<link rel="stylesheet" href="scss/foundation.css">
<link rel="stylesheet" href="scss/style.css">
<link rel="stylesheet" href="scss/datepicker.css">
<link href="scss/datepicker.css" rel="stylesheet" type="text/css"/>  
<link href='http://fonts.googleapis.com/css?family=Slabo+13px' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>

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
</script>
<link href='http://fonts.googleapis.com/css?family=Slabo+27px' rel='stylesheet' type='text/css'>
<meta class="foundation-data-attribute-namespace"><meta class="foundation-mq-xxlarge"><meta class="foundation-mq-xlarge"><meta class="foundation-mq-large"><meta class="foundation-mq-medium"><meta class="foundation-mq-small"><style></style><meta class="foundation-mq-topbar"></head>
<body class="fontbody" style="background-image : url(img/unisel.jpg); no-repeat center center fixed; background-size: cover;">

	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid" style="background-color: black;">

        <div class="navbar-header" style="margin-right: 10px; padding:10px;">
            <a href="login.php" style="color: white ;">Login</a>
            <a href="confirmbooking.php" style="color: white ;">Confirm Booking</a>
        </div>
      </div>
    </nav>
 
<div class="row foo" style="margin:30px auto 30px auto;"><br><br>


</div>
</div>
<div class="row">
	<div class="large-4 columns blackblur fontcolor" style="padding-top:10px;">
	
	<div class="large-12 columns " >
	<p><b>Check Date</b></p><hr class="line">
			<form name="form" action="checkroom.php" method="post" onSubmit="return validateForm(this);">
			<div class="row">
				
					<div class="large-6 columns" style="max-width:100%;">
						<label class="fontcolor" for="checkin">Check In
							<input name="checkin" id="checkin" style="width:100%;"/>
						</label>
					</div>
			
					
					<div class="large-6 columns" style="max-width:100%;">
						<label class="fontcolor" for="checkout">Check Out
							<input name="checkout" id="checkout" style="width:100%;"/>
						</label>
					</div>
			</div><br>
			
			  <div class="row">
				<div class="large-6 columns" >
					<button name="submit" href="#" class="button small fontslabo" style="background-color: #2ecc71 ; width:100%;" >Check Availability</button>
				</div>
			  </div>
			</form>
	</div>
	


</div>
</div>
<script>
	function validateForm(form) {
		var a = form.checkin.value;
		var b = form.checkout.value;
			if(a == null || b == null || a == "" || b == "") 
			{
			 alert("Please choose date");
			 return false;
			}
			
			

	}
</script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-57205452-1', 'auto');
  ga('send', 'pageview');

</script>
</body></html>