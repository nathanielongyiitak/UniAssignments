<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/style.css">    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- Pagination -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" />

    <link rel="icon" href="../imgs/8th.png" type="image/icon type">
    <title>Semester Break</title>
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
                    <li class="nav-item ">
                        <a class="nav-link" href="Activity.php">Activity</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link " href="Sembreak.php">Accommodation Application<span class="sr-only">(current)</span></a>
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
        
        
        <main class="jumbotron mt-2" >
            
            <h2>Accommodation during Semester Break</h2>
            <?php
            session_start();

            // show alert message on successful making, editing and deleting application
            if (isset($_GET["msg"])) {
            if ($_GET["msg"] == "success") {
                echo "<div class='alert alert-success alert-dismissible'>
            <h4><i class='icon fa fa-check'></i> Your application has been submitted successfully!</h4>You can click on the status to view, edit or cancel this application.
            </div>";
                }
            elseif ($_GET["msg"] == "cancelled") {
               echo "<div class='alert alert-success alert-dismissible'>
            <h4><i class='icon fa fa-check'></i> Your application has been cancelled successfully!
            </div>";
            }
            elseif ($_GET["msg"] == "edited") {
               echo "<div class='alert alert-success alert-dismissible'>
            <h4><i class='icon fa fa-check'></i> Your application has been edited successfully!
            </div>";
            }
            }


            if (isset($_SESSION['logged_in']) && $_SESSION['user_id'] && $_SESSION['user_email'] && $_SESSION['logged_in'] == true) {
            ?>
                <a class="btn" id="appbtn" href="Application.php">
                    <h5><i class="fa fa-plus-circle" aria-hidden="true"></i> Make a new application</h5>
                </a>
                <p class="align-middle">
                <h4>Application History</h4>Click on the status to view, edit or cancel pending application.</p>
                <div class="table-responsive">
                    <table id="historyrecord" class="table table-bordered table-striped table-sm "cellspacing="0">
                        <thead >
                            <tr>
                                <th>No.</th>
                                <th>Application Date and Time</th>
                                <th>Application No.</th>
                                <th>Stay From</th>
                                <th>To</th>
                                <th>Status</th>
                            </tr>
                        <tbody>
                           <?php 
                            //to retrive basic information of application history
                            include_once('../database.php');
                            $ID=$_SESSION['user_id'];
                            $sql="SELECT `applicationNo`,`date`,`from`,`to`,`reason`,`status` FROM `accomodationapplicationtable` WHERE (`ID`='$ID') ORDER BY `applicationNo` DESC";
                            $applicationhistory=$pdo->prepare($sql);
                            $applicationhistory->execute();
                            $count=1;
                            foreach ($applicationhistory as $app) {
                                echo "<tr><td>".$count++."</td>
                                <td>".$app['date']."</td>
                                <td>".$app['applicationNo']."</td>
                                <td>".$app['from']."</td>
                                <td>".$app['to']."</td>";
                                //different colour of status button
                                if($app['status']=="Pending"){
                                    echo "<td><div class='text-center '><button id='modalbtn' class='btn btn-sm btn-block btn-outline-primary' onclick='showDetails(this.value)'  value='".$app['applicationNo']."'>".$app['status']."</button></td></tr>";}
                                elseif ($app['status']=="Approved") {
                                    echo "<td><div class='text-center '><button id='modalbtn' class='btn btn-sm btn-block btn-outline-success' onclick='showDetails(this.value)'value='".$app['applicationNo']."'>".$app['status']."</button></td></tr>";
                                }
                                else {
                                    echo "<td><div class='text-center '><button id='modalbtn' class='btn btn-sm btn-block btn-outline-danger' onclick='showDetails(this.value)'' value='".$app['applicationNo']."'>".$app['status']."</button></td></tr>";
                                }
                            }
                            if($count==1){
                                //if there is no history application record
                                echo '
                                    <tr>
                                        <td colspan="7"><div class="text-center">No History Record</div></td>
                                    </tr>';

                            }
                            ?>

                        </tbody>
                        
                    </table>

                </div>
                <!-- Inner HTML processed by processDetails.php, this modal with no details will only show when db connection error -->
                <div class="modal fade" aria-hidden="true" id="detailsModal" role="dialog" >
                   <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content ">

                            <div class="modal-header text-center " style="background-color: #F8F9FA;">
                                <h4 class="modal-title w-100">Application Details</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            
                            <div id="details" class="modal-body">
                                <p id="application_details" >Application Number:
                                    <p style="font-weight: normal;"></p>
                                </p>
                                <p id="application_details">Application Date and Time:
                                    <p style="font-weight: normal;"></p>
                                <p id="application_details">Stay From:
                                    <p style="font-weight: normal;"></p> 
                                </p>
                                <p id="application_details">To:
                                    <p style="font-weight: normal;"></p>
                                </p>
                                <p id="application_details">Reason:
                                    <p style="font-weight: normal;"></p> 
                                </p>
                                <p id="application_details">Status:
                                    <p style="font-weight: normal;"></p>
                                </p>
                                </div>
                                    <div class="modal-footer">
                                                <p align="right">
                                            <form action="editApplication.php" method="post">
                                                <button name="editAppNo" class="btn btn-primary" value="">Edit</button>
                                            </form>
                                            
                                                <button class="btn btn-danger" data-toggle="modal" data-target="#cancelModal" value="">Cancel Application</button>
                                            
                                         </p>
                            </div>

                        </div>
                    </div>
                    <div class="modal fade" id="cancelModal" tabindex="-1"   >
                        <div class="modal-dialog modal-dialog-centered" >
                            <div class="modal-content">

                                <div class="modal-header text-center " style="background-color: #FF695E;">
                                    <h4 class="modal-title w-100">Cancel Application Comfirmation</h4>
                                    
                                </div>
                                
                                <div  class="modal-body text-center">
                                   Are you sure you want to cancel this application?
                                   <br>
                                   <br>
                                </div>
                                <div class="modal-footer">
                                    <p align="right">
                                        <form method="post" action="processCancel.php">
                                        <button class="btn btn-danger" name="cancelAppNo" value="">Yes</button>
                                        </form>
                                        <button data-dismiss="modal" class="btn btn-outline-danger" >No</button>
                                    </p>
                                </div>

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
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
    <!-- pagination and client-database -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://kit.fontawesome.com/5b8eaee5c3.js" crossorigin="anonymous"></script>

    <script type="text/javascript">
        //Pagination
        $(document).ready(function() {
            $('#historyrecord').DataTable();
        } );
        //retrive application details modal from processDetails.php
        function showDetails(str) {
          if (str=="") {
            document.getElementById("detailsModal").innerHTML="";
            return;
          }
          var xmlhttp=new XMLHttpRequest();
          xmlhttp.onreadystatechange=function() {
            if (this.readyState==4 && this.status==200) {
              document.getElementById("detailsModal").innerHTML=this.responseText;
              $("#detailsModal").modal("show");
             }
          }
          xmlhttp.open("GET","processDetails.php?appNo="+str,true);
          xmlhttp.send();     
        }
    </script>
</body>
</html>
