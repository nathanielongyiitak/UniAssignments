<!DOCTYPE html>
<html>

<head>
    <style>
        table, td, th {
            text-align: center;
        }
    </style>
    <meta charset="utf-8">

    <link rel="stylesheet" href="../css/style.css">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link rel="icon" href="../imgs/8th.png" type="image/icon type">
    <title>History</title>
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
                    <li class="nav-item active">
                        <a class="nav-link" href="Activity.php">Activity</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="Sembreak.php">Accommodation Application</a>
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
        <main class="jumbotron mt-2">
            <?php
            session_start();
            include_once('../database.php');
            if (isset($_SESSION['logged_in']) && $_SESSION['user_id'] && $_SESSION['user_email'] && $_SESSION['logged_in'] == true) {
            ?>
                <div class="col-25">
                    <div class="container">
                        <b><h2>Activities Registered</h2></b><br><br>
   						<table class="table table-bordered">                   
                    <tr style="background-color: #F8F8FF">
                    	<th>Year</th>
                    	<th>Semester</th>
                    	<th>Activity 1</th>
                    	<th>Activity 2</th>
                    	<th>Activity 3</th>
                    </tr>
                       <?php
							$ID = $_SESSION['user_id'];
                                     //retrieve data from database
                                     $display = "SELECT * FROM activitytable WHERE id='$ID'";
                                     $stmt = $pdo->prepare($display);
               						 $stmt -> execute(); 
									 //check if id exist in database
							 		 $checkID = "SELECT `ID` FROM activitytable WHERE id='$ID'";
							 		 $re = $pdo->prepare($checkID);
							 		 $re -> execute();
							 		 $check = $re->fetch(PDO::FETCH_ASSOC);
		    					//if yes, retrieve data
							if($check){
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
								$Year = $row["Year"];
        						$Semester = $row["Semester"];
        						$Activity1 = $row["Activity 1"];
        						$Activity2 = $row["Activity 2"];
        						$Activity3 = $row["Activity 3"]; 
              				
        						echo "<td>".$Year."</td>";
                    			echo "<td>".$Semester."</td>";
								echo "<td>".$Activity1."</td>";
								echo "<td>".$Activity2."</td>";
								echo "<td>".$Activity3."</td>";
                    			echo "</tr>";    
                    		}
                    		}
                    		else{

                    			echo "<td>-</td>";
                    			echo "<td>-</td>";
								echo "<td>-</td>";
								echo "<td>-</td>";
								echo "<td>-</td>";
                    			echo "</tr>";  
                    			echo "<b><h5>You have not registered any activity yet.</h5></b>";  
                    		}	             
        					
        				
        				?>
        		
                     </table>	



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
</body>

</html>
