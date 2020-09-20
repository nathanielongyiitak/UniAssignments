<?php
session_start();
include_once('../database.php');
if(isset($_SESSION['logged_in']) && $_SESSION['user_id'] 
&& $_SESSION['user_email'] && $_SESSION['logged_in'] == true){
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['daterange'])&& isset($_POST['reason'])&&isset($_POST['saveEdit']) ){
            $editAppNo = $_POST['saveEdit'];
            $daterange = $_POST['daterange'];
            $date = explode(" - ", $daterange);
            $reason = $_POST['reason'];
            $sql = "UPDATE `accomodationapplicationtable` SET `from`='$date[0]', `to`='$date[1]', `reason`='$reason'
        WHERE `applicationNo` = '$editAppNo'";
            
            try{
            $insertValue = $pdo->prepare($sql);
            $insertValue -> execute();
            header("Location:../Activity/sembreak.php?msg=edited");
            

            }catch (Exception $e){
                echo "Error: " . $e;
            }
        }
    }
}

?>