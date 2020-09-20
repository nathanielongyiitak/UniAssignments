<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />

  <link rel="stylesheet" href="../css/style.css" />
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />

  <link rel="icon" href="../imgs/8th.png" type="image/icon type" />
  <title>Application</title>
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
          <li class="nav-item">
            <a class="nav-link" href="Activity.php">Activity</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="Sembreak.php">Accommodation Application<span class="sr-only">(current)</span></a>
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
      <h2>Application to Stay during Semester Break</h2>
      <?php
      session_start();

      if (isset($_SESSION['logged_in']) && $_SESSION['user_id'] && $_SESSION['user_email'] && $_SESSION['logged_in'] == true) {
        
        
      ?>
        <form method="post" action="addApplication.php" onsubmit ="return checkDateRange()" class="jumbotron mt-3">
          <div class="form-group">

              <label for="Staying From">Select the range of date you are going to stay:</label>
              <div ><input style="float: left;" autocomplete="off"  class="form-control w-50" type="text" name="daterange" id="daterange"  required />
              <span class="align-middle" style="color: red;" id="validate"></span></div>
          </div>
          <div class="form-group w-50">
            <label for="Reason">Reason:</label>
            <textarea class="form-control" style="resize: none;" rows="6" id="Reason" type="text" name="reason" required></textarea>
          </div>
          <button type="submit" class="btn btn-primary" id="submit">Submit
          </button>
        </form>


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

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<!-- daterange picker -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    
    <script type="text/javascript">
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();
        today = yyyy + '-' + mm + '/' + dd;
  
        $(function() {
          //prevent keyboard input in daterange column
          $('input[name="daterange"]').keydown(false);
          // date range picker
          $('input[name="daterange"]').daterangepicker({

              // empty input when page load
              autoUpdateInput: false,
              locale: {
                  format: 'YYYY-MM-DD',
                  cancelLabel: 'Clear'
              },
              // date bfore today cannot be selected
              minDate: today,
              // apply date when 2nd date is picked
              autoApply: true,
          });

          $('input[name="daterange"]').on('apply.daterangepicker', function(ev, picker) {

              $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
          });
        });
        // validate the date range, date picked cannot be the same day
        function checkDateRange(){
          var daterange = document.getElementById("daterange").value;
          var date=daterange.split(" - ");
          if(date[0]==date[1]){
             document.getElementById("validate").innerText = "*Invalid range of date! Please select 2 different date.*";
             return false;
          }
        }
    </script>
</body>
</html>
