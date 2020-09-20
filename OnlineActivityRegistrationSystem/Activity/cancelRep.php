<?php
//cancel report
session_start();
include_once('../database.php');
if(isset($_SESSION['logged_in']) && $_SESSION['user_id'] 
&& $_SESSION['user_email'] && $_SESSION['logged_in'] == true){
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['cancelRep'])){
            $cancelRep = $_POST['cancelRep'];
            
            $sql = "DELETE FROM `report_table`
        WHERE (`reportno`='$cancelRep')";
            
            try{
            $insertValue = $pdo->prepare($sql);
            $insertValue -> execute();
            header("Location:../Activity/reportStatus.php?msg=cancelled");
            

            }catch (Exception $e){
                echo "Error: " . $e;
            }
        }
    }
}

?>