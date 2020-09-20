<?php
session_start();
include_once('../database.php');
if(isset($_SESSION['logged_in']) && $_SESSION['user_id'] 
&& $_SESSION['user_email'] && $_SESSION['logged_in'] == true){
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['cancelAppNo'])){
            $cancelAppNo = $_POST['cancelAppNo'];
            
            $sql = "DELETE FROM `accomodationapplicationtable`
        WHERE (`applicationNo`='$cancelAppNo')";
            
            try{
            $insertValue = $pdo->prepare($sql);
            $insertValue -> execute();
            header("Location:../Activity/sembreak.php?msg=cancelled");
            

            }catch (Exception $e){
                echo "Error: " . $e;
            }
        }
    }
}

?>