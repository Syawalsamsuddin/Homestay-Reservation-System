<?php
require_once('config.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Unisel Homestay Reservation| Sign Up </title>
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-social.css">
  <link rel="stylesheet" href="css/bootstrap-select.css">
  <link rel="stylesheet" href="css/fileinput.min.css">
  <link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div>
	<?php
	
	?>	
</div>

<div class="login-page bk-img" style="background-color: white;">
	<form action="registration.php" method="post">
		<div class="container">
			
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<h2 class="text-center text-bold text-black ">Registration</h2>
					<div class="well row pt-2x pb-3x bk-light">
              <div class="col-md-8 col-md-offset-2">
					<p>Fill up the form with correct values.</p>
					<hr class="mb-3">
					<label for="username"><b>Username</b></label>
					<input class="form-control" id="username" type="text" name="username" required>

					<label for="fullname"><b>Full Name</b></label>
					<input class="form-control" id="fullname"  type="text" name="fullname" required>

					<label for="email"><b>Email Address</b></label>
					<input class="form-control" id="email"  type="email" name="email" required>

					<label for="phonenumber"><b>Phone Number</b></label>
					<input class="form-control" id="phonenumber"  type="text" name="phonenumber" required>

					<label for="password"><b>Password</b></label>
					<input class="form-control" id="password"  type="password" name="password" required>
					<hr class="mb-3">
					<input class="btn btn-primary" type="submit" id="register" name="create" value="Sign Up">
					 <p> Already  have an account? <a href="login.php">Login here</a>.</p>
				</div>
			</div>
		</div>
	</form>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script type="text/javascript">
	$(function(){
		$('#register').click(function(e){
			var valid = this.form.checkValidity();
			if(valid){
			var username 	= $('#username').val();
			var fullname	= $('#fullname').val();
			var email 		= $('#email').val();
			var phonenumber = $('#phonenumber').val();
			var password 	= $('#password').val();
			
				e.preventDefault();	
				$.ajax({
					type: 'POST',
					url: 'process.php',
					data: {username: username,fullname: fullname,email: email,phonenumber: phonenumber,password: password},
					success: function(data){
					Swal.fire({
								'title': 'Successful',
								'text': data,
								'type': 'success'
								})
							
					},
					error: function(data){
						Swal.fire({
								'title': 'Errors',
								'text': 'There were errors while saving the data.',
								'type': 'error'
								})
					}
				});
				
			}else{
				
			}
			
		});		
		
	});
	
</script>
</body>
</html>