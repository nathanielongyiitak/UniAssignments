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
    <title>My Profile</title>
    <style>
        /* Display drop-down when hover  */
        .dropright:hover 
        .dropdown-menu
        {display: block;}
        .dropdown:hover
        .dropdown-menu
        {display: block;}

        /* Display paragraph to center */
        h2 {text-align: center;}

        
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
                <li class="nav-item active">
                    <a class="nav-link" href="profile.php">My Profile<span class="sr-only">(current)</span></a>
                </li>
            </ul>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">View Details</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="profileDetail.php">Personal</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="academicDetail.php">Academic</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="contactDetail.php">Contact</a>
                            </li>
                        </ul>
                        </div>
                    </li>
                    <li class="nav-item dropright">
                    <a  class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Update Details</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="updatePersonal.php">Personal</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="updateAcademic.php">Academic</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="updateContact.php">Contact</a>
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
            <h2>My Profile</h2><br>
            <?php

            //check if user is logged in or not ($_SESSION has value)
            if (isset($_SESSION['logged_in']) && $_SESSION['user_id'] && $_SESSION['user_email'] && $_SESSION['logged_in'] == true) {
                //set user_id in session to $id and user_email to $Email
                $id = $_SESSION['user_id'];
                $Email = $_SESSION['user_email'];

                //retrieve data from database
                $sqlPer = "SELECT ProfilePicture,NewMatrics FROM personaltable WHERE id='$id'";
                $resultPer = $pdo->prepare($sqlPer);
                $resultPer -> execute();

                //assign variable for every data
                while($resPer = $resultPer->fetch(PDO::FETCH_ASSOC)) {
                    $ProfilePicture = $resPer['ProfilePicture'];
                    $NewMatrics = $resPer['NewMatrics'];
                }

                //retrieve data from database
                $sqlPer1 = "SELECT Name FROM user WHERE id='$id'";
                $resultPer1 = $pdo->prepare($sqlPer1);
                $resultPer1 -> execute();

                //assign variable for every data
                while($resPer1 = $resultPer1->fetch(PDO::FETCH_ASSOC)) {
                    $Name = $resPer1['Name'];
                }
            ?>
                <div class="text-center">
                    <?php
                        //check if there is image stored in database
                        if(empty($ProfilePicture)){
                    ?>
                            <img src="../imgs/profile.png" alt="User profile picture" style="width: 200px; height: 200px; border: 1px solid Gray;"/>
                    <?php
                        }else{
                    ?>
                    <!-- Image stored in database is in binary format, thus decode the data using base64_encode before display to the webpage-->
                    <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($ProfilePicture); ?>" alt="User profile picture" style="width: 200px; height: 200px; border: 1px solid Gray;"/>
                    <?php
                        }
                    ?>
                
                <table class="table table-striped">
                    <!-- Display data from database to the webpage -->
                    <tr><th scope="row" class="w-25 p-3">ID:</th><td><?php echo $id; ?> </td></tr>
                    <tr><th scope="row" class="w-25 p-3">Name:</th><td><?php echo $Name; ?> </td></tr>
                    <tr><th scope="row" class="w-25 p-3">New Matrics No:</th><td><?php echo $NewMatrics; ?> </td></tr>
                    <tr><th scope="row" class="w-25 p-3">Email:</th><td><?php echo $Email; ?> </td></tr>
                    <tr><th scope="row" class="w-25 p-3">User Access Level:</th><td>Student</td></tr>
                </table>
                    </div>
                <div class="text-right"><br>
                    <!-- Click this button to navigate to changePassword.php -->
                    <button type="button" class="btn btn-primary btn-sm" id=changepw>Change Password</button>
                    <!-- Click this button to navigate to delete.php -->
                    <form action="delete.php" method="post" onsubmit="return validateForms()"><br>
                    <input type="submit" class="btn btn-danger btn-sm" value="Delete Account" id="delete" >
                    </form>
                </div>
                <script type="text/javascript">
                //validation for the form
                function validateForms(){
                        var x = confirm("Are you sure to remove this account?");
                        if (x){
                            var y = confirm("All data stored will be deleted permanently. Click \"ok\" to confirm the deletion.");
                            if(!y){
                                return false;
                            }
                        }
                        else return false;
                }
                //function used for button id="changepw"
                document.getElementById("changepw").addEventListener("click",function(){
                    var change = confirm("Change password?");
                    if (change){
                    window.location.href = "changePassword.php";
                    }else{
                        return false;
                    }
                })
                </script>
            <?php
            } else { ?>
                <!-- display error message if user is not logged in ($_SESSION is null)-->
                <div class="alert alert-info" role="alert">
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
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>
