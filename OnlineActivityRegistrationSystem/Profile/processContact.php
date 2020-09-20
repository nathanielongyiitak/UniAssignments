<?php
//start a session and include database
session_start();
include_once('../database.php');

//check if user is logged in or not ($_SESSION has value)
if(isset($_SESSION['logged_in']) && $_SESSION['user_id'] 
&& $_SESSION['user_email'] && $_SESSION['logged_in'] == true){
    //check if the form is post method
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        //set user_id in session to $id and user_email to $Email
        $ID = $_SESSION['user_id'];
        $Email = $_SESSION['user_email'];

            //set all the data posted from form and define a variable
            $Address = $_POST['Address'];
            $Postcode = $_POST['Postcode'];
            $City = $_POST['City'];
            $State = $_POST['State'];
            $Phone = $_POST['Phone'];

            //update all data in database by matching the $ID with `ID`
            $sql = "UPDATE `contacttable` SET `Address`='$Address', `Postcode`='$Postcode', 
            `City`='$City', `State`='$State', 
            `Phone`='$Phone' WHERE `ID`='$ID'";

            try{
            $updateValue = $pdo->prepare($sql);
            $updateValue -> execute();
            //navigate to updateContact.php with action telling data successfully updated into database
            header("Location:../Profile/updateContact.php?action=updateContactSuccessful");
            

            }catch (Exception $e){
                //echo the error if failed to update data into database
                echo "Error: " . $e;
            }
        //}
}
}
?>