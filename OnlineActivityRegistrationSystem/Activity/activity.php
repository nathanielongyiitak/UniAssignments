<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">

    <link rel="stylesheet" href="../css/style.css">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .flip-card {
            background-color: transparent;
            width: 300px;
            height: 300px;
            perspective: 1000px;
        }

        .flip-card-inner {
            position: relative;
            width: 100%;
            height: 100%;
            text-align: center;
            transition: transform 0.6s;
            transform-style: preserve-3d;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        }

        .flip-card:hover .flip-card-inner {
            transform: rotateY(180deg);
        }

        .flip-card-front,
        .flip-card-back {
            position: absolute;
            width: 100%;
            height: 100%;
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
        }

        .flip-card-front {
            background-color: #bbb;
            color: black;
        }

        .flip-card-back {
            background-color: #008B8B;
            color: white;
            transform: rotateY(180deg);
        }

        .column {
            float: left;
            width: 33.33%;
            padding: 5px;
        }

        /* Clearfix (clear floats) */
        .row::after {
            content: "";
            clear: both;
            display: table;
        }

        .button {
            background-color: #20B2AA;
            border: none;
            color: white;
            padding: 16px 32px;
            text-align: center;
            font-size: 16px;
            margin: 4px 2px;
            opacity: 0.6;
            transition: 0.5s;
            display: inline-block;
            text-decoration: none;
            cursor: pointer;
        }

        .button:hover {
            opacity: 1
        }

        .container1 {
            height: 300px;
            position: relative;
        }

        .center {
            margin: 0;
            position: absolute;
            top: 50%;
            left: 43%;
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
        }

        .buttonround {
            border-radius: 50%;
        }
    </style>
    <link rel="icon" href="imgs/8th.png" type="image/icon type">
    <title>List of Activities</title>
</head>

<body>
    <div class="container">

        <header class="blog-header py-3">
            <h1 class="headingfont" align="center"><img class="mr-1 mb-2 " src="../imgs/8th.png" alt="college logo" width="45" height="45">MyCollege</h1>
        </header>


        <nav class="navbar navbar-expand-lg navbar-light bg-light">

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="collapsibleNavbar">
                <ul class="navbar-nav mr-auto ">
                    <li class="nav-item active">
                        <a class="nav-link" href="Activity.php">Activity<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="Sembreak.php">Accommodation Application</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="reportStatus.php">College Helpdesk</a>
                    </li>

                </ul>
                <ul class="navbar-nav mr-1">
                    <li class="nav-item dropdown">

                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../imgs/profile.png" width="18" height="18">
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

            <h2 class="font-weight-bold ">Activities of MyCollege</h2>
            <?php
            // Check for session before displaying page
            if (isset($_SESSION['logged_in']) && $_SESSION['user_id'] && $_SESSION['user_email'] && $_SESSION['logged_in'] == true) {
            ?>
                &emsp;<a href="history.php"><button class="button">View registration history</button></a>
                <div class="row">
                    <div class="column">
                        <div class="flip-card">
                            <div class="flip-card-inner">
                                <div class="flip-card-front">
                                    <img src="../imgs/cheerleading.jpg" alt="cheerleading" style="width:300px;height:300px;">
                                </div>
                                <div class="flip-card-back">
                                    <h1>MyCollege Olympics</h1>
                                    <p>&#42Date: 1st of Nov-1st of December</p>
                                    <a href="olympic.php"><button class="btn btn-primary">Click to view more details.</button></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="column">
                        <div class="flip-card">
                            <div class="flip-card-inner">
                                <div class="flip-card-front">
                                    <img src="../imgs/midone.jpg" alt="midone" style="width:300px;height:300px;">
                                </div>
                                <div class="flip-card-back">
                                    <h1>Gamers Guild</h1>
                                    <p>&#42Available every week</p>
                                    <a href="gamer.php"><button class="btn btn-primary">Click to view more details.</button></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="column">
                        <div class="flip-card">
                            <div class="flip-card-inner">
                                <div class="flip-card-front">
                                    <img src="../imgs/photo.jpg" alt="midone" style="width:300px;height:300px;">
                                </div>
                                <div class="flip-card-back">
                                    <h1>Photography Club</h1>
                                    <p>&#42Available every week</p>
                                    <a href="photo.php"><button class="btn btn-primary">Click to view more details.</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="column">
                        <div class="flip-card">
                            <div class="flip-card-inner">
                                <div class="flip-card-front">
                                    <img src="../imgs/teaching.png" alt="teaching" style="width:300px;height:300px;">
                                </div>
                                <div class="flip-card-back">
                                    <h1>Language and Culture Class</h1>
                                    <p>&#42Available every week</p>
                                    <a href="lang.php"><button class="btn btn-primary">Click to view more details.</button></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="column">
                        <div class="flip-card">
                            <div class="flip-card-inner">
                                <div class="flip-card-front">
                                    <img src="../imgs/joji.jpg" alt="joji" style="width:300px;height:300px;">
                                </div>
                                <div class="flip-card-back">
                                    <h1>MyCollege Got Talent</h1>
                                    <p>&#42Date: 1st of February</p>
                                    <a href="talent.php"><button class="btn btn-primary">Click to view more details.</button></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="column">
                        <div class="container1">
                            <div class="center">
                                <a href="register.php"><button class="button buttonround" style="width:200px;height:200px;"><text style="font-size: 30px; font-weight: bold">Register Now</text></button></a>
                            </div>
                        </div>
                    </div>
                </div>

        </main>
    </div>
<?php } else { ?>
    <div class="alert alert-info" role="alert">
        <h4>Sorry, only authenticated user can access this page.</h4>
        <p><a href="../RegisterLogin/RegisterLogin.php">Log in</a> now.</p>
    </div><?php } ?>

<footer class="container text-center font-italic py-2">
    Copyright © 2020 - XXX Residential College.
</footer>







<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
</script>
</body>

</html>