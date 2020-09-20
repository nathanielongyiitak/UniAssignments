<?php
session_start();
include_once('../database.php');
if(isset($_SESSION['logged_in']) && $_SESSION['user_id'] 
&& $_SESSION['user_email'] && $_SESSION['logged_in'] == true){
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        $ID = $_SESSION['user_id'];
        if(isset($_POST['daterange'])&& isset($_POST['reason']) ){
            $today = date('Y-m-d H:i:s');
            $daterange = $_POST['daterange'];
            $date = explode(" - ", $daterange);
            $reason = $_POST['reason'];
            $status="Pending";
            $sql = "INSERT INTO `accomodationapplicationtable` (`date`,`ID` ,`from`, `to`, `reason`,`status`) 
        VALUES ('$today','$ID', '$date[0]', '$date[1]', '$reason','$status')";
            
            try{
            $insertValue = $pdo->prepare($sql);
            $insertValue -> execute();
            header("Location:../Activity/sembreak.php?msg=success");
            

            }catch (Exception $e){
                echo "Error: " . $e;
            }
        }
    }
}

?>