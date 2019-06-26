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

  <title>Unisel Homestay Reservation| Upload File </title>
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

  <form action="uploadfile.php" method="post" enctype="multipart/form-data">
    <div class="container">
      
      <div class="row">
        <div class="col-md-6 col-md-offset-3">
          <h2>Upload Payment Receipt</h2>
          <p>Fill up the form with correct values.</p>
          <div class="well row pt-2x pb-3x bk-light">
              <div class="col-md-8 col-md-offset-2">
          <hr class="mb-3">

          <label for="email"><b>Email Address</b></label>
          <input class="form-control" id="email"  type="email" name="email" required>

          <label for="phonenumber"><b>Phone Number</b></label>
          <input class="form-control" id="phonenumber"  type="text" name="phonenumber" required>

          <label for="file"><b>Upload File </b></label>
            <input class="form-control" id="file"  type="file" name="file" required >
          <hr class="mb-3">
          <input class="btn btn-primary" type="submit" id="uploadfile" name="Submit" value="Submit">
        </div>
      </div>
    </div>
  </form>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script type="text/javascript">

  $("form").submit(function(e){
    e.preventDefault();
    var formdata = new FormData($(this)[0]);

    $.ajax({
      url: "process-uploadfile.php",
      type: "POST",
      data: formdata,
      async: false,
      cache: false,
      contentType: false,
      enctype: "multipart/form-data",
      processData: false,
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
  });
  
  
</script>
</body>
</html>