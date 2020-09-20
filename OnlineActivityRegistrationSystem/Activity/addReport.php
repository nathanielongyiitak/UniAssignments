<?php
//make a new report
session_start();
include_once('../database.php');
if(isset($_SESSION['logged_in']) && $_SESSION['user_id'] 
&& $_SESSION['user_email'] && $_SESSION['logged_in'] == true){
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        $ID = $_SESSION['user_id'];
        if( isset($_POST['location'])&& isset($_POST['title']) && isset($_POST['type'])&& isset($_POST['description'])){
         
            $location =$_POST["location"];
            $title =$_POST["title"];
            $type =$_POST["type"];
            $description = $_POST["description"];
            $status= "Pending";
            $sql = "INSERT INTO `report_table` (`ID`,`Location` ,`Title`, `Type`, `Description`,`status`) 
        VALUES ('$ID','$location', '$title', '$type', '$description','$status')";
            
            try{
            $insert = $pdo->prepare($sql);
            $insert -> execute();
            header("Location:../Activity/reportStatus.php?msg=success");
            

            }catch (Exception $e){
                echo "Error: " . $e;
            }
        }
    }
}

?>