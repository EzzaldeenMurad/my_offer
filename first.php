<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>  
</body>
</html>
  <div class="container">
    <h1>Register</h1>
    <p>Please fill in this form to create an account.</p>
    <hr>

<form action="insert-da.php" method="POST">

  <?php if(isset($Frist_error)){
    echo $Frist_error;
  }  ?>
    <label for="First name"><b>First name</b></label>
    <input type="text" placeholder="Enter F-name" name="Fristname" required>

    <?php if(isset($last_error)){
    echo $last_error;
  }  ?>

    <label for="Last name"><b>Last name</b></label>
    <input type="text" placeholder="Enter Last name" name="Lastname" required>

    <?php if(isset($email_error)){
    echo $email_error;
  }  ?>

    <label for="Email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="Email" required>

    <?php if(isset($password_error)){
    echo $password_error;
  }  ?>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>

 
    <label>
      <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
    </label>
    <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

    <div class="clearfix">
      <button type="submit" name="submit" id="submit" value="Register"><a href="home.php">Register</a></button>
      <a href="#" style="color:dodgerblue"><h5>Or log in</h5></a>
    </form>
    </div>
  </div>
</form>

</body>
</html>