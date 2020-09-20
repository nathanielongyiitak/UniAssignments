<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="../imgs/8th.png" type="image/icon type" />
    <title>Process Form</title>
    <link rel="stylesheet" href="../css/style.css" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" />
    <script src="https://kit.fontawesome.com/5b8eaee5c3.js" crossorigin="anonymous"></script>
</head>

<body>
</body>

</html>

<?php

include_once '../database.php';

if (isset($_POST['register'])) {
?>
    <div class="container-fluid">
        <header class="blog-header py-3">
            <h1 class="headingfont" align="center">
                <img class="mr-1 mb-2" src="../imgs/8th.png" alt="college logo" width="45" height="45" />MyCollege
            </h1>
        </header>
        <div class="jumbotron">
            <?php

            // Eliminate possible empty strings from inputs
            if (!empty(trim($_POST['newID'])) && !empty(trim($_POST['email'])) && !empty(trim($_POST['newName'])) & !empty(trim($_POST['newPW']))) {
                $ID = $_POST['newID'];
                $ID = strtoupper($ID);
                $Email = $_POST['email'];
                $Email = strtoupper($Email);
                $pw = $_POST['newPW'];
                $name = $_POST['newName'];
                $name = strtoupper($name);

                $salt = "roA&h2u!PoaWr2u";

                $hash = hash("sha256", $pw . $salt); //hash password

                $emailCheck = "SELECT * FROM `user` WHERE `Email` = '$Email'";
                $idCheck = "SELECT * FROM `user` WHERE `ID` = '$ID'";

                $emailValidate = $pdo->prepare($emailCheck);
                $emailValidate->execute();

                $idValidate = $pdo->prepare($idCheck);
                $idValidate->execute();

                // Check for existing email or id
                if ($emailValidate->rowCount() > 0 || $idValidate->rowCount() > 0) {
                    // id exists only
                    if ($emailValidate->rowCount() == 0) {
                        echo "<div class='alert alert-danger alert-dismissible'>
                <h4><i class='icon fa fa-exclamation-circle'> ID is already registered before.</i></h4>
                <a href='RegisterLogin.php'>Log in</a> now or <a href='RegisterLogin.php'>register</a> using another ID.
            </div>";
                    }
                    // email exists only
                    else if ($idValidate->rowCount() == 0) {
                        echo "<div class='alert alert-danger alert-dismissible'>
                <h4><i class='icon fa fa-exclamation-circle'> Email is already registered before.</i></h4>
                <div class='mb-3'><a href='RegisterLogin.php'>Log in</a> now or <a href='RegisterLogin.php'>register</a> using another email.</div>
                <div><h4><i class='fas fa-question'> Forgot your ID?</i></h4><a href='RequestID.php?email=$Email' class='btn btn-primary rounded-pill'><i class='fas fa-eye'> Find it now!</i></a></div>
            </div>";
                    }
                    // both exist
                    else {
                        echo "<div class='alert alert-danger alert-dismissible'>
                <h4><i class='icon fa fa-exclamation-circle'> Email and ID are already registered before.</i></h4>
                <a href='RegisterLogin.php'>Log in</a> now or <a href='RegisterLogin.php'>register</a> using another email and ID.
            </div>";
                    }
                } else {
                    // conditions to create new user clear
                    $sql0 = "INSERT INTO `user` (`ID`, `Email`, `Name`, `Password`) 
        VALUES ('$ID', '$Email', '$name', '$hash')";
                    $sql1 = "INSERT INTO `personaltable`(`ID`) VALUES ('$ID')";
                    $sql2 = "INSERT INTO `contacttable`(`ID`) VALUES ('$ID')";
                    $sql3 = "INSERT INTO `academictable`(`ID`) VALUES ('$ID')";

                    try {
                        $stmt0 = $pdo->prepare($sql0);
                        $stmt1 = $pdo->prepare($sql1);
                        $stmt2 = $pdo->prepare($sql2);
                        $stmt3 = $pdo->prepare($sql3);

                        $stmt0->execute();
                        $stmt1->execute();
                        $stmt2->execute();
                        $stmt3->execute();

                        echo "<div class='alert alert-success alert-dismissible'>
            <h4><i class='icon fa fa-check'></i> Great, thanks for signing up!</h4>
            Account created successfully! <a href='RegisterLogin.php'>Log In</a> now!
          </div>";
                    } catch (Exception $e) {
                        echo "Error: " . $e;
                    }
                }
                $pdo = null;
            } else {
                echo "<div class='alert alert-danger alert-dismissible'>
                <h4><i class='icon fa fa-exclamation-circle'> Invalid information entered.</i></h4>Please
                 <a href='RegisterLogin.php'>try again</a>.
            </div>";
            }

            ?>
        </div>
        <footer class="text-center font-italic py-2 m-0" style="width: 100%;">
            Copyright © 2020 - XXX Residential College.
        </footer>
    </div>
<?php
}


if (isset($_POST['login'])) {
    $ID = strtoupper($_POST['ID']);
    $pw = $_POST['pw'];

    $salt = "roA&h2u!PoaWr2u";
    $hash = hash("sha256", $pw . $salt);

    $check = "SELECT * FROM `user` WHERE `ID`='$ID' AND `Password` = '$hash'";

    $stmt = $pdo->prepare($check);
    $stmt->execute();
    $row = $stmt->fetch();

    // if condition to check for existence of record in database

    if ($row) {
        extract($row);

        //start session
        session_start();
        $_SESSION['logged_in'] = true;
        $_SESSION['user_id'] = $ID;
        $_SESSION['user_email'] = $Email;

        header("Location:../Activity/activity.php");
    } else {
        header('Location:RegisterLogin.php?msg=login_failed');
    }
}
