<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
      
    <link rel="stylesheet" href="../css/style.css" />
      
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />
      
    <link rel="icon" href="../imgs/8th.png" type="image/icon type" />
    <title>Report</title>
</head>

<body>
    <div class="container">

        <header class="blog-header py-3">
            <h1 class="headingfont" align="center"><img class="mr-1 mb-2 " src="../imgs/8th.png" alt="college logo"
                    width="45" height="45">MyCollege</h1>
        </header>


        <nav class="navbar navbar-expand-lg navbar-light bg-light">

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="collapsibleNavbar">
                <ul class="navbar-nav mr-auto ">
                    <li class="nav-item ">
                        <a class="nav-link" href="Activity.php">Activity</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="Sembreak.php">Accommodation Application</a>
                    </li>

                    <li class="nav-item active">
                    <a class="nav-link" href="reportStatus.php">College Helpdesk</a>
                    </li>

                </ul>
                <ul class="navbar-nav mr-1">
                    <li class="nav-item dropdown">

                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="../imgs/profile.png" width="18" height="18">
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
            <h2>Edit Report</h2>
            <?php
            session_start();
            include_once('../database.php');
            if (isset($_SESSION['logged_in']) && $_SESSION['user_id'] && $_SESSION['user_email'] && $_SESSION['logged_in'] == true) {
                $editNum=$_POST["editNum"];
                $sql="SELECT `reportno`,`Location`,`Title`,`Type`,`Description` FROM `report_table` WHERE (`reportno`='$editNum')";
                $select=$pdo->prepare($sql);
                $select->execute();
                $editThis=$select->fetch(PDO::FETCH_ASSOC);
            ?>
             <!-- Edit report form -->
                <form method="post" action="saveReport.php" class="jumbotron mt-3" >
                   
                   
                 
    
                    <div class="form-group w-25">
                        <label for="location">Location:</label>
                        <input type="text" class="form-control" name="location" placeholder="Eg: Block B Wing A "required <?php echo $editThis['Type']; ?> />
                    </div>
    
                    <div class="form-group w-25">
                        <label for="title">Issue title:</label>
                        <input type="text" class="form-control" name="title" placeholder="Eg: Dirty toilet "required <?php echo $editThis['Title']; ?>/>
                    </div>
    
    
                    <div class="form-group w-25">
                        <label for="type">Issue type:</label>
                        <select name="type" class="form-control">
                            <option value="Safety issues">Safety issues</option>
                            <option value="Appliances issues">Appliances issues</option>
                            <option value="Toilet issues">Toilet issues</option>
                            <option value="Others">Others</option>
                        </select>
                    </div>
                    <div class="form-group w-50">
                        <label for="description">Description:</label>
                        <textarea style="resize:none" name="description" class="form-control" rows="6" name="description" type="text"  required><?php echo $editThis['Description']; ?></textarea>
                    </div>
                  
    
                    <div>
                        <br>
                        <p>
                        <button class="btn btn-primary" id="saveEdit"  name="saveEdit" value="<?php echo $editNum; ?>">Save Changes</button>
                        <button type="button" class="btn btn-outline-primary"  data-toggle="modal" data-target="#confirmModal">Cancel</button></p>
                    </div>
                </form>

                <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header text-center " style="background-color: #F8F9FA;">
                                <h4 class="modal-title w-100">Confirmation</h4>
                                
                            </div>
                      <div class="modal-body text-center">
                        Discard all changes?<br><br>
                      </div>
                      <div class="modal-footer">
                        <p align="right">
                            <a class="btn btn-primary" href="reportStatus.php" >Yes</a>
                            <button data-dismiss="modal" class="btn btn-outline-primary" data-dismiss="modal" >No</button>
                        </p>
                      </div>
                    </div>
                  </div>
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

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
                <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
                    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
                    crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
                    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
                    crossorigin="anonymous"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
                    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
                    crossorigin="anonymous"></script>

                

</body>

</html>
