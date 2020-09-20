<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />

    <link rel="stylesheet" href="../css/style.css" />

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />

    <link rel="icon" href="../imgs/8th.png" type="image/icon type" />
    <title>Change Password</title>
</head>

<body>
    <div class="container">
        <header class="blog-header py-3">
            <h1 class="headingfont" align="center">
                <img class="mr-1 mb-2" src="../imgs/8th.png" alt="college logo" width="45" height="45" />MyCollege
            </h1>
        </header>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="profile.php">My Profile</a>
                </li>
            </ul>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="profileDetail.php">View details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="updatePersonal.php">Update details</a>
                    </li>
                </ul>
                <ul class="navbar-nav mr-1">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../imgs/profile.png" width="18" height="18" />
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="../Activity/Activity.php">Activity</a>
                            <a class="dropdown-item" href="../Activity/Sembreak.php">Semester Break</a>
                            <a class="dropdown-item" href="../Activity/Report.php">Report an Issue</a>
                            <a class="dropdown-item" href="../RegisterLogin/Logout.php">Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <main class="jumbotron mt-2">
            <h1>Change Password</h1>
            <?php
            //start a session and include database
            session_start();
            include_once '../database.php';

            //check if user is logged in or not ($_SESSION has value)
            if (isset($_SESSION['logged_in']) && $_SESSION['user_id'] && $_SESSION['user_email'] && $_SESSION['logged_in'] == true) {
                //set user_id in session to $id
                $id = $_SESSION['user_id'];

            ?>
            <?php
                $action=isset($_GET['action']) ? $_GET['action'] : "";
                //if user successfully updated the form
                if($action == "passwordChanged"){
                    echo "<div class='alert alert-success alert-dismissible'>
            <h4><i class='icon fa fa-check'></i> Password is successfully changed! <br><a href='profile.php'>Back to User Profile</a> now!
            </div>";
            //if user failed to updated the form
                }else if($action == "invalidPassword"){
                    echo "<div class='alert alert-danger alert-dismissible'>
            <h4><i class='icon fa fa-check'></i> You entered a wrong password! <br>Please try again.
            </div>";
                }
            ?>
                <!-- create a form --> 
                <form method="post" action="processPassword.php" onsubmit="return validateForms()" id="form" class="jumbotron mt-3">
                    <div class="form-group row">
                        <label for="password" class="col-md-3 col-form-label"><b>*Current Password </b></label>
                        <div class="col-md-3">
                            <input id="password" name="password" class="form-control" type="password" placeholder="PASSWORD" required>
                            <input type="checkbox" onclick="myFunction()"> Show Password
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="newpassword" class="col-md-3 col-form-label"><b>*New Password </b></label>
                        <div class="col-md-3">
                            <input onkeyup="validatePassword()" id="newpassword" name="newpassword" class="form-control" type="password" placeholder="NEW PASSWORD" required>
                            <small id="suitable" class="form-text text-muted" style="background-color: null;">#Include lowercase letters</small>
                            <small id="suitable1" class="form-text text-muted" style="background-color: null;">#Include uppercase letter</small>
                            <small id="suitable2" class="form-text text-muted" style="background-color: null;">#Include digits</small>
                            <small id="suitable3" class="form-text text-muted" style="background-color: null;">#Password length greater or equal to 8.</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="repeatpassword" class="col-md-3 col-form-label"><b>*Repeat Password </b></label>
                        <div class="col-md-3">
                            <input onkeyup="samePassword()" id="repeatpassword" name="repeatpassword" class="form-control" type="password" placeholder="REPEAT PASSWORD" required>
                            <small id="checkSame" class="form-text text-muted" >Repeat the new password again.</small>
                            <small id="result" class="form-text text-muted"></small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-1">
                            <!-- Click this button to confirm updating the form and move to validation -->
                            <button type="submit" class="btn btn-primary" id="confirm">Confirm</button>
                        </div>
                        <div class="col-md-2">
                            <!-- Click this button to cancel from changing password -->
                            <button type="button" class="btn btn-primary" id="cancel">Cancel</button>
                        </div>
                    </div>
                <?php
            } else { ?>
                    <div class="alert alert-info" role="alert">
                        <!-- display error message if user is not logged in ($_SESSION is null)-->
                        <h4>Sorry, only authenticated user can access this page.</h4>
                        <p><a href="../RegisterLogin/RegisterLogin.php">Log in</a> now.</p>
                    </div><?php
                        }
                            ?>
        </main>

        <footer class="container text-center font-italic py-2">
            Copyright © 2020 - XXX Residential College.
        </footer>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script type="text/javascript">
        //user can viewed the password by clicking the "Show Password" box
        function myFunction() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
        //all requirements for a new password (Nedd to fulfilled all)
        function validatePassword(){
        var lowercase = document.getElementById("newpassword");
        var suitableLow = document.getElementById("suitable");
        var uppercase = document.getElementById("newpassword");
        var suitableUp = document.getElementById("suitable1");
        var digit = document.getElementById("newpassword");
        var suitableDigit = document.getElementById("suitable2");
        var passwordLength = document.getElementById("newpassword");
        var suitableLength = document.getElementById("suitable3");
        suitableLow.innerHTML = "#Include lowercase letters";
        suitableLow.style.backgroundColor = null;
        suitableUp.innerHTML = "#Include uppercase letter";
        suitableUp.style.backgroundColor = null;
        suitableDigit.innerHTML = "#Include digits";
        suitableDigit.style.backgroundColor = null;
        suitableLength.innerHTML = "#Password length greater or equal to 8.";
        suitableLength.style.backgroundColor = null;
        for(x=0;x<lowercase.value.length;x++){
            if(lowercase.value.charAt(x) >= 'a' && lowercase.value.charAt(x) <= 'z'){
                suitableLow.innerHTML = "<b>&#10004;Included lowercase letter<b>";
                suitableLow.style.backgroundColor = "Chartreuse";
                break;
            } else {
                suitableLow.innerHTML = "Please include a lowercase letter";
                suitableLow.style.backgroundColor = "lightpink";
            }
        }
        for(x=0;x<uppercase.value.length;x++){
            if(uppercase.value.charAt(x) >= 'A' && uppercase.value.charAt(x) <= 'Z'){
                suitableUp.innerHTML = "<b>&#10004;Included uppercase letter<b>";
                suitableUp.style.backgroundColor = "Chartreuse";
                break;
            } else {
                suitableUp.innerHTML = "Please include an uppercase letter";
                suitableUp.style.backgroundColor = "lightpink";
            }
        }
        for(x=0;x<digit.value.length;x++){
            if(digit.value.charAt(x) >= '0' && digit.value.charAt(x) <= '9'){
                suitableDigit.innerHTML = "<b>&#10004;Included digit<b>";
                suitableDigit.style.backgroundColor = "Chartreuse";
                break;
            } else {
                suitableDigit.innerHTML = "Please include a digit";
                suitableDigit.style.backgroundColor = "lightpink";
            }
        }
        if(passwordLength.value.length >= 8){
                suitableLength.innerHTML = "<b>&#10004;Password length suitable<b>";
                suitableLength.style.backgroundColor = "Chartreuse";
        } else if (passwordLength.value.length > 0) {
            suitableLength.innerHTML = "Minimum password length is 8";
            suitableLength.style.backgroundColor = "lightpink";
        }
        }
        //check if user repeat the same new password
        function samePassword(){
            var npass = document.getElementById("newpassword");
            var rpass = document.getElementById("repeatpassword");
            var y = document.getElementById("checkSame");
            y.innerHTML = '';
            var x = document.getElementById("result");
            
            if(npass.value != rpass.value){
                x.innerHTML = "The password does not match.";
                x.style.backgroundColor = "lightpink";
            }else{
                x.innerHTML = "<b>&#10004;The password is matched.<b>";
                x.style.backgroundColor = "Chartreuse";
            }
        }
        //navigate user back to profile.php if user does not want to change password
        document.getElementById("cancel").addEventListener("click", function() {
            window.location.href = "profile.php";
        })
        //validate the form
        function validateForms() {
            var x = document.getElementById("result");
            var suitableLow = document.getElementById("suitable");
            var suitableUp = document.getElementById("suitable1");
            var suitableDigit = document.getElementById("suitable2");
            var suitableLength = document.getElementById("suitable3");

            if(suitableLow.style.backgroundColor == "lightpink"){
                alert("Your new password must match the criteria given.");
                return false;
            }
            if(suitableUp.style.backgroundColor == "lightpink"){
                alert("Your new password must match the criteria given.");
                return false;
            }
            if(suitableDigit.style.backgroundColor == "lightpink"){
                alert("Your new password must match the criteria given.");
                return false;
            }
            if(suitableLength.style.backgroundColor == "lightpink"){
                alert("Your new password must match the criteria given.");
                return false;
            }
            if(x.style.backgroundColor == "lightpink"){
                alert("Please repeat your new password correctly.");
                return false;
            }
            var confirm = window.confirm("Confirm to update information of contact?");
            if (!confirm) {
                return false;
            }
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>