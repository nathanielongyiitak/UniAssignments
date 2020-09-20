<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="../imgs/8th.png" type="image/icon type" />
    <title>Process Email</title>
    <link rel="stylesheet" href="../css/style.css" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" />
    <script src="https://kit.fontawesome.com/5b8eaee5c3.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container-fluid">
        <header class="blog-header py-3">
            <h1 class="headingfont" align="center">
                <img class="mr-1 mb-2" src="../imgs/8th.png" alt="college logo" width="45" height="45" />MyCollege
            </h1>
        </header>
        <div class="jumbotron my-3">

            <?php

            use PHPMailer\PHPMailer\PHPMailer;
            use PHPMailer\PHPMailer\SMTP;
            use PHPMailer\PHPMailer\Exception;

            if (isset($_POST['recover-email'])) {
                $email = $_POST['email'];
                include "../database.php";

                $checkEmail = "SELECT * FROM `user` WHERE `Email` = '$email'";

                $stmt = $pdo->prepare($checkEmail);
                $stmt->execute();
                $row = $stmt->fetch();

                if ($row) {
                    $name = $row['Name'];

                    require 'PHPMailer/src/Exception.php';
                    require 'PHPMailer/src/PHPMailer.php';
                    require 'PHPMailer/src/SMTP.php';

                    // Instantiation and passing `true` enables exceptions
                    $mail = new PHPMailer(true);

                    try {
                        $code = uniqid(true);

                        $url = "http://" . $_SERVER["HTTP_HOST"] . dirname($_SERVER["PHP_SELF"]) . "/UpdatePassword.php?code=$code";

                        //Server settings
                        $mail->isSMTP();                                            // Send using SMTP
                        $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
                        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                        $mail->Username   = 'botappappbot2@gmail.com';                     // SMTP username
                        $mail->Password   = 'NathanielOngYiiTak';                               // SMTP password
                        $mail->SMTPSecure = 'PHPMailer::ENCRYPTION_STARTTLS';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged ;; PHPMailer::ENCRYPTION_STARTTLS
                        $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above ;; 587

                        //Recipients
                        $mail->setFrom('boatppappbot2@gmail.com', 'Test Bot');
                        $mail->addAddress($email, $name);     // Add a recipient
                        $mail->addReplyTo('boatppappbot2@gmail.com', 'Test Bot');

                        // Content
                        $mail->isHTML(true);                                  // Set email format to HTML
                        $mail->Subject = 'Here is the password reset link';
                        $mail->Body    = "<a href='$url'>Click here</a> to reset password, thank you.";
                        $mail->AltBody = "<a href='$url'>Click here</a> to reset password, thank you.";

                        $mail->send();

                        $sql = "INSERT INTO `reset_password` (`ID`, `Code`, `Email`) VALUES (NULL, '$code', '$email')";

                        $stmt = $pdo->prepare($sql);

                        $stmt->execute();

                        echo "<div class='alert alert-info alert-dismissible'>
            <h4><i class='icon fa fa-check'> An email has been sent to the address, please reset password using the link attached, thank you.</i></h4>
            <a href='RegisterLogin.php'>Log in</a> now after resetting password through email link.<p>Did not receive link? <a href='javascript:location.reload(true)'>Resend</a> now</p>
            <p>Wrong email? <a href='ResetPassword.php'>Reenter email</a> now.</p></div>";
                    } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
                } else {
                    echo "<div class='alert alert-danger alert-dismissible'>
            <h4><i class='fas fa-question'> The email is not registered.</i></h4><p>The <strong>$email</strong>  seems to be missing in the database.</p>
            <a href='RegisterLogin.php'>Register</a> now, <a href='RegisterLogin.php'>log in</a> using another email or <a href='ResetPassword.php'>try again</a>.</div>";
                }
            } else {
                echo "<div class='alert alert-danger alert-dismissible'>
            <h4><i class='fas fa-question'> Something went wrong, please <a href='ResetPassword.php'>try again</a>, <a href='RegisterLogin.php'>register</a> or <a href='ResetPassword.php'>log in</a>.</i></h4></div>";
            }
            ?>
        </div>
        <footer class="text-center font-italic py-2 m-0" style="width: 100%;">
            Copyright © 2020 - XXX Residential College.
        </footer>
    </div>
</body>

</html>