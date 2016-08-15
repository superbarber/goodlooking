<?php
// define variables and set to empty values
$nameErr = $emailErr = $phoneErr = $pwdErr = $conPwdErr = "";
$name = $email = $phone = $pwd = $conPwd = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
    }
  }

  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }

  if (empty($_POST["phone"])) {
    $phoneErr = "Phone Number Required";
  } else {
      $phone = test_input($_POST["phone"]);
      $length = strlen((string)$_POST["phone"]);
      if ($length < 10){
          $phoneErr = "Please Enter Number with at least 10 digits";
      }
  }

  if (empty($_POST["pwd"])) {
    $pwdErr = "Password is required";
  } else {
      $pwd = test_input($_POST["pwd"]);
      $length = strlen((string)$_POST["pwd"]);
      if ($length < 6){
          $pwdErr = "Please Enter Password with at least 6 characters";
      }
  }

  if (empty($_POST["conPwd"])) {
    $conPwdErr = "Password confirmation is required";
  } else {
      $conPwd = test_input($_POST["conPwd"]);
      $length = strlen((string)$_POST["conPwd"]);
      if ($length < 6){
          $conPwdErr = "Please Enter Password with at least 6 characters";
      }

  }

    if ((isset($_POST["pwd"])) && (isset($_POST["conPwd"]))){
        if (($_POST["pwd"]) != ($_POST["conPwd"])){
            $pwdErr = "Passwords must match";
            $conPwdErr = "Passwords must match";
        }
    }
}



function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Enable responsive viewport -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="/css/style.css" />

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

</head>
<body>
        <nav id="topNav" class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#Navbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/">Good Looking Out!</a>
                </div>
                <div class="collapse navbar-collapse" id="Navbar">
                    <ul class="nav navbar-nav">
                        <li><a href="/"><span class="glyphicon glyphicon-home"></span></a></li>
                        <li><a href="/about/">About Us</a></li>
                        <li><a href="/advertise/">Advertise Your Shop</a></li>
                        <li><a href="/contact/">Contact Us</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="/account/"><span class="glyphicon glyphicon-user"></span> Create User Account</a></li>
                        <li class="dropdown">
                            <a class="dropdown-togggle" data-toggle="dropdown"> Sign In As:
                                <span class="glyphicon glyphicon-log-in"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="/busLog/">Business</a></li>
                                <li><a href="/userLog/">User</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <br><br><br><br>
<style>
    #aboutJumbo5 {
  background-color: #000000;
  opacity: 0.8;
  border-width: thick;
  font-family: Verdana, Arial, Tahoma, Lucida, "Courier New", sans-serif;
  border-style: solid;
  border-color: #ffcc00;
  color: #ffcc00;
}

.error{
    color: #ff0000;
}

</style>


<div class="container">
    <div class="row-fluid">
        <div class="col-xs-12 text-center">
            <div class="jumbotron"  id="aboutJumbo5">
                <h2>Create an Account:</h2>
                <form id="accountForm" class="form-horizontal" role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="contactName">Your First and Last Name:</label>
                        <div class="col-xs-4">
                            <input type="text" value="<?php echo $name;?>" class="form-control" id="contactName" name="name">
                        </div>
                        <span class="error col-xs-1">* <?php echo $nameErr;?></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="email">Your Email:</label>
                        <div class="col-xs-4">
                            <input type="email" value="<?php echo $email;?>" class="form-control" id="email" name="email">
                        </div>
                        <span class="error col-xs-1">* <?php echo $emailErr;?></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="number">Best Phone Number for You:</label>
                        <div class="col-xs-2">
                            <input type="tel" value="<?php echo $phone;?>" onkeyup="this.value=this.value.replace(/[^\d]+/, '')" maxlength="14" placeholder="xxx-xxx-xxxx" class="form-control" id="number" name="phone">
                        </div>
                        <span class="error col-xs-1">* <?php echo $phoneErr;?></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="password">Password:</label>
                        <div class="col-xs-2">
                            <input type="password" class="form-control" maxlength="20" id="password" name="pwd">
                        </div>
                        <span class="error col-xs-1">* <?php echo $pwdErr;?></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="confirmPassword">Confirm Password:</label>
                        <div class="col-xs-2">
                            <input type="password" class="form-control" maxlength="20" id="confirmPassword" name="conPwd">
                        </div>
                        <span class="error col-xs-1">* <?php echo $conPwdErr;?></span>
                    </div>

                    <input type="submit" value="Submit" name="submit" id="formSubmit">
            </div>
        </div>
    </div>
</div>

</body>
</html>
