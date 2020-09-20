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

<div class="container-fluid">
    <header class="blog-header py-3">
        <h1 class="headingfont" align="center">
            <img class="mr-1 mb-2" src="../imgs/8th.png" alt="college logo" width="45" height="45" />MyCollege
        </h1>
    </header>
    <div class="jumbotron">

        <?php
        include_once "../database.php";
        if (isset($_POST['password'])) {
            $code = $_POST['code'];

            $stmt = $pdo->prepare("SELECT * FROM `reset_password` WHERE `Code`='$code'");
            $stmt->execute();
            $row = $stmt->fetch();

            $pw = $_POST['password'];

            $salt = "roA&h2u!PoaWr2u";
            $hash = hash("sha256", $pw . $salt);

            if(!$row){
                exit('Link expired!');
            }

            $email = $row['Email'];

            try {
                $pdo->prepare("UPDATE `user` SET `Password`='$hash' WHERE `Email`='$email'")->execute();

                $pdo->prepare("DELETE FROM `reset_password` WHERE `Code` = '$code'")->execute();

                echo "<div class='alert alert-success alert-dismissible'>
            <h4><i class='icon fa fa-check'> Done updating password.</i></h4>
            <a href='RegisterLogin.php'>Log In</a> now!";
            } catch (Exception $e) {
                echo "<div class='alert alert-danger alert-dismissible'>
                <h4><i class='icon fa fa-exclamation-circle'> Something went wrong.</i></h4>
                <p>Please <a href='ResetPassword.php'>try again</a>.</p>";
            }
        } else if (isset($_GET['code'])) {
            $code = $_GET["code"];
        ?>
            <form onsubmit="return checkForm(this);" method="post" class="form-group">
                <input type="hidden" name="code" value="<?php echo $code ?>">

                <label for="password">
                    <i class="fas fa-key"> New Password: </i>
                </label>
                <input class="form-control" id="password" type="password" name="password" placeholder="Enter new password">

                <div id="message" style="display: none;">
                    <h4 style="font-size: medium;">Password must contain the following:</h4>
                    <p style="font-size: small;" id="letter" class="invalid pl-5">A <b>lowercase</b> letter</p>
                    <p style="font-size: small;" id="capital" class="invalid pl-5">A <b>capital (uppercase)</b> letter</p>
                    <p style="font-size: small;" id="number" class="invalid pl-5">A <b>number</b></p>
                    <p style="font-size: small;" id="length" class="invalid pl-5">Minimum <b>8 characters</b></p>
                </div>

                <input id="reg-btn" class="m-3 d-flex justify-content-center submit-btn text-light fas fa-key" type="submit" name="reset-password" value="&#xf1d8 Submit" />
            </form>

            <script>
                let myInput = document.querySelector("#password");

                let letter = document.querySelector("#letter");
                let capital = document.querySelector("#capital");
                let number = document.querySelector("#number");
                let length = document.querySelector("#length");

                // When the user moves cursor onto the password field, show the message box
                myInput.onfocus = function() {
                    document.getElementById("message").style.display = "block";
                }

                // When the user moves cursor outside of the password field, hide the message box
                myInput.onblur = function() {
                    document.getElementById("message").style.display = "none";
                }

                // When the user starts to type something inside the password field
                myInput.onkeyup = function() {
                    // Validate lowercase letters
                    var lowerCaseLetters = /[a-z]/g;
                    if (this.value.match(lowerCaseLetters)) {
                        letter.classList.remove("invalid");
                        letter.classList.add("valid");
                    } else {
                        letter.classList.remove("valid");
                        letter.classList.add("invalid");
                    }
                    // Validate capital letters
                    var upperCaseLetters = /[A-Z]/g;
                    if (this.value.match(upperCaseLetters)) {
                        capital.classList.remove("invalid");
                        capital.classList.add("valid");
                    } else {
                        capital.classList.remove("valid");
                        capital.classList.add("invalid");
                    }

                    // Validate numbers
                    var numbers = /[0-9]/g;
                    if (myInput.value.match(numbers)) {
                        number.classList.remove("invalid");
                        number.classList.add("valid");
                    } else {
                        number.classList.remove("valid");
                        number.classList.add("invalid");
                    }

                    // Validate length
                    if (myInput.value.length >= 8) {
                        length.classList.remove("invalid");
                        length.classList.add("valid");
                    } else {
                        length.classList.remove("valid");
                        length.classList.add("invalid");
                    }
                }

                function checkForm() {
                    let allValid = capital.classList.contains('valid') && letter.classList.contains('valid') && number.classList.contains('valid') && length.classList.contains('valid');
                    if (!allValid) {
                        alert('Please follow the requested formats, thank you.');
                    }
                    return allValid;
                }
            </script>
        <?php
        } else {
        }


        ?>
    </div>
</div>