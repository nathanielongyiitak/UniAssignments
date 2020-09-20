<?php
//save Edited report
session_start();
include_once('../database.php');
if(isset($_SESSION['logged_in']) && $_SESSION['user_id'] 
&& $_SESSION['user_email'] && $_SESSION['logged_in'] == true){
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        if( isset($_POST['location'])&& isset($_POST['title'])
        && isset($_POST['type'] )&&isset($_POST['saveEdit'])){
            $editNum = $_POST['saveEdit'];
           
            $location =$_POST['location'];
            $title =$_POST['title'];
            $type =$_POST['type'];
            $description = $_POST['description'];
            $sql = "UPDATE `report_table` SET  `Location`='$location', `Title`='$title',`Type`='$type', `Description`='$description'
        WHERE `reportno` = '$editNum'";
            
            try{
            $insert = $pdo->prepare($sql);
            $insert -> execute();
            header("Location:../Activity/reportStatus.php?msg=edited");
            

            }catch (Exception $e){
                echo "Error: " . $e;
            }
        }
    }
}

?>