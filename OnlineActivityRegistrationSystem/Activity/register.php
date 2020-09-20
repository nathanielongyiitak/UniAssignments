<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />

    <link rel="stylesheet" href="../css/style.css" />

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />

    <link rel="icon" href="../imgs/8th.png" type="image/icon type">
    <title>Register</title>
</head>

<body>
    <div class="container">
        <header class="blog-header py-3">
            <h1 class="headingfont" align="center">
                <img class="mr-1 mb-2" src="../imgs/8th.png" alt="college logo" width="45" height="45" />MyCollege
            </h1>
        </header>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="Activity.php">Activity<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Sembreak.php">Accommodation Application</a>
                    </li>

                    <li class="nav-item">
                    <a class="nav-link" href="reportStatus.php">College Helpdesk</a>
                    </li>
                </ul>
                <ul class="navbar-nav mr-1">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../imgs/profile.png" width="18" height="18" />
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="../Profile/profile.php">My Profile</a>
                            <a class="dropdown-item" href="../RegisterLogin/Logout.php">Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <main class="jumbotron mt-2">
            <h2 class="font-weight-bold">Registration for Activities</h2>
            <text>*You should only choose maximum 3 activities at one time to prevent clashing.*</text>
            <?php
            session_start();

            if (isset($_SESSION['logged_in']) && $_SESSION['user_id'] && $_SESSION['user_email'] && $_SESSION['logged_in'] == true) {
            ?>
                <div class="jumbotron mt-8">
                    <form action="addRegister.php" method="post" id="activityReg">

                        <div>
                            <br /><label for="Year">Year:</label><br />
                            <input type="text" class="form-control" id="year" name="Year" style="width: 20%" placeholder="Eg: 1,2..." required/>
                        </div>

                        <div>
                            <br /><label for="Semester">Semester:</label><br />
                            <input type="text" class="form-control" id="semester" name="Sem" style="width: 20%" placeholder="Eg: 1,2..." required/>
                        </div>

                        <div>
                            <br /><label for="activities" style="font-size: 150%"><b>Select your activities:</b></label>
                           
                            <br /><br>                            
                            <label for="Activity 1"> Activity 1:</label>
                            <select id="a1" name="a1" class="form-control" style="width: 20%">
                                <option selected>-</option>
                                <option value="MyCollege Olympics">MyCollege Olympics</option>
                                <option value="Gamers Guild">Gamers Guild</option>
                                <option value="Language and Culture Class">Language and Culture Class</option>
                                <option value="MyCollege Got Talent">MyCollege Got Talent</option>
                                <option value="Photography Club">Photography Club</option>
                            </select>
                            <p></p>
                            <br />

                           
                            <label for="Activity 2"> Activity 2:</label>
                            <select id="a2" name="a2" class="form-control" style="width: 20%">
                                <option selected>-</option>
                                <option value="MyCollege Olympics">MyCollege Olympics</option>
                                <option value="Gamers Guild">Gamers Guild</option>
                                <option value="Language and Culture Class">Language and Culture Class</option>
                                <option value="MyCollege Got Talent">MyCollege Got Talent</option>
                                <option value="Photography Club">Photography Club</option>
                            </select>
                            <p></p>
                            <br />
                            </div>

                            
                            <label for="Activity 3"> Activity 3:</label>
                            <select id="a3" name="a3" class="form-control" style="width: 20%">
                                <option selected>-</option>
                                <option value="MyCollege Olympics">MyCollege Olympics</option>
                                <option value="Gamers Guild">Gamers Guild</option>
                                <option value="Language and Culture Class">Language and Culture Class</option>
                                <option value="MyCollege Got Talent">MyCollege Got Talent</option>
                                <option value="Photography Club">Photography Club</option>
                            </select>
                            <p></p>
                            <br />
                           

                        </div>
                        <div style="text-align:center">
                            <button type="submit" class="btn btn-primary" id="submit">
                                Submit
                            </button>
                            <input type="button" class="btn btn-primary" id="cancel" value="Cancel" />
                        </div>
                    </form>
                </div>
            <?php
            } else { ?>
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
    <script>
      
        //click submit button, and pass the value to the database via POST method
        var sub = document.getElementById("submit");
        sub.addEventListener("click", function() {
            var yes = window.confirm("Are you sure to submit the registration?\nNote: 'Once you have submitted, you are not allowed to change anymore.'");
            if (yes) {
               
            } else {
                return true;
            }
        });
        //click cancel button to cancel and go back to activity page
        var can = document.getElementById("cancel");
        can.addEventListener("click", function() {
            var no = window.confirm("Are you sure to cancel the registration?");
            if (no) {
                window.location.href = "Activity.php";
            } else {
                return true;
            }
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
</body>

</html>
