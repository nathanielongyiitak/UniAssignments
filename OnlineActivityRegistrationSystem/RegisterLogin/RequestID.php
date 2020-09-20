<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="../imgs/8th.png" type="image/icon type" />
    <title>Process Form</title>
    <link rel="stylesheet" href="../css/style.css" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" />
    <script src="https://kit.fontawesome.com/5b8eaee5c3.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
</body>

</html>

<?php
include_once "../database.php";
if (isset($_GET['email'])) {
    $email = $_GET['email'];
    $sql = "SELECT * FROM `user` WHERE `Email` = '$email'";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch();

?>
    <div class="container-fluid">
        <header class="blog-header py-3">
            <h1 class="headingfont" align="center">
                <img class="mr-1 mb-2" src="../imgs/8th.png" alt="college logo" width="45" height="45" />MyCollege
            </h1>
        </header>
        <div class="jumbotron my-3">
            <?php if ($row) {
                extract($row);

                echo "<div class='alert alert-info alert-dismissible'>
                    <h4><i class='fas fa-search'> Here's what we found!</i></h4><p>The ID for <strong>$email</strong> is <strong>$ID</strong>.</p>
                    <a href='RegisterLogin.php'>Log in</a> now or <a href='RegisterLogin.php'>register</a> using another email.
                    <p>Not this email? <a href='RequestID.php'>Reenter email</a> here.</p></div>";
            } else {
                echo "<div class='alert alert-danger alert-dismissible'>
                    <h4><i class='fas fa-question'> The email is not registered.</i></h4><p>The <strong>$email</strong>  seems to be missing in the database.</p>
                    <a href='RegisterLogin.php'>Register</a> now, <a href='RequestID.php'>find ID using a different email</a> or <a href='RegisterLogin.php'>log in</a> using another email.</div>";
            }
            ?></div>
        <footer class="text-center font-italic py-2 m-0" style="width: 100%;">
            Copyright © 2020 - XXX Residential College.
        </footer>
    </div>
<?php
} else { ?>
    <div class="container-fluid">
        <header class="blog-header py-3">
            <h1 class="headingfont" align="center">
                <img class="mr-1 mb-2" src="../imgs/8th.png" alt="college logo" width="45" height="45" />MyCollege
            </h1>
        </header>
        <div class="jumbotron my-3">
            <form method="get" action="RequestID.php">
                <div>
                    <label for="email">Enter your email here: </label>
                    <input id="email" name="email" type="email" class="input-field" placeholder="Enter email" required />
                    <span id="new-email-err" style="color: red;"></span>
                </div>

                <input class="submit-btn fas fa-image text-light" type="submit" value="&#xf1d8 Submit" />
            </form>
        </div>
        <footer class="text-center font-italic py-2 m-0" style="width: 100%;">
            Copyright © 2020 - XXX Residential College.
        </footer>
    </div>
<?php
}


?>