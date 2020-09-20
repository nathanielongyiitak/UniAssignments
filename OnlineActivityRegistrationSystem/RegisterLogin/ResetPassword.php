<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="../imgs/8th.png" type="image/icon type" />
    <title>Reset Password</title>
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


            <p class="p-3 bg-secondary text-light text-center">Please enter your email address used to register your account. We shall assist you by emailing a password reset link to the address once submitted.</p>

            <form method="post" action="ProcessEmail.php" class="form-group">
                <label for="email">
                    <i class="fas fa-envelope"> Email: </i>
                </label>
                <input class="form-control" id="email" type="email" name="email" placeholder="Enter email to reset password">

                <div class="d-flex justify-content-center align-items-center"><input id="reg-btn" class="m-3 submit-btn text-light fas fa-key" type="submit" name="recover-email" value="&#xf1d8 Submit" /></div>

            </form>
        </div>
        <footer class="text-center font-italic py-2 m-0" style="width: 100%;">
            Copyright © 2020 - XXX Residential College.
        </footer>
    </div>
</body>

</html>