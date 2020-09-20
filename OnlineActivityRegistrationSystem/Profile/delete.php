<?php
//start a session and include database
session_start();
include_once '../database.php';

//check if user is logged in or not ($_SESSION has value)
if(isset($_SESSION['logged_in']) && $_SESSION['user_id'] 
&& $_SESSION['user_email'] && $_SESSION['logged_in'] == true){
    //check if the form is post method
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        //set user_id in session to $id
        $ID = $_SESSION['user_id'];

        //select and delete all the row that match the $ID with `ID`
        $sql0 = "DELETE FROM `user` WHERE `ID`='$ID'";
        $sql1 = "DELETE FROM `academictable` WHERE `ID`='$ID'";
        $sql2 = "DELETE FROM `contacttable` WHERE `ID`='$ID'";
        $sql3 = "DELETE FROM `personaltable` WHERE `ID`='$ID'";
        try{
            $stmt0 = $pdo->prepare($sql0);
            $stmt1 = $pdo->prepare($sql1);
            $stmt2 = $pdo->prepare($sql2);
            $stmt3 = $pdo->prepare($sql3);

            $stmt0->execute();
            $stmt1->execute();
            $stmt2->execute();
            $stmt3->execute();
            //navigate to deletedAccount.php
            header('Location:deletedAccount.php');   
        } catch (Exception $e) {
            //echo the error if failed to update data into database
            echo "Error: " . $e;
        }
    }
}
?>