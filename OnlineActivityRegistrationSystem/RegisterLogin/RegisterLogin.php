<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="../imgs/8th.png" type="image/icon type" />
    <title>Login and Registration Form</title>
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

        <?php
        if (isset($_GET["msg"])) {
            if ($_GET["msg"] == "login_failed") {
                echo "<div class='alert alert-danger alert-dismissible m-0'><h4><i class='fas fa-exclamation-circle'> Access Denied.</i></h4><br><p>Incorrect username or password, please try again.</p></div>";
            }
        }
        ?>

        <div class="hero d-flex justify-content-center align-items-center">
            <div class="form-box">
                <div class="btn-box">
                    <div id="btn"></div>
                    <input id="rg-btn" class="toggle-btn text-light" type="button" value="Register" onclick="register()" />
                    <input id="lg-btn" class="toggle-btn" type="button" value="Log In" onclick="login()" />
                </div>

                <form onsubmit="return checkForm(this);" id="register" method="post" action="ProcessForm.php" class="input-grp">
                    <div class="d-flex justify-content-center"></div>

                    <div>
                        <label for="new-ID"><i class="fas fa-id-badge"> ID: </i></label>
                        <input id="new-ID" name="newID" type="text" class="input-field" placeholder="Enter Matric Number" required />
                    </div>

                    <div id="msg" style="display: none;">
                        <h4 style="font-size: medium;">Please follow matric number's format.</h4>
                        <p style="font-size: small;" class="valid pl-5"><strong>Example: WIF180049</strong></p>
                        <p style="font-size: small;" id="matric" class="invalid pl-5"><strong>Validity of ID input</strong></p>
                    </div>

                    <div>
                        <label for="email"><i class="fas fa-envelope"> Email: </i></label>
                        <input id="email" name="email" type="email" class="input-field" placeholder="Enter Siswamail" required />
                    </div>

                    <div id="check" style="display: none;">
                        <h4 style="font-size: medium;">Please follow siswamail's format.</h4>
                        <p style="font-size: small;" class="valid pl-5">Example: <strong>wif180049@siswa.um.edu.my</strong></p>
                        <p style="font-size: small;" id="siswamail" class="invalid pl-5"><strong>Validity of siswamail input</strong></p>
                    </div>

                    <div>
                        <label for="new-name"><i class="fas fa-user"> Name: </i></label>
                        <input id="new-name" name="newName" type="text" class="input-field" placeholder="Enter Name" required />
                    </div>

                    <div>
                        <label for="new-pw"><i class="fas fa-key"> Password: </i></label>
                        <span id="register-eye" class="slashed"></span>
                        <input id="new-pw" name="newPW" type="password" class="input-field" placeholder="Enter Password" required />
                    </div>

                    <div id="message" style="display: none;">
                        <h4 style="font-size: medium;">Password must contain the following:</h4>
                        <p style="font-size: small;" id="letter" class="invalid pl-5">A <b>lowercase</b> letter</p>
                        <p style="font-size: small;" id="capital" class="invalid pl-5">A <b>capital (uppercase)</b> letter</p>
                        <p style="font-size: small;" id="number" class="invalid pl-5">A <b>number</b></p>
                        <p style="font-size: small;" id="length" class="invalid pl-5">Minimum <b>8 characters</b></p>
                    </div>

                    <div>
                        <input id="reg-checkbox" type="checkbox" class="checkbox" required />
                        <label for id="reg-checkbox" class="checkbox-text">I agree to the <a href="TermsAndConditions.php">terms & conditions</a>.</label>
                    </div>

                    <input id="reg-btn" class="d-flex justify-content-center submit-btn text-light fas fa-key" type="submit" name="register" value="&#xf2f6 Register" />
                </form>

                <form id="login" method="post" action="ProcessForm.php" class="input-grp">
                    <div>
                        <label for=" ID"><i class="fas fa-id-badge"> ID: </i></label>
                        <input id="ID" name="ID" type="text" class="input-field" placeholder="Enter Matric Number" required />
                    </div>

                    <div>
                        <label for="pw"><i class="fas fa-key"> New Password: </i></label>
                        <span id="login-eye" class="slashed"></span>
                        <input id="pw" name="pw" type="password" class="input-field" placeholder="Enter Password" required />
                    </div>

                    <div class="mb-2">
                        <p class="m-0"><i class="fas fa-id-card"> Forgot ID?</i></p>
                        <a href="RequestID.php">Click Me</a>
                    </div>

                    <div class="mb-2">
                        <p class="m-0"><i class="fas fa-lock"> Forgot Password?</i></p>
                        <a href="ResetPassword.php">Reset Password</a>
                    </div>

                    <!-- <div>
                        <input id="checkbox" type="checkbox" class="checkbox" name="checkbox" /><label for="checkbox" class="checkbox-text ml-1">Keep me logged in</label>
                    </div> -->

                    <input id="login-btn" class="d-flex justify-content-center submit-btn text-light fas fa-sign-in-alt" type="submit" name="login" value="&#xf09c Log In" />
                </form>
            </div>
        </div>
        <footer class="text-center font-italic py-2 m-0" style="width: 100%;">
            Copyright © 2020 - XXX Residential College.
        </footer>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>

    <script src="../js/InputsValidation.js"></script>

    <script src="../js/RegisterLogin.js"></script>
</body>

</html>