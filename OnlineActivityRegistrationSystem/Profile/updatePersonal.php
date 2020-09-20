<?php
    //start a session and include database
    session_start();
    include_once '../database.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />

    <link rel="stylesheet" href="../css/style.css" />

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />

    <link rel="icon" href="../imgs/8th.png" type="image/icon type" />
    <title>Update Personal Information</title>
    <style>
        /* Display drop-down when hover  */
        .dropright:hover 
        .dropdown-menu
        {display: block;}

        .dropdown:hover
        .dropdown-menu
        {display: block;}

        
        .col-md-4 {
            max-width: 200px;
            max-height: 200px;
            border: 1px solid Gray;
            object-fit: cover;

            /* Default text */
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: black;
        }

        .image-preview__image {
            display: none;
            width: 100%;
        }
    </style>
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
                            <li class="nav-item active">
                                <a class="nav-link bg-light" href="updatePersonal.php">Personal<span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="updateAcademic.php">Academic</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " href="updateContact.php">Contact</a>
                            </li>
                        </ul>
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav mr-1">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../imgs/profile.png" width="18" height="18" />
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

            <h2>Update Personal Information</h2>
            <?php

            //check if user is logged in or not ($_SESSION has value)
            if (isset($_SESSION['logged_in']) && $_SESSION['user_id'] && $_SESSION['user_email'] && $_SESSION['logged_in'] == true) {
                //set user_id in session to $id
                $id = $_SESSION['user_id'];

                //retrieve data from database
                $sql = "SELECT * FROM personaltable WHERE id='$id'";
                $result = $pdo->prepare($sql);
                $result -> execute();

                //assign variable for every data
                while ($res = $result->fetch(PDO::FETCH_ASSOC)) {
                    $ID = $res['ID'];
                    $NewMatrics = $res['NewMatrics'];
                    $IC = $res['IC'];
                    $Birthday = $res['Birthday'];
                }

                //retrieve data from database
                $sql1 = "SELECT Name FROM user WHERE id='$id'";
                $result1 = $pdo->prepare($sql1);
                $result1 -> execute();

                //assign variable for every data
                while ($res1 = $result1->fetch(PDO::FETCH_ASSOC)) {
                    $Name = $res1['Name'];
                }
            ?>
                <?php
                $action=isset($_GET['action']) ? $_GET['action'] : "";
                //if user successfully updated the form
                if($action == "updatePersonalSuccessful"){
                    echo "<div class='alert alert-success alert-dismissible'>
                    <h4><i class='icon fa fa-check'></i> Personal information is updated successfully! <br><a href='profileDetail.php'>View updated information</a> now!
                    </div>";
                }
            ?>
                <!-- create a form (set enctype="multipart/form-data" to prevent data being encrypted)--> 
                <form method="post" action="processPersonal.php" id="form" onsubmit="return validateForms()" class="jumbotron mt-3" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label for="picture" class="col-md-2 col-form-label"><b>*Profile Picture</b></label>
                        <div class="col-md-3">
                            <input style="background-color:red" type="file" class="form-control-file" id="picture" name="ProfilePicture" accept="image/jpeg,image/gif,image/png,application/pdf" require>
                            <small id="pictureHelp" class="form-text text-muted">Insert only format <b>.jpg .jpeg .png .gif .pdf</b>
                                with <b>size not exceeding 2MB</b></small>
                        </div>
                        <div class="col-md-2">
                            <button type="button" id="validatePicture" class="btn btn-outline-primary">Validate Picture</button>
                        </div>
                        <div class="col-md-4" id="imagePreview">
                            <img src="" alt="Image Preview" class="image-preview__image">
                            <span class="image-preview__default-text">Image Preview</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Name" class="col-md-2 col-form-label"><b>*Name</b></label>
                        <div class="col-md-5">
                            <input id="name" name="Name" class="form-control" type="text" <?php if(isEmpty($Name)==false){ echo "value= '$Name'";} ?> required placeholder="FULL NAME" />
                            <small id="nameHelp" class="form-text text-muted">Enter your full name without any symbol or special
                                characters.</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="oldMatrics" class="col-md-2 col-form-label">Old Matrics No.</label>
                        <div class="col-md-2">
                            <input id="oldMatrics" name="OldMatrics" class="form-control" type="text" pattern=".{9,9}" value="<?php echo $id; ?>" readonly />
                            <small id="oldMatricsHelp" class="form-text text-muted">Fixed user id. <br>Not changeable.</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="newMatrics" class="col-md-2 col-form-label"><b>New Matrics No.</b></label>
                        <div class="col-md-2">
                            <input id="newMatrics" name="NewMatrics" class="form-control" type="text" <?php if(isEmpty($NewMatrics)==false){ echo "value= '$NewMatrics'";} ?>pattern=".{10,10}" required />
                            <small id="newMatricsHelp" class="form-text text-muted">Eg. 17166000/1 <br>(10 characters)</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="IC" class="col-md-2 col-form-label">IC/Passport No.</label>
                        <div class="col-md-3">
                            <input id="IC" name="IC" class="form-control" type="text" <?php if(isEmpty($IC)==false){ echo "value= '$IC'";} ?> placeholder="IC / PASSPORT NUMBER" />
                            <small id="passportHelp" class="form-text text-muted">Enter without "-" or any special character</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nationality" class="col-md-2 col-form-label">Nationality.</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="malaysian" name="Nationality" value="Malaysian" />
                            <label class="form-check-label" for="inlineRadio1">Malaysian</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="nonmalaysian" name="Nationality" value="Non-Malaysian" />
                            <label class="form-check-label" for="inlineRadio2">Non-Malaysian</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="gender" class="col-md-2 col-form-label">Gender.</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="male" name="Gender" value="Male" />
                            <label class="form-check-label" for="inlineRadio1">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="female" name="Gender" value="Female" />
                            <label class="form-check-label" for="inlineRadio2">Female</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="birthday" class="col-md-2 col-form-label">Date of Birth</label>
                        <div class="col-md-3">
                            <input id="birthday" name="Birthday" class="form-control" <?php if(isEmpty($Birthday)==false){ echo "value= '$Birthday'";} ?> type="date" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="race" class="col-md-2 col-form-label">Race</label>
                        <div class="col-md-2">
                            <select id="race" name="Race" class="form-control">
                                <option selected disabled value="">Choose...</option>
                                <option value="Bumiputera">Bumiputera</option>
                                <option value="Chinese">Chinese</option>
                                <option value="Indian">Indian</option>
                                <option value="Others">Others</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="religion" class="col-md-2 col-form-label">Religion</label>
                        <div class="col-md-2">
                            <select id="religion" name="Religion" class="form-control">
                                <option selected disabled value="">Choose...</option>
                                <option value="Islam">Islam</option>
                                <option value="Buddhism">Buddhism</option>
                                <option value="Christianity">Christianity</option>
                                <option value="Hinduism">Hinduism</option>
                                <option value="Others">Others</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="marital" class="col-md-2 col-form-label">Marital Status</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="single" name="Marital" value="Single" />
                            <label class="form-check-label" for="inlineRadio1">Single</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="married" name="Marital" value="Married" />
                            <label class="form-check-label" for="inlineRadio2">Married</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="widowed" name="Marital" value="Widowed" />
                            <label class="form-check-label" for="inlineRadio3">Widowed</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="divorced" name="Marital" value="Divorced" />
                            <label class="form-check-label" for="inlineRadio4">Divorced</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-1">
                            <!-- Click this button to confirm updating the form and move to validation -->
                            <button type="submit" class="btn btn-primary" id="updatePersonal">Update</button>
                        </div>
                        <div class="col-md-3">
                            <!-- Click this button to skip updating and navigate to updateAcademic.php -->
                            <button type="button" class="btn btn-primary" id="skipPersonal">Next</button>
                        </div>
                    </div>
                    <p>#Form marked with asterisk (*) and bolded is required field. <br>#Please validate your profile picture before
                        completing your updates.</p>
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
        var picture = document.getElementById("picture");
        var previewContainer = document.getElementById("imagePreview");
        var previewImage = previewContainer.querySelector(".image-preview__image");
        var previewDefaultText = previewContainer.querySelector(".image-preview__default-text");

        //set a block to preview image for validation
        picture.addEventListener("change", function() {
            picture.style.backgroundColor = "red";
            var file = this.files[0];

            if (file) {
                const reader = new FileReader();
                previewDefaultText.style.display = "none";
                previewImage.style.display = "block";

                reader.addEventListener("load", function() {
                    previewImage.setAttribute("src", this.result);
                })

                reader.readAsDataURL(file);
            } else {
                previewDefaultText.style.display = null;
                previewImage.style.display = null;
                previewImage.setAttribute("src", "");
            }
        })
        //function to validate if user input a correct format of image
        document.getElementById("validatePicture").addEventListener("click", function() {
            var picture = document.getElementById("picture");
            var abc = document.getElementById("validatePicture")
            var array = picture.value.split(".", 2);
            var type1 = "." + array[1];
            var type = type1.toLowerCase();

            //only these type of files format is suitable
            if (type == ".jpg" || type == ".jpeg" || type == ".png" || type == ".gif" || type == ".pdf") {
                if (picture.files[0].size > 2097152) {
                    alert("File exceeded 2MB");
                    picture.style.backgroundColor = "red";
                } else {
                    alert("This file is suitable");
                    picture.style.backgroundColor = "transparent";
                }
            } else {
                alert("File format is wrong");
                picture.style.backgroundColor = "red";
            }
        })
        //all string input is made to uppercase
        document.getElementById("form").addEventListener("change", function() {
            var name = document.getElementById("name");
            var newMatrics = document.getElementById("newMatrics");
            var IC = document.getElementById("IC");
            name.value = name.value.toUpperCase();
            newMatrics.value = newMatrics.value.toUpperCase();
            IC.value = IC.value.toUpperCase();
        })
        
        document.getElementById("form").addEventListener("keyup", ICfunction);
        function ICfunction() {
            var name = document.getElementById("name");
            var IC = document.getElementById("IC");
            specialSymbol(name);
            specialSymbol(IC);
        }
        //function to check if user input a special symbol or not
        function specialSymbol(input) {
            var correct = new Boolean(false);
            for (var i = 0; i < input.value.length; i++) {
                keychar = input.value.charAt(i);
                if (keychar == "'" || keychar == "`" || keychar == "!" || keychar == "@" || keychar == "#" || keychar == "$" ||
                    keychar == "%" || keychar == "^" || keychar == "&" || keychar == "*" || keychar == "(" || keychar == ")" ||
                    keychar == "-" || keychar == "_" || keychar == "+" || keychar == "=" || keychar == "/" || keychar == "~" ||
                    keychar == "<" || keychar == ">" || keychar == "," || keychar == ";" || keychar == ":" || keychar == "|" ||
                    keychar == "?" || keychar == "{" || keychar == "}" || keychar == "[" || keychar == "]" || keychar == "¬" ||
                    keychar == "£" || keychar == '"' || keychar == "\\") {
                    correct = false;
                    break;
                } else {
                    correct = true;
                }
            }
            //invalid if user entered a special symbol
            if (correct == false && input.value.length > 0) {
                input.style.borderColor = "red";
            } else {
                input.style.borderColor = "transparent";
            }
        }
        //function when user clicked the button
        document.getElementById("skipPersonal").addEventListener("click", function() {
            var skip = window.confirm("Skip updating information of personal and proceed to update academic detail?");
            if (skip) {
                window.location.href = "updateAcademic.php";
            } else {
            return false;
            }
        })
        //validation of form
        function validateForms() {

            var picture = document.getElementById("picture");
            var name = document.getElementById("name");
            var newMatrics = document.getElementById("newMatrics");
            var IC = document.getElementById("IC");
            

            if (picture.style.backgroundColor == "red") {
                alert("The input at red-colored background is invalid.")
                return false;
            }
            if (name.style.borderColor == "red") {
                alert("The input at red-colored border form is invalid.")
                return false;
            }
            if (newMatrics.style.borderColor == "red") {
                alert("The input at red-colored border form is invalid.")
                return false;
            }
            if (IC.style.borderColor == "red") {
                alert("The input at red-colored border form is invalid.")
                return false;
            }
            var confirm = window.confirm("Confirm to update information of personal?");
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
