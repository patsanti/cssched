<?php
 include("php/hide.php");
if(!isset($_GET['aassmmss'])){
    header("LOcation: http://localhost/augeo/global/php/page_error.php");
}
else{
    include("php/hide.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Password Reset</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://localhost/augeo/global/vendor/bootstrap/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="css/index.css" />
</head>
<body>

<div class="container">
  <div align="center">
<img src="http://localhost/augeo/global/img/logo.png" id="brand-logo1">
  <h2>Recover Account</h2>

   </div>

<div class="panel-login">
  <div id="hello_user" class="hello_user"></div>
  <form name="c_Form" id="c_Form" method="POST" action="php/change_pass.php" onsubmit="return validateForm()">

    <div class="form-group">
      <input type="hidden" name="hidden" id="hidden" value="<?php echo $id; ?>">
      <label for="c_pass">New Password:</label>
      <input type="password" class="input-group" name="c_pass" id="c_pass" required>
    </div>

    <div class="form-group">
      <label for="n_pass">Re-enter Password:</label>
      <input type="password" class="input-group" name="n_pass" id="n_pass" required>
      <span id="error_msg" class="help-block"></span>
    </div>

    <input type="submit" class="btn btn-default" name="submit" id="submit" value="submit">
  </form>
</div>
</div>
<script src="http://localhost/augeo/global/vendor/jquery/dist/jquery.min.js"></script>
<script src="http://localhost/augeo/global/vendor/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="js/index.js"></script>
</body>
</html>
