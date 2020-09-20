<?php
//start a session and include database
session_start();
include_once('../database.php');

//check if user is logged in or not ($_SESSION has value)
if(isset($_SESSION['logged_in']) && $_SESSION['user_id'] 
&& $_SESSION['user_email'] && $_SESSION['logged_in'] == true){
    //check if the form is post method
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        //set user_id in session to $id
        $ID = $_SESSION['user_id'];

            //set all the data posted from form and define a variable 
            $Faculty = $_POST['Faculty'];
            $Course = $_POST['Course'];
            $EntryYear = $_POST['EntryYear'];
            $Duration = $_POST['Duration'];
            $Mode = $_POST['Mode'];

            //update all data in database by matching the $ID with `ID`
            $sql = "UPDATE `academictable` SET `Faculty`='$Faculty', `Course`='$Course', 
            `EntryYear`='$EntryYear', `Duration`='$Duration', 
            `Mode`='$Mode' WHERE `ID`='$ID'";

            try{
            $updateValue = $pdo->prepare($sql);
            $updateValue -> execute();
            //navigate to updateAcademic.php with action telling data successfully updated into database
            header("Location:../Profile/updateAcademic.php?action=updateAcademicSuccessful");
            

            }catch (Exception $e){
                //echo the error if failed to update data into database
                echo "Error: " . $e;
            }
        //}
}
}
?>