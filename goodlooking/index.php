<?php
            // Left side search PHP
                    // define variables and set to empty values
                    $choiceERR = "";
                    $stateChoice = "";
                    $cityChoice = "";
                    $zip = ""; $city = ""; $stateShort = ""; $state = ""; $country = "";
                    $zipERR = $baseURL = $newURL = "";

                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        if ((empty($_POST["stateChoice"])) && (empty($_POST["zip"]))) {
                            $choiceERR = "Please choose a state first";
                            $zipERR = "Please enter a zipcode first.";
                            }
                        else if((isset($_POST["stateChoice"])) && (empty($_POST["zip"]))) {
                            $url2 = urlBuilda();
                            header("Location: http://$url2");
                            exit();
                            }
                        else if ((isset($_POST["zip"])) && (empty($_POST["stateChoice"]))){
                            $length = strlen((string)$_POST["zip"]);
                            if ($length != 5) {
                                $zipERR = "Please enter a 5 digit zipcode.";
                                }
                            else{
                                $zip = test_input($_POST["zip"]);
                                $city = test_input($_POST["city"]);
                                $stateShort = test_input($_POST["stateShort"]);
                                $state = test_input($_POST["state"]);
                                $country = test_input($_POST["country"]);
                                $url2 = urlBuildb();
                                header("Location: http://$url2");
                                exit();
                                }
                            }
                        else{
                            $choiceERR = "Please only search by zip or city/state.";
                            $zipERR = "Please only search by zip or city/state.";
                            }
                    }

                    function urlBuilda(){
                        $state = $_POST["stateChoice"];
                        $city = $_POST["cityChoice"];
                        $newURL = "localhost/bSearch/{$state}/{$city}/";
                        return $newURL;
                    }

                    function urlBuildb(){
                        $state = $_POST["stateShort"];
                        $city = $_POST["city"];
                        $newURL = "localhost/bSearch/{$state}/{$city}/";
                        return $newURL;
                    }



                    function test_input($data) {
                        $data = trim($data);
                        $data = stripslashes($data);
                        $data = htmlspecialchars($data);
                        return $data;
                    }
?>

