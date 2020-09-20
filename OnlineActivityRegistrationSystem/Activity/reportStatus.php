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
            <h2>Report an Issue</h2>
            <?php
            
            session_start();
            //get message
            if (isset($_GET["msg"])) {
                if ($_GET["msg"] == "success") {
                    echo "<div class='alert alert-success alert-dismissible'>
                <h4><i class='icon fa fa-check'></i> Your report has been submitted successfully!</h4>You can click on the status to view, edit or cancel this application.
                </div>";
                    }
                elseif ($_GET["msg"] == "cancelled") {
                   echo "<div class='alert alert-success alert-dismissible'>
                <h4><i class='icon fa fa-check'></i> Your report has been cancelled successfully!
                </div>";
                }
                elseif ($_GET["msg"] == "edited") {
                   echo "<div class='alert alert-success alert-dismissible'>
                <h4><i class='icon fa fa-check'></i> Your report has been edited successfully!
                </div>";
                }
                }

            if (isset($_SESSION['logged_in']) && $_SESSION['user_id'] && $_SESSION['user_email'] && $_SESSION['logged_in'] == true) {
            ?>

                <a class="btn" id="appbtn1" href="report.php">
                    <h5><img class="mb-1" src="../imgs/caution.png" height="20" width="20">Make a new report</h5>
                </a>

                <h4>Report History</h4>

                <div class="table-responsive">
                    <table id="history" class="table table-bordered ">
                        <thead>
                            <tr>
                                <th>No.</th>
                                
                                <th>Location</th>

                                <th>Issue title</th>
                                <th>Issue type</th>
                                
                                <th>Status</th>
                            </tr>
                        <tbody>
                        <?php 
                            include_once('../database.php');
                            $ID=$_SESSION['user_id'];
                            $sql="SELECT `reportno`,`Location`,`Title`,`Type`,`status` FROM `report_table` WHERE (`ID`='$ID') ORDER BY `reportno` ASC";
                            $reporthistory=$pdo->prepare($sql);
                            $reporthistory->execute();
                            $count=1;
                            foreach ($reporthistory as $rep) {
                                echo "<tr><td>".$count++."</td>
                                
                                
                                <td>".$rep['Location']."</td>
                                <td>".$rep['Title']."</td>
                                <td>".$rep['Type']."</td>";
                                if($rep['status']=="Pending"){
                                    echo "<td><div class='text-center '><button id='modalbtn' class='btn btn-sm btn-block btn-outline-primary' onclick='showDetails(this.value)'  value='".$rep['reportno']."'>".$rep['status']."</button></td></tr>";}
                                elseif ($rep['status']=="Completed") {
                                    echo "<td><div class='text-center '><button id='modalbtn' class='btn btn-sm btn-block btn-outline-success' onclick='showDetails(this.value)'value='".$rep['reportno']."'>".$rep['status']."</button></td></tr>";
                                }
                                else {
                                    echo "<td><div class='text-center '><button id='modalbtn' class='btn btn-sm btn-block btn-outline-warning' onclick='showDetails(this.value)'' value='".$rep['reportno']."'>".$rep['status']."</button></td></tr>";
                                }
                            }
                            if($count==1){
                                echo '
                                    <tr>
                                        <td colspan="7"><div class="text-center">No History Record</div></td>
                                    </tr>';

                            }
                            ?>

                        </tbody>
                        
                    </table>

                </div>

                <div class="modal fade" aria-hidden="true" id="detailsModal" role="dialog" >
                   <!-- Modal insdie repDetails.php -->
                   <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content ">

                            <div class="modal-header text-center " style="background-color: #F8F9FA;">
                                <h4 class="modal-title w-100">Report Summary</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            
                            <div id="details" class="modal-body">
                                <p id="report_sum" >Report number:
                                    <p style="font-weight: normal;"></p>
                                </p>
                                
                                <p id="report_sum">Location:
                                    <p style="font-weight: normal;"></p> 
                                </p>
                                <p id="report_sum">Title:
                                    <p style="font-weight: normal;"></p>
                                </p>
                                <p id="report_sum">Type:
                                    <p style="font-weight: normal;"></p>
                                </p>
                                <p id="report_sum">Description:
                                    <p style="font-weight: normal;"></p> 
                                </p>
                                <p id="report_sum">Status:
                                    <p style="font-weight: normal;"></p>
                                </p>
                                </div>
                                    <div class="modal-footer">
                                                <p align="right">
                                            <form action="editReport.php" method="post">
                                                <button name="editNum" class="btn btn-primary" value="">Edit Report</button>
                                            </form>
                                            
                                                <button class="btn btn-danger" data-toggle="modal" data-target="#cancelModal" value="">Cancel Report</button>
                                            
                                         </p>
                            </div>

                        </div>
                    </div>
                    <div class="modal fade" id="cancelModal" tabindex="-1"   >
                        <div class="modal-dialog modal-dialog-centered" >
                            <div class="modal-content">

                                <div class="modal-header text-center " style="background-color: #FF695E;">
                                    <h4 class="modal-title w-100">Cancel Report Comfirmation</h4>
                                    
                                </div>
                                
                                <div  class="modal-body text-center">
                                   Are you sure you want to cancel this report?
                                   <br>
                                   <br>
                                </div>
                                <div class="modal-footer">
                                    <p align="right">
                                        <form method="post" action="cancelRep.php">
                                        <button class="btn btn-danger" name="cancelRep" value="">Yes</button>
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
    </div>




    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>


<!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
    <!-- pagination and client-database -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://kit.fontawesome.com/5b8eaee5c3.js" crossorigin="anonymous"></script>


    


    <script type="text/javascript">
        $(document).ready(function() {
            $('#history').DataTable();
        } );


        
        //retrieve from repDetails
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
          xmlhttp.open("GET","repDetails.php?repNo="+str,true);
          xmlhttp.send();
       
            
        }
    </script>
</body>

</html>