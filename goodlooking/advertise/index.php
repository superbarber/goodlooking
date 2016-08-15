<?php
// define variables and set to empty values
$shopErr = $firstNameErr = $lastNameErr = $emailErr = $phoneErr = $stateErr = $radioOptErr = $contactOptErr = "";
$shop = $firstName = $lastName = $email = $phone = $state = $time = $radioOpt = $contactOpt = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["shopName"])) {
    $shopErr = "Name is required";
  } else {
    $shop = test_input($_POST["shopName"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z0-9 ]*$/",$shop)) {
      $shopErr = "Only letters, numbers, and spaces allowed";
    }
  }

  if (empty($_POST["firstName"])) {
    $firstNameErr = "Name is required";
  } else {
    $firstName = test_input($_POST["firstName"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$firstName)) {
      $contactNameErr = "Only letters and spaces allowed";
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

  if (empty($_POST["number"])) {
    $phoneErr = "Phone Number Required";
  } else {
      $phone = test_input($_POST["number"]);
      $length = strlen((string)$_POST["number"]);
      if ($length < 10){
      $phoneErr = "Please Enter Number with at least 10 digits";
      }
  }

  if (empty($_POST["state"])) {
    $stateErr = "Choosing a state is required";
  } else {
    $state = test_input($_POST["state"]);
  }

 if (empty($_POST["time"])) {
    
  } else {
    $time = test_input($_POST["time"]) ;
  }


  if (empty($_POST["contactOpt"])) {
    $contactOptErr = "Please choose one of the following options";
  } else {
    ;
  }

  if (empty($_POST["radioOpt"])) {
    $radioOptErr = "Please choose of the following options";
  } else {
    ;
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
    .error{
        color: #ff0000;
}
</style>
<div class="container">
    <div class="row-fluid">
        <div class="col-xs-12 text-center">
            <div class="jumbotron"  id="aboutJumbo3">
                <h2> Would you like to see your shop featured on our site? Simply answer a few questions and complete the following form, and we will have you up and running in no time. Thank you in advance for giving us your consideration and we look forward to welcoming you to the family!
                </h2><br><br>
                <form class="form-horizontal" role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="firstName">Your First Name:</label>
                        <div class="col-xs-4">
                            <input type="text" value="<?php echo $firstName;?>"class="form-control" id="firstName" name="firstName" onkeyup="this.value=this.value.replace(/[^\sa-zA-z]/, '')">
                        </div>
                        <span class="error col-xs-1">* <?php echo $firstNameErr;?></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="lastName">Your Last Name:</label>
                        <div class="col-xs-4">
                            <input type="text" value="<?php echo $lastName;?>"class="form-control" id="lastName" name="lastName" onkeyup="this.value=this.value.replace(/[^\sa-zA-z]/, '')">
                        </div>
                        <span class="error col-xs-1">* <?php echo $lastNameErr;?></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="shopName">Name of Business You Represent:</label>
                        <div class="col-xs-4">
                            <input type="text" value="<?php echo $shop;?>" class="form-control" name="shopName" id="shopName" onkeyup="this.value=this.value.replace(/[^\d\sa-zA-z']/, '')">
                        </div>
                        <span class="error col-xs-1">* <?php echo $shopErr;?></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="email">Your Email:</label>
                        <div class="col-xs-4">
                            <input type="email" value="<?php echo $email;?>" class="form-control" name="email" id="email"> 
                        </div>
                        <span class="error col-xs-1">* <?php echo $emailErr;?></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="number">Best Phone Number for You:<br>(xxx-xxx-xxxx)</label>
                        <div class="col-xs-2">
                            <input type="tel" maxlength="14" value="<?php echo $phone;?>" name="number" class="form-control" id="number" onkeyup="this.value=this.value.replace(/[^\d]+/, '')">
                        </div>
                        <span class="error col-xs-1">* <?php echo $phoneErr;?></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="time">Best Time to Contact You:<br>(Military Format Please)</label>
                        <div class="col-xs-2">
                            <input type="time" name-"time" value="<?php echo $time;?>" maxlength="5" value="00:00" class="form-control" id="time">
                        </div>
                    </div>
                    <br>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="states">Select Your State:</label>
                         <div class="col-xs-3">
                            <select class="form-control" name="state" id="states">
                                <?php if (isset($state)) echo "<option selected disabled>$state</option";?> 
                                <option>Washington D.C.</option>
                                <option>Alabama</option>
                                <option>Alaska</option>
                                <option>Arizona</option>
                                <option>Arkansas</option>
                                <option>California</option>
                                <option>Colorado</option>
                                <option>Connecticut</option>
                                <option>Delaware</option>
                                <option>Florida</option>
                                <option>Georgia</option>
                                <option>Hawaii</option>
                                <option>Idaho</option>
                                <option>Illinois</option>
                                <option>Indiana</option>
                                <option>Iowa</option>
                                <option>Kansas</option>
                                <option>Kentucky</option>
                                <option>Louisiana</option>
                                <option>Maine</option>
                                <option>Maryland</option>
                                <option>Massachusetts</option>
                                <option>Michigan</option>
                                <option>Minnesota</option>
                                <option>Mississippi</option>
                                <option>Missouri</option>
                                <option>Montana</option>
                                <option>Nebraska</option>
                                <option>Nevada</option>
                                <option>New Hampshire</option>
                                <option>New Jersey</option>
                                <option>New Mexico</option>
                                <option>New York</option>
                                <option>North Carolina</option>
                                <option>North Dakota</option>
                                <option>Ohio</option>
                                <option>Oklahoma</option>
                                <option>Oregon</option>
                                <option>Pennsylvania</option>
                                <option>Rhode Island</option>
                                <option>South Carolina</option>
                                <option>South Dakota</option>
                                <option>Tennessee</option>
                                <option>Texas</option>
                                <option>Utah</option>
                                <option>Vermont</option>
                                <option>Virginia</option>
                                <option>Washington</option>
                                <option>West Virginia</option>
                                <option>Wisconsin</option>
                                <option>Wyoming</option>
                            </select>
                        </div>
                        <span class="error col-xs-1">* <?php echo $stateErr;?></span>
                    </div>

                    <br><br>
                    <h3>Your preferred method of contact: <span class="error">* <?php echo $contactOptErr;?></span>
</h3> 
                    <div class="radio">
                        <label for="radioE">
                            <input type="radio" name="contactOpt" <?php if (isset($contactOpt) && $contactOpt=="Email") echo "checked";?> value="Email" >Email
                        </label>
                    </div><br>
                    <div class="radio">
                        <label for="radioT">
                            <input type="radio"  <?php if (isset($contactOpt) && $contactOpt=="Phone") echo "checked";?> name="contactOpt" value="Phone">Phone
                        </label>
                    </div><br>
                    <div class="radio">
                        <label for="radioB">
                            <input type="radio"  <?php if (isset($contactOpt) && $contactOpt=="Either or Both") echo "checked";?> name="contactOpt" value="Either or Both">Either or Both
                        </label>
                    </div><br>

                    <br>
                    <h3>Please choose the most accurate: <span class="error">* <?php echo $radioOptErr;?></span></h3>
                    <div class="container">
                        <div class="radio">
                            <label for="radio1">
                                <input type="radio"  <?php if (isset($radioOpt) && $radioOpt=="You are (a/the) business's owner.") echo "checked";?> name="radioOpt">You are (a/the) business's owner.
                            </label>
                        </div><br>
                        <div class="radio">
                            <label for="radio2">
                                <input type="radio" name="radioOpt" <?php if (isset($radioOpt) && $radioOpt=="You make the business's financial decisions.") echo "checked";?>>You make the business's financial decisions.
                            </label>
                        </div><br>
                        <div class="radio">
                            <label for="radio3">
                                <input type="radio" name="radioOpt" <?php if (isset($radioOpt) && $radioOpt=="You are (a/the) business's owner and make the business's financial decisions.") echo "checked";?> >You are (a/the) business's owner and make the business's financial decisions.
                            </label>
                        </div><br>
                        <div class="radio">
                            <label for="radio4">
                                <input type="radio" name="radioOpt"  <?php if (isset($radioOpt) && $radioOpt=="You are not (a/the) business's owner and do not make the business's financial decisions.") echo "checked";?> >You are not (a/the) business's owner and do not make the business's financial decisions.
                            </label>
                        </div><br>
                    </div>
                    <input type="submit" value="Submit">
                </form>
            </div>
        </div>
    </div>
</div></body>
</html>

