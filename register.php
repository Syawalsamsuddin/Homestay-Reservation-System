<?php
require_once('config.php');
?>
<!DOCTYPE html>
<html>
<head>
  <title>User Registration | PHP</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>

<div>
  <?php
  
  ?>  
</div>

<div>
  <form action="register.php" method="post">
    <div class="container">
      
      <div class="row">
        <div class="col-sm-3">
          <h1>Registration</h1>
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
      var username  = $('#username').val();
      var fullname  = $('#fullname').val();
      var email     = $('#email').val();
      var phonenumber = $('#phonenumber').val();
      var password  = $('#password').val();
      
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