<html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" />
    <script src="https://kit.fontawesome.com/5b8eaee5c3.js" crossorigin="anonymous"></script>
</head>

<body>
</body>

</html>

<?php
session_start();
include_once('../database.php');

if(isset($_SESSION['logged_in']) && $_SESSION['user_id'] 
&& $_SESSION['user_email'] && $_SESSION['logged_in'] == true){
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        $ID = $_SESSION['user_id'];
        if(isset($_POST['Year']) && isset($_POST['Sem']) && isset($_POST['a1']) && isset($_POST['a2']) && 
        isset($_POST['a3'])) {

            $Year = $_POST['Year'];
            $Sem = $_POST['Sem'];
            $Activity1 = $_POST['a1'];
            $Activity2 = $_POST['a2'];
            $Activity3 = $_POST['a3'];

            
            if($Year>0 && $Year<7 && $Sem>0 && $Sem<3){
              //if no activity
              if($Activity1=='-' && $Activity2=='-' && $Activity3=='-'){
              echo "<div class='alert alert-danger alert-dismissible'>
                <h4><i class='icon fa fa-exclamation-circle'> Please enter the activity!</i></h4>
                <a href='register.php'>Register</a> again or <a href='Activity.php'>Cancel</a> registration.
                </div>";
                exit("You have not entered any activity to register, please check again!");
              }

              //if one activity(Activity 1)
              else if($Activity2=='-' && $Activity3=='-'){
               $sql = "INSERT INTO `activitytable` (`ID`, `Year`, `Semester`, `Activity 1`, `Activity 2`, `Activity 3`) VALUES ('$ID', '$Year', '$Sem','$Activity1', '$Activity2', '$Activity3')";

               try{
               $add = $pdo->prepare($sql);
               $add -> execute();
               echo "<div class='alert alert-success alert-dismissible'>
               <h4><i class='icon fa fa-check'></i> You registered successfully!</h4> Click to view
               <a href='history.php'>Registration History</a> or back to <a href='Activity.php'>Activity page.</a>
               </div>";
               }catch (Exception $e){
                echo "<div class='alert alert-danger alert-dismissible'>
                <h4><i class='icon fa fa-exclamation-circle'> You have registered before!</i></h4>
                <a href='register.php'>Register</a> again or <a href='Activity.php'>Cancel</a> registration.
                </div>";
                exit("You have registered in this year and sem, please "."<a href='history.php'>check</a>"." your history.");
                }
              }
              //if one activity(Activity 2 will be entered to Activity 1 column)
              else if($Activity1=='-' && $Activity3=='-'){
               $sql = "INSERT INTO `activitytable` (`ID`, `Year`, `Semester`, `Activity 1`, `Activity 2`, `Activity 3`) VALUES ('$ID', '$Year', '$Sem','$Activity2', '$Activity1', '$Activity3')";

               try{
               $add = $pdo->prepare($sql);
               $add -> execute();
               echo "<div class='alert alert-success alert-dismissible'>
               <h4><i class='icon fa fa-check'></i> You registered successfully!</h4> Click to view
               <a href='history.php'>Registration History</a> or back to <a href='Activity.php'>Activity page.</a>
               </div>";
               }catch (Exception $e){
                echo "<div class='alert alert-danger alert-dismissible'>
                <h4><i class='icon fa fa-exclamation-circle'> You have registered before!</i></h4>
                <a href='register.php'>Register</a> again or <a href='Activity.php'>Cancel</a> registration.
                </div>";
                exit("You have registered in this year and sem, please "."<a href='history.php'>check</a>"." your history.");
                }
              }

            //if one activity(Activity 3 will be entered to Activity 1 column)
              else if($Activity1=='-' && $Activity2=='-'){
               $sql = "INSERT INTO `activitytable` (`ID`, `Year`, `Semester`, `Activity 1`, `Activity 2`, `Activity 3`) VALUES ('$ID', '$Year', '$Sem','$Activity3', '$Activity1', '$Activity2')";

               try{
               $add = $pdo->prepare($sql);
               $add -> execute();
               echo "<div class='alert alert-success alert-dismissible'>
               <h4><i class='icon fa fa-check'></i> You registered successfully!</h4> Click to view
               <a href='history.php'>Registration History</a> or back to <a href='Activity.php'>Activity page.</a>
               </div>";
               }catch (Exception $e){
                echo "<div class='alert alert-danger alert-dismissible'>
                <h4><i class='icon fa fa-exclamation-circle'> You have registered before!</i></h4>
                <a href='register.php'>Register</a> again or <a href='Activity.php'>Cancel</a> registration.
                </div>";
                exit("You have registered in this year and sem, please "."<a href='history.php'>check</a>"." your history.");
                }
              }

            //if two activity(Activity 1,2)
              else if($Activity3=='-'){
              if($Activity1!=$Activity2){
               $sql = "INSERT INTO `activitytable` (`ID`, `Year`, `Semester`, `Activity 1`, `Activity 2`, `Activity 3`) VALUES ('$ID', '$Year', '$Sem','$Activity1', '$Activity2', '$Activity3')";
              }
              //if activity 1,2 are the same
              else{
                echo "<div class='alert alert-danger alert-dismissible'>
                <h4><i class='icon fa fa-exclamation-circle'> Invalid Information!</i></h4>
                <a href='register.php'>Register</a> again or <a href='Activity.php'>Cancel</a> registration.
                </div>";
                exit("You have entered duplicated activities, please check again!");
              }
               try{
               $add = $pdo->prepare($sql);
               $add -> execute();
               echo "<div class='alert alert-success alert-dismissible'>
               <h4><i class='icon fa fa-check'></i> You registered successfully!</h4> Click to view
               <a href='history.php'>Registration History</a> or back to <a href='Activity.php'>Activity page.</a>
               </div>";
               }catch (Exception $e){
                echo "<div class='alert alert-danger alert-dismissible'>
                <h4><i class='icon fa fa-exclamation-circle'> You have registered before!</i></h4>
                <a href='register.php'>Register</a> again or <a href='Activity.php'>Cancel</a> registration.
                </div>";
                exit("You have registered in this year and sem, please "."<a href='history.php'>check</a>"." your history.");
                }
              }


            //if two activity(Activity 2,3 will be entered into column Activity 1,2)
              else if($Activity1=='-'){
              if($Activity2!=$Activity3){
               $sql = "INSERT INTO `activitytable` (`ID`, `Year`, `Semester`, `Activity 1`, `Activity 2`, `Activity 3`) VALUES ('$ID', '$Year', '$Sem','$Activity2', '$Activity3', '$Activity1')";
              }
              //if activity 2,3 are the same
              else{
                echo "<div class='alert alert-danger alert-dismissible'>
                <h4><i class='icon fa fa-exclamation-circle'> Invalid Information!</i></h4>
                <a href='register.php'>Register</a> again or <a href='Activity.php'>Cancel</a> registration.
                </div>";
                exit("You have entered duplicated activities, please check again!");
              }
               try{
               $add = $pdo->prepare($sql);
               $add -> execute();
               echo "<div class='alert alert-success alert-dismissible'>
               <h4><i class='icon fa fa-check'></i> You registered successfully!</h4> Click to view
               <a href='history.php'>Registration History</a> or back to <a href='Activity.php'>Activity page.</a>
               </div>";
               }catch (Exception $e){
                echo "<div class='alert alert-danger alert-dismissible'>
                <h4><i class='icon fa fa-exclamation-circle'> You have registered before!</i></h4>
                <a href='register.php'>Register</a> again or <a href='Activity.php'>Cancel</a> registration.
                </div>";
                exit("You have registered in this year and sem, please "."<a href='history.php'>check</a>"." your history.");
                }
              }


            //if two activity(Activity 1,3 will be entered to Activity 1,2 column)
              else if($Activity2=='-'){
              if($Activity1!=$Activity3){
               $sql = "INSERT INTO `activitytable` (`ID`, `Year`, `Semester`, `Activity 1`, `Activity 2`, `Activity 3`) VALUES ('$ID', '$Year', '$Sem','$Activity1', '$Activity3', '$Activity2')";
              }
              //if activity 1,3 are the same
              else{
                echo "<div class='alert alert-danger alert-dismissible'>
                <h4><i class='icon fa fa-exclamation-circle'> Invalid Information!</i></h4>
                <a href='register.php'>Register</a> again or <a href='Activity.php'>Cancel</a> registration.
                </div>";
                exit("You have entered duplicated activities, please check again!");
              }

               try{
               $add = $pdo->prepare($sql);
               $add -> execute();
               echo "<div class='alert alert-success alert-dismissible'>
               <h4><i class='icon fa fa-check'></i> You registered successfully!</h4> Click to view
               <a href='history.php'>Registration History</a> or back to <a href='Activity.php'>Activity page.</a>
               </div>";
               }catch (Exception $e){
                echo "<div class='alert alert-danger alert-dismissible'>
                <h4><i class='icon fa fa-exclamation-circle'> You have registered before!</i></h4>
                <a href='register.php'>Register</a> again or <a href='Activity.php'>Cancel</a> registration.
                </div>";
                exit("You have registered in this year and sem, please "."<a href='history.php'>check</a>"." your history.");
                }
              }


            //if three activities
              else if ($Activity1!=$Activity2 && $Activity1!=$Activity3 && $Activity2!=$Activity3){
                $sql = "INSERT INTO `activitytable` (`ID`, `Year`, `Semester`, `Activity 1`, `Activity 2`, `Activity 3`) VALUES ('$ID', '$Year', '$Sem','$Activity1', '$Activity2', '$Activity3')";

              try{
              $add = $pdo->prepare($sql);
              $add -> execute();
              echo "<div class='alert alert-success alert-dismissible'>
              <h4><i class='icon fa fa-check'></i> You registered successfully!</h4> Click to view
              <a href='history.php'>Registration History</a> or back to <a href='Activity.php'>Activity page.</a>
              </div>";
              }catch (Exception $e){
                echo "<div class='alert alert-danger alert-dismissible'>
                <h4><i class='icon fa fa-exclamation-circle'> You have registered before!</i></h4>
                <a href='register.php'>Register</a> again or <a href='Activity.php'>Cancel</a> registration.
                </div>";
                exit("You have registered in this year and sem, please "."<a href='history.php'>check</a>"." your history.");
              }
            }

            //to make sure three activities are not duplicated
              else if ($Activity1==$Activity2 || $Activity1==$Activity3 || $Activity2==$Activity3){
                echo "<div class='alert alert-danger alert-dismissible'>
                <h4><i class='icon fa fa-exclamation-circle'> Invalid Information!</i></h4>
                <a href='register.php'>Register</a> again or <a href='Activity.php'>Cancel</a> registration.
                </div>";
                exit("You have entered duplicated activities, please check again!");  
            }   
        }
            //to make sure valid 'year' and 'semester'
            else{
            echo "<div class='alert alert-danger alert-dismissible'>
                <h4><i class='icon fa fa-exclamation-circle'> Invalid Information!</i></h4>
                <a href='register.php'>Register</a> again or <a href='Activity.php'>Cancel</a> registration.
            </div>";
            exit("You have entered invalid 'Year' or 'Semester', please check again!");  
    }         
}
}
}
?>
