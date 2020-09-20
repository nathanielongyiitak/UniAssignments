<?php
    //start a session and include database
    session_start();
    include_once '../database.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">

    <link rel="stylesheet" href="../css/style.css">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="icon" href="../imgs/8th.png" type="image/icon type">
    <title>Update Contact Information</title>
    <style>
        /* Display drop-down when hover  */
        .dropright:hover 
        .dropdown-menu
        {display: block;}
        .dropdown:hover
        .dropdown-menu
        {display: block;}

        
    </style>
</head>

<body>
    <div class="container">

        <header class="blog-header py-3">
            <h1 class="headingfont" align="center"><img class="mr-1 mb-2 " src="../imgs/8th.png" alt="college logo" width="45" height="45">MyCollege</h1>
        </header>


        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <ul class="navbar-nav mr-auto ">
                <li class="nav-item">
                    <a class="nav-link" href="profile.php">My Profile</a>
                </li>
            </ul>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="collapsibleNavbar">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">View Details
                    </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                            <a class="nav-link" href="profileDetail.php">Personal</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="academicDetail.php">Academic</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="contactDetail.php">Contact</a>
                            </li>
                        </ul>
                        </div>
                    </li>
                    <li class="nav-item active dropright">
                    <a  class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Update Details
                    <span class="sr-only">(current)</span>
                    </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="updatePersonal.php">Personal</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="updateAcademic.php">Academic</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link bg-light" href="updateContact.php">Contact<span class="sr-only">(current)</span></a>
                            </li>
                        </ul>
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav mr-1">
                    <li class="nav-item dropdown">

                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../imgs/profile.png" width="18" height="18">
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="../Activity/Activity.php">Activity</a>
                            <a class="dropdown-item" href="../Activity/Sembreak.php">Accommodation Application</a>
                            <a class="dropdown-item" href="../Activity/Report.php">Report an Issue</a>
                            <a class="dropdown-item" href="../RegisterLogin/Logout.php">Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <main class="jumbotron mt-2">
            <h2>Update Contact Information</h2>
            <?php

            //check if user is logged in or not ($_SESSION has value)
            if (isset($_SESSION['logged_in']) && $_SESSION['user_id'] && $_SESSION['user_email'] && $_SESSION['logged_in'] == true) {
                //set user_id in session to $id and user_email to $user_email
                $user_email = $_SESSION['user_email'];
                $id = $_SESSION['user_id'];

                //retrieve data from database
                $sql = "SELECT * FROM contacttable WHERE id='$id'";
                $result = $pdo->prepare($sql);
                $result -> execute();

                //assign variable for every data
                while($res = $result->fetch(PDO::FETCH_ASSOC)) {
                    $Address = $res['Address'];
                    $Postcode = $res['Postcode'];
                    $City = $res['City'];
                    $State = $res['State'];
                    $Phone = $res['Phone'];
                }

            ?>
             <?php
                $action=isset($_GET['action']) ? $_GET['action'] : "";
                //if user successfully updated the form
                if($action == "updateContactSuccessful"){
                    echo "<div class='alert alert-success alert-dismissible'>
                    <h4><i class='icon fa fa-check'></i> Contact information is updated successfully! <br><a href='contactDetail.php'>View updated information</a> now!
                    </div>";
                }
            ?>
                <!-- create a form --> 
                <form method="post" action="processContact.php" onsubmit="return validateForms()" id="form" class="jumbotron mt-3">
                    <div class="form-group row">
                        <label for="address" class="col-md-2 col-form-label">Address</label>
                        <div class="col-md-5">
                            <input id="address" name="Address" class="form-control" type="text" <?php if(isEmpty($Address)==false){ echo "value= '$Address'";} ?> placeholder="ADDRESS ">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="postcode" class="col-md-2 col-form-label">Postcode</label>
                        <div class="col-md-2">
                            <input id="postcode" name="Postcode" class="form-control" type="number" min="10000" max="100000" <?php if(isEmpty($Postcode)==false){ echo "value= '$Postcode'";} ?> placeholder="POSTCODE">
                            <small id="postcodeHelp" class="form-text text-muted">With 5 digits only.</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="city" class="col-md-2 col-form-label">City</label>
                        <div class="col-md-3">
                            <input id="city" name="City" class="form-control" type="text" <?php if(isEmpty($City)==false){ echo "value= '$City'";} ?> placeholder="CITY" >
                            <small id="cityHelp" class="form-text text-muted">Eg. KUANTAN</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="state" class="col-md-2 col-form-label">State</label>
                        <div class="col-md-3">
                            <select id="faculty" name="State" class="form-control">
                                <option selected disabled value="">Choose...</option>
                                <option value="Johor">Johor</option>
                                <option value="Kedah">Kedah</option>
                                <option value="Kelantan">Kelantan</option>
                                <option value="Melaka">Melaka</option>
                                <option value="Negeri Sembilan">Negeri Sembilan</option>
                                <option value="Pahang">Pahang</option>
                                <option value="Pulau Pinang">Pulau Pinang</option>
                                <option value="Perak">Perak</option>
                                <option value="Perlis">Perlis</option>
                                <option value="Sabah">Sabah</option>
                                <option value="Sarawak">Sarawak</option>
                                <option value="Selangor">Selangor</option>
                                <option value="Terengganu">Terengganu</option>
                                <option value="Wilayah Persekutuan (Kuala Lumpur)">Wilayah Persekutuan (Kuala Lumpur)</option>
                                <option value="Wilayah Persekutuan (Labuan)">Wilayah Persekutuan (Labuan)</option>
                                <option value="Wilayah Persekutuan (Putrajaya)">Wilayah Persekutuan (Putrajaya)</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phoneNo" class="col-md-2 col-form-label">Telephone No.</label>
                        <div class="col-md-3">
                            <input id="phoneNo" name="Phone" class="form-control" type="number" placeholder="PHONE NUMBER" min="100000000" max="99999999999" <?php if(isEmpty($Phone)==false){ echo "value= '$Phone'";} ?>>
                            <small id="phoneNoHelp" class="form-text text-muted">Numbers with 10 or 11 digits only without "-"</small>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-md-2 col-form-label">Email</label>
                        <div class="col-md-3">
                            <input id="email" name="Email" class="form-control" type="text" pattern=".{9,9}" placeholder="STUDENT EMAIL" value="<?php echo $user_email; ?>" readonly>
                            <small id="emailHelp" class="form-text text-muted">Siswamail id cannot be changed.</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-1">
                            <!-- Click this button to confirm updating the form and move to validation -->
                            <button type="submit" class="btn btn-primary" id="updateContact">
                                Update
                            </button>
                        </div>
                        <div class="col-md-2">
                            <!-- Click this button to skip updating and finish updating -->
                            <button type="button" class="btn btn-primary" id="skipContact">Finish</button>
                        </div>
                    </div>
                    <p>#Form marked with asterisk (*) and bolded is required field. <br>
                        #Update all information given or skip to the next section.</p>
                </form>
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
        //function when user clicked the button
        document.getElementById("skipContact").addEventListener("click", function() {
            var confirm = window.confirm("Finish updating?");
            if (confirm) {
                alert("All information to be update is updated successfully.")
                window.location.href = "profile.php";
            } else {
                return false;
            }
        })
        //all string input is made to uppercase
        document.getElementById("form").addEventListener("change", function() {
            var address1 = document.getElementById("address1");
            var address2 = document.getElementById("address2");
            var address3 = document.getElementById("address3");
            var city = document.getElementById("city");
            address1.value = address1.value.toUpperCase();
            address2.value = address2.value.toUpperCase();
            address3.value = address3.value.toUpperCase();
            city.value = city.value.toUpperCase();
        })
        //validation of form
        function validateForms() {
            var confirm = window.confirm("Confirm to update information of contact?");

            if (!confirm) {
                return false;
            }
        }
        <?php
        //check if there is data stored in variable
        function isEmpty($variable){
            if($variable == ""){
                return true;
            }
            else{
                return false;
            }
        }
        ?>
    </script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>

</body>

</html>