<?php
                    //Right Side Search
                    // define variables and set to empty values
                    $choiceERR = "";
                    $stateChoice = "";
                    $cityChoice = "";
                    $zip = ""; $city = ""; $stateShort = ""; $state = ""; $country = "";
                    $zipERR = $baseURL = $newURL = "";

                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        if ((empty($_POST["stateChoice2"])) && (empty($_POST["zipW"]))) {
                            $choiceERR = "Please choose a state first";
                            $zipERR = "Please enter a zipcode first.";
                            }
                        else if((isset($_POST["stateChoice2"])) && (empty($_POST["zipW"]))) {
                            $url2 = urlBuildC();
                            header("Location: http://$url2");
                            exit();
                            }
                        else if ((isset($_POST["zipW"])) && (empty($_POST["stateChoice2"]))){
                            $length = strlen((string)$_POST["zipW"]);
                            if ($length != 5) {
                                $zipERR = "Please enter a 5 digit zipcode.";
                                }
                            else{
                                $zip = test_input2($_POST["zipW"]);
                                $city = test_input2($_POST["cityW"]);
                                $stateShort = test_input2($_POST["stateShortW"]);
                                $state = test_input2($_POST["stateW"]);
                                $country = test_input2($_POST["countryW"]);
                                $url2 = urlBuildD();
                                header("Location: http://$url2");
                                exit();
                                }
                            }
                        else{
                            $choiceERR = "Please only search by zip or city/state.";
                            $zipERR = "Please only search by zip or city/state.";
                            }
                    }

                    function urlBuildC(){
                        $state = $_POST["stateChoice2"];
                        $city = $_POST["cityChoice2"];
                        $newURL = "localhost/wSearch/{$state}/{$city}/";
                        return $newURL;
                    }

                    function urlBuildD(){
                        $state = $_POST["stateShortW"];
                        $city = $_POST["cityW"];
                        $newURL = "localhost/wSearch/{$state}/{$city}/";
                        return $newURL;
                    }



                    function test_input2($data) {
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

   <!-- CUSTOM INCLUDE FOR CITY LISTING, COURTSEY https://css-tricks.com-->
        <script>
        $(function() {
            $("#stateChoice").change(function() {
                $("#cityChoice").load("cityLists/" + $(this).val() + ".txt");
            });
        });
        </script>
        <script>
        $(function() {
            $("#stateChoice2").change(function() {
                $("#cityChoice2").load("cityLists/" + $(this).val() + ".txt");
            });
        });
        </script>

    
<!--INCLUDE FOR ZIP CODE lookup, https://github.com/daspecster/ziptastic-jquery-plugin/blob/master/LICENSE-->
        <script>
            (function( $ ) {
	        var requests = {};
	        var zipValid = {
		        us: /[0-9]{5}(-[0-9]{4})?/
	        };

	        $.ziptastic = function(country, zip, callback){
		        // If only zip and callback are given default to US
		        if (arguments.length == 2 && typeof arguments[1] == 'function') {
			        callback = arguments[1];
			        zip = arguments[0];
			        country = 'US';
		        }

		        country = country.toUpperCase();
		        // Only make unique requests
		        if(!requests[country]) {
			        requests[country] = {};
		        }
		        if(!requests[country][zip]) {
			        requests[country][zip] = $.getJSON('https://zip.getziptastic.com/v2/' + country + '/' + zip);
		        }

		        // Bind to the finished request
		        requests[country][zip].done(function(data) {
			        if (typeof callback == 'function') {
				        callback(data.country, data.state, data.state_short, data.city, zip);
			        }
		        });

		        // Allow for binding to the deferred object
		        return requests[country][zip];
	        };

	        $.fn.ziptastic = function( options ) {
		        return this.each(function() {
			        var ele = $(this);

			        ele.on('keyup', function() {
				        var zip = ele.val();

				        // TODO Non-US zip codes?
				        if(zipValid.us.test(zip)) {
					        $.ziptastic(zip, function(country, state, state_short, city) {
						        // Trigger the updated information
						        ele.trigger('zipChange', [country, state, state_short, city, zip]);
					        });
				        }
			        });
		        });
	        };
        })( jQuery );

            </script>

            <script type="text/javascript">
            (function($) {
                        $(function() {
                            var duration = 0;
                            var elements = {
                                country: $('#country'),
                                state: $('#state'),
                                state_short: $('#stateShort'),
                                city: $('#city'),
                                zip: $('#zip')
                            }
                            // Initially hide the city/state/zip
                            elements.country.parent().hide();
                            elements.state.parent().hide();
                            elements.state_short.parent().hide();
                            elements.city.parent().hide();
                            // Initialize the ziptastic and bind to the change of zip code
                            elements.zip.ziptastic()
                                .on('zipChange', function(evt, country, state, state_short, city, zip) {
                                    // Country
                                    //      elements.country.val(country).parent().show(duration);
                                    // State
                                    elements.state_short.val(state_short).parent().show(duration);
                                    elements.state.val(state).parent().show(duration);
                                    // City
                                    elements.city.val(city).parent().show(duration);
                                });
                        });
                    }(jQuery));

            </script>

            <script type="text/javascript">
            (function($) {
                        $(function() {
                            var duration = 500;
                            var elements = {
                                country: $('#countryW'),
                                state: $('#stateW'),
                                state_short: $('#stateShortW'),
                                city: $('#cityW'),
                                zip: $('#zipW')
                            }
                            // Initially hide the city/state/zip
                            elements.country.parent().hide();
                            elements.state.parent().hide();
                            elements.state_short.parent().hide();
                            elements.city.parent().hide();
                            // Initialize the ziptastic and bind to the change of zip code
                            elements.zip.ziptastic()
                                .on('zipChange', function(evt, country, state, state_short, city, zip) {
                                    // Country
                                    //      elements.country.val(country).parent().show(duration);
                                    // State
                                    elements.state_short.val(state_short).parent().show(duration);
                                    elements.state.val(state).parent().show(duration);
                                    // City
                                    elements.city.val(city).parent().show(duration);
                                });
                        });
                    }(jQuery));

                </script>
 
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
        <div class="container" id="welcome">
        <h2>
          Welcome to Good Looking Out, a new innovative way to find the care for your hair that you deserve. Our goal is to make you look as good as you feel and feel good as you look. We will be listing a broad range of barbershops and hair salons, as well as tools such as pictures and a rating system to find the seat that you need to be in.
        </h2> 
        </div>
        <br>
        <br>
        <div class="container" id="menu2">
            <div class="row-fluid">
                <div class="col-xs-6 text-center">
                    <div id="mSearch" div class="jumbotron">
                        <div id ="mSearchContent" class="container">
                        <h2>Find A </h2><h2>Barbershop</h2>
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <select id="stateChoice" name="stateChoice">
                                <option selected value="" disabled>Select a State</option>
                                <option value = "DC">District of Columbia</option>
                                <option value = "AL">Alabama</option>
                                <option value = "AK">Alaska</option>
                                <option value = "AZ">Arizona</option>
                                <option value = "AR">Arkansas</option>
                                <option value = "CA">California</option>
                                <option value = "CO">Colorado</option>
                                <option value = "CT">Connecticut</option>
                                <option value = "DE">Delaware</option>
                                <option value = "FL">Florida</option>
                                <option value = "GA">Georgia</option>
                                <option value = "HA">Hawaii</option>
                                <option value = "ID">Idaho</option>
                                <option value = "IL">Illinois</option>
                                <option value = "IN">Indiana</option>
                                <option value = "IA">Iowa</option>
                                <option value = "KS">Kansas</option>
                                <option value = "KY">Kentucky</option>
                                <option value = "LA">Louisiana</option>
                                <option value = "ME">Maine</option>
                                <option value = "MD">Maryland</option>
                                <option value = "MA">Massachusetts</option>
                                <option value = "MI">Michigan</option>
                                <option value = "MN">Minnesota</option>
                                <option value = "MS">Mississippi</option>
                                <option value = "MO">Missouri</option>
                                <option value = "MT">Montana</option>
                                <option value = "NE">Nebraska</option>
                                <option value = "NV">Nevada</option>
                                <option value = "NH">New Hampshire</option>
                                <option value = "NJ">New Jersey</option>
                                <option value = "NM">New Mexico</option>
                                <option value = "NY">New York</option>
                                <option value = "NC">North Carolina</option>
                                <option value = "ND">North Dakota</option>
                                <option value = "OH">Ohio</option>
                                <option value = "OK">Oklahoma</option>
                                <option value = "OR">Oregon</option>
                                <option value = "PA">Pennsylvania</option>
                                <option value = "RI">Rhode Island</option>
                                <option value = "SC">South Carolina</option>
                                <option value = "SD">South Dakota</option>
                                <option value = "TN">Tennessee</option>
                                <option value = "TX">Texas</option>
                                <option value = "UT">Utah</option>
                                <option value = "VT">Vermont</option>
                                <option value = "VA">Virgina</option>
                                <option value = "WA">Washington</option>
                                <option value = "WV">West Virgina</option>
                                <option value = "WI">Wisconsin</option>
                                <option value = "WY">Wyoming</option>
                            </select>
                            <span id="mError" class="error">* <?php echo $choiceERR;?></span>
                            <br>

                            <select id="cityChoice" name= "cityChoice">
                                <option>Choose State Above</option>
                            </select>
                            <br>

                            <input type="submit" id="mStateSubmit" value="Search" />
                        </form>

                        <h1>-OR-</h1>

                        <h2>Please Enter A Zip Code</h2><h2>You Want To Search</h2>



                        <form id="zipform" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                            <label for="zip">
    			                Zip:
                                <input type="text" id="zip" name="zip" maxlength="5" onkeyup="this.value=this.value.replace(/[^\d]+/, '')"/>
                                <span id="mError" class="error">* <?php echo $zipERR;?></span>
    		                </label>

                            <label for="city">
                                City:
                                <input type="text" id="city" name="city"/>
                            </label>

                            <label for="state">
                                State:
                                <input type="text" id="state" name="state"/>
                            </label>

                            <label for="stateShort">
                                State Short:
                                <input type="text" id="stateShort" name="stateShort"/>
                            </label>

                            <label for="country">
                                Country:
                                <input type="text" id="country" name="country"/>
                            </label>
                            <br>

                            <input type="submit" id="mZipSubmit" value="Search" />
                        </form>

                        </div>
                    </div>
                </div>

<!-- /////////////////////////////////////// RIGHT SIDE BELOW ///////////////////////////////////////// -->

<div class="col-xs-6 text-center">
                <div id="wSearch" div class="jumbotron">
                    
<div id ="wSearchContent" class="container">
    <h2>Find A </h2><h2>Salon</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <select id="stateChoice2" name="stateChoice2">
                <option selected value="" disabled>Select a State</option>
                <option value = "DC">District of Columbia</option>
                <option value = "AL">Alabama</option>
                <option value = "AK">Alaska</option>
                <option value = "AZ">Arizona</option>
                <option value = "AR">Arkansas</option>
                <option value = "CA">California</option>
                <option value = "CO">Colorado</option>
                <option value = "CT">Connecticut</option>
                <option value = "DE">Delaware</option>
                <option value = "FL">Florida</option>
                <option value = "GA">Georgia</option>
                <option value = "HA">Hawaii</option>
                <option value = "ID">Idaho</option>
                <option value = "IL">Illinois</option>
                <option value = "IN">Indiana</option>
                <option value = "IA">Iowa</option>
                <option value = "KS">Kansas</option>
                <option value = "KY">Kentucky</option>
                <option value = "LA">Louisiana</option>
                <option value = "ME">Maine</option>
                <option value = "MD">Maryland</option>
                <option value = "MA">Massachusetts</option>
                <option value = "MI">Michigan</option>
                <option value = "MN">Minnesota</option>
                <option value = "MS">Mississippi</option>
                <option value = "MO">Missouri</option>
                <option value = "MT">Montana</option>
                <option value = "NE">Nebraska</option>
                <option value = "NV">Nevada</option>
                <option value = "NH">New Hampshire</option>
                <option value = "NJ">New Jersey</option>
                <option value = "NM">New Mexico</option>
                <option value = "NY">New York</option>
                <option value = "NC">North Carolina</option>
                <option value = "ND">North Dakota</option>
                <option value = "OH">Ohio</option>
                <option value = "OK">Oklahoma</option>
                <option value = "OR">Oregon</option>
                <option value = "PA">Pennsylvania</option>
                <option value = "RI">Rhode Island</option>
                <option value = "SC">South Carolina</option>
                <option value = "SD">South Dakota</option>
                <option value = "TN">Tennessee</option>
                <option value = "TX">Texas</option>
                <option value = "UT">Utah</option>
                <option value = "VT">Vermont</option>
                <option value = "VA">Virgina</option>
                <option value = "WA">Washingtn</option>
                <option value = "WV">West Virgina</option>
                <option value = "WI">Wisconsin</option>
                <option value = "WY">Wyoming</option>
            </select>
            <span id="wError" class="error">* <?php echo $choiceERR;?></span>
            <br>

            <select id="cityChoice2" name="cityChoice2">
                <option>Choose State Above</option>
            </select>
            <br>

            <input type="submit" id="wStateSubmit" value="Search" />
        </form>

        <h1>-OR-</h1>

        <h2>Please Enter A Zip Code</h2><h2>You Want To Search</h2>

        <form id="zipform2"  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label for="zipW">
    			Zip:
                <input type="text" id="zipW" name="zipW" maxlength="5" onkeyup="this.value=this.value.replace(/[^\d]+/, '')"/>
                <span id="wError" class="error">* <?php echo $zipERR;?></span>
    		</label>

            <label for="cityW">
                City:
                <input type="text" id="cityW" name="cityW" />
            </label>

            <label for="stateW">
                State:
                <input type="text" id="stateW" name="stateW" />
            </label>

            <label for="stateShortW">
                State Short:
                <input type="text" id="stateShortW" name="stateShortW" />
            </label>

            <label for="countryW">
                Country:
                <input type="text" id="countryW" name="countryW"/>
            </label>
            <br>
            <input type="submit" id="wZipSubmit" value="Search" />
        </form>

</div>

</body>
</html>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

