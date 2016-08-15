<?php
// define variables and set to empty values
$shopNameErr = $firstNameErr = $lastNameErr = $emailErr = $phoneErr = $commentErr = "";
$shopName = $firstName = $lastName = $email = $phone = $comment = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["shopName"])) {
    $shopNameErr = "Name is required";
  } else {
    $shopName = test_input($_POST["shopName"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z0-9' ]*$/",$shopName)) {
      $shopNameErr = "Only letters, numbers, and spaces allowed";
    }
  }

  if (empty($_POST["firstName"])) {
    $firstNameErr = "Name is required";
  } else {
    $firstName = test_input($_POST["firstName"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$firstName)) {
      $firstNameErr = "Only letters and spaces allowed";
    }
  }

  if (empty($_POST["lastName"])) {
    $lastNameErr = "Name is required";
  } else {
    $lastName = test_input($_POST["lastName"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$lastName)) {
      $lastNameErr = "Only letters and spaces allowed";
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
  } 
  else {
      $phone = test_input($_POST["phone"]);
      $length = strlen((string)$_POST["phone"]);
      if ($length < 10){
        $phoneErr = "Please Enter Number with at least 10 digits";
      }
  }

  if (empty($_POST["comment"])) {
    $commentErr = "Please enter a comment";
  } else {
    $comment = test_input($_POST["comment"]);
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
    #aboutJumbo3 {
  background-color: #000000;
  opacity: 0.8;
  border-width: thick;
  font-family: Verdana, Arial, Tahoma, Lucida, "Courier New", sans-serif;
  border-style: solid;
  border-color: #ffcc00;
  color: #ffcc00;
}

.error {
    color: #ff0000;
}

</style>
<div class="container">
    <div class="row-fluid">
        <div class="col-xs-12 text-center">
            <div class="jumbotron"  id="aboutJumbo3">
                <h2>
                    Question? Concern? Complaint? Idea?<br> Please take a moment to tell us a little bit about your self and then please tell us what you think. Your opinion is greatly valued. If you are interested in having your shop promoted or advertised, <a href="/advertise/">please click here.</a> 
                </h2><br><br>
                <form class="form-horizontal" role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="shopName">Name of Business You Represent:<br>(If not applicable, list "N/A")</label>
                        <div class="col-xs-4">
                            <input type="text" class="form-control" value="<?php echo $shopName;?>" name="shopName" id="shopName" onkeyup="this.value=this.value.replace(/[^\d\sa-zA-z']/, '')">
                        </div>
                        <span class="error col-xs-1">* <?php echo $shopNameErr;?></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="firstName">Your First Name:</label>
                        <div class="col-xs-4">
                            <input type="text" class="form-control" value="<?php echo $firstName;?>" name="firstName" id="firstName" onkeyup="this.value=this.value.replace(/[^\sa-zA-z]/, '')">
                        </div>
                        <span class="error col-xs-1">* <?php echo $firstNameErr;?></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="lastName">Your Last Name:</label>
                        <div class="col-xs-4">
                            <input type="text" class="form-control" value="<?php echo $lastName;?>" name="lastName" id="lastName" onkeyup="this.value=this.value.replace(/[^\sa-zA-z]/, '')">
                        </div>
                        <span class="error col-xs-1">* <?php echo $lastNameErr;?></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="email">Your Email:</label>
                        <div class="col-xs-4">
                            <input type="email" class="form-control" value="<?php echo $email;?>" name="email" id="email">
                        </div>
                        <span class="error col-xs-1">* <?php echo $emailErr;?></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="number">Best Phone Number for You:</label>
                        <div class="col-xs-2">
                            <input type="tel" maxlength="14" value="<?php echo $phone;?>" name="phone" class="form-control" id="number">
                        </div>
                        <span class="error col-xs-1">* <?php echo $phoneErr;?></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="comment">Comments:</label>
                        <div class="col-xs-7">
                            <textarea class="form-control" id="comment" name="comment" rows="7"><?php echo $comment;?></textarea>
                        </div>
                        <span class="error col-xs-1">* <?php echo $commentErr;?></span>
                    </div>
                    <input type="submit" value="Submit">
                </form>
            </div>
        </div>
    </div>
</div>


</body>
</html>

