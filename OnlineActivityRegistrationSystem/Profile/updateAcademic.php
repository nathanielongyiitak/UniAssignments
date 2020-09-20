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
  <title>Update Academic Information</title>
  <style>
        /* Display drop-down when hover  */
        .dropright:hover 
        .dropdown-menu
        {display: block;}
        .dropdown:hover
        .dropdown-menu
        {display: block;}

        
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
        <li class="nav-item">
          <a class="nav-link" href="profile.php">My Profile</a>
        </li>
      </ul>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">View Details
                    </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                            <a class="nav-link" href="profileDetail.php">Personal</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="academicDetail.php">Academic</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="contactDetail.php">Contact</a>
                            </li>
                        </ul>
                        </div>
                    </li>
                    <li class="nav-item active dropright">
                    <a  class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Update Details
                    <span class="sr-only">(current)</span>
                    </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="updatePersonal.php">Personal</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link bg-light" href="updateAcademic.php">Academic<span class="sr-only">(current)</span></a>
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
      <h2>Update Academic Information</h2>
      <?php

      //check if user is logged in or not ($_SESSION has value)
      if (isset($_SESSION['logged_in']) && $_SESSION['user_id'] && $_SESSION['user_email'] && $_SESSION['logged_in'] == true) {
        //set user_id in session to $id
        $id = $_SESSION['user_id'];
        
        //retrieve data from database
        $sql = "SELECT `Course` FROM academictable WHERE id='$id'";
        $result = $pdo->prepare($sql);
        $result -> execute();

        //assign variable for every data
        while($res = $result->fetch(PDO::FETCH_ASSOC)) {
          $Course = $res['Course'];
        }
      ?>
      <?php
                $action=isset($_GET['action']) ? $_GET['action'] : "";
                //if user successfully updated the form
                if($action == "updateAcademicSuccessful"){
                    echo "<div class='alert alert-success alert-dismissible'>
                    <h4><i class='icon fa fa-check'></i> Academic information is updated successfully! <br><a href='academicDetail.php'>View updated information</a> now!
                    </div>";
                }
            ?>
        <!-- create a form -->    
        <form method="post" action="processAcademic.php" onsubmit="return validateForms()" class="jumbotron mt-3">
          <div class="form-group row">
            <label for="faculty" class="col-md-2 col-form-label">Faculty</label>
            <div class="col-md-4">
              <select id="faculty" name="Faculty" class="form-control" >
                <option selected disabled value="">Choose...</option>
                <option value="Faculty Of Arts & Social Science">Faculty Of Arts & Social Science</option>
                <option value="Faculty Of Built Environment">Faculty Of Built Environmet</option>
                <option value="Faculty Of Business & Accountancy">Faculty Of Business & Accountancy</option>
                <option value="Faculty Of Computer Science & Information Technology">Faculty Of Computer Science & Information Technology</option>
                <option value="Faculty Of Dentistry">Faculty Of Dentistry</option>
                <option value="Faculty Of Economics & Administration">Faculty Of Economics & Administration</option>
                <option value="Faculty Of Education">Faculty Of Education</option>
                <option value="Faculty Of Engineering">Faculty Of Engineering</option>
                <option value="Faculty Of Law">Faculty Of Law</option>
                <option value="Faculty Of Languages & Linguistic">Faculty Of Languages & Linguistic</option>
                <option value="Faculty Of Medicine">Faculty Of Medicine</option>
                <option value="Faculty Of Pharmacy">Faculty Of Pharmacy</option>
                <option value="Faculty Of Science">Faculty Of Science</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="course" class="col-md-2 col-form-label">Course</label>
            <div class="col-md-4">
              <input id="course" name="Course" class="form-control" type="text"  <?php if(isEmpty($Course)==false){ echo "value= '$Course'";} ?> placeholder="COURSE"  />
              <small id="courseHelp" class="form-text text-muted">Eg. SOFTWARE ENGINEERING</small>
            </div>
          </div>
          <div class="form-group row">
            <label for="entryYear" class="col-md-2 col-form-label">Entry Year</label>
            <div class="col-md-2">
              <select id="entryYear" name="EntryYear" class="form-control" >
                <script>
                  document.write(
                    "<option selected disabled value=''>Choose...</option>"
                  );
                  //used javascript to modified that the selection of entry year 
                  //between 10 years ago until current year
                  var currentYear = new Date().getFullYear();
                  currentYear = currentYear - 9;
                  for (var i = 1; i <= 10; i++) {
                    document.write(
                      "<option value='" + currentYear + "'>" + currentYear + "</option>"
                    );
                    currentYear++;
                  }
                </script>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="duration" class="col-md-2 col-form-label">Duration</label>
            <div class="col-md-2">
              <select id="duration" name="Duration" class="form-control" >
                <script>
                  document.write(
                    "<option selected disabled value=''>Choose...</option>"
                  );
                  var dur1 = 3.0;
                  for (var i = 1; i <= 7; i++) {
                    var dur = dur1.toFixed(1);
                    document.write(
                      "<option value='" + dur + " years'>" + dur + " years</option>"
                    );
                    dur1 = dur1 + 0.5;
                  }
                </script>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="modeStudy" class="col-md-2 col-form-label">Mode Of Study</label>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="Mode" id="undergraduate" value="Undergraduate"  />
              <label class="form-check-label" for="inlineRadio1">Undergraduate</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="Mode" id="postgraduate" value="Postgraduate" />
              <label class="form-check-label" for="inlineRadio2">Postgraduate</label>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-1">
              <!-- Click this button to confirm updating the form and move to validation -->
              <button type="submit" class="btn btn-primary" id="updateAcademic">
                Update
              </button>
            </div>
            <div class="col-md-3">
              <!-- Click this button to skip updating and navigate to updateAcademic.php -->
              <button type="button" class="btn btn-primary" id="skipAcademic">Next</button>
            </div>
          </div>
          <p>#Form marked with asterisk (*) and bolded is required field. <br>
            #Update the information or skip to the next section.</p>
        </form>
      <?php
      } else { ?>
        <div class="alert alert-info" role="alert">
          <!-- display error message if user is not logged in ($_SESSION is null)-->
          <h4>Sorry, only authenticated user can access this page.</h4>
          <p><a href="/Assignment/RegisterLogin/RegisterLogin.php">Log in</a> now.</p>
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
  <script type="text/javascript">
    //function when user clicked the button
    document.getElementById("skipAcademic").addEventListener("click", function() {
      var skip = window.confirm("Skip updating information of academic and proceed to update contact detail?");
      if (skip) {
        window.location.href = "updateContact.php";
      } else {
        return false;
      }
    })
    //all string input is made to uppercase
    document.getElementById("course").addEventListener("change", function() {
      var course = document.getElementById("course");
      course.value = course.value.toUpperCase();
    })
    //validation of form
    function validateForms() {
      var confirm = window.confirm("Confirm to update information of academic?");

      if (!confirm) {
        return false;
      }
    }
    <?php
      //check if there is data stored in variable
      function isEmpty($variable){
        if($variable == ""){
          return true;
        }
        else{
          return false;
        }
      }
    ?>
  </script>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
  </script>
</body>

</html>
