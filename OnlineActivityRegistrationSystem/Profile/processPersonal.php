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
        if(isset($_POST['Name']) && isset($_POST['NewMatrics']) ){

            //set all the data posted from form and define a variable
            $image = $_FILES["ProfilePicture"]["tmp_name"];
            $imgContent = addslashes(file_get_contents($image));
            $Name = $_POST['Name'];
            $NewMatrics = $_POST['NewMatrics'];
            $IC = $_POST['IC'];
            $Nationality = $_POST['Nationality'];
            $Gender = $_POST['Gender'];
            $Birthday = $_POST['Birthday'];
            $Race = $_POST['Race'];
            $Religion = $_POST['Religion'];
            $Marital = $_POST['Marital'];

            //update all data in database by matching the $ID with `ID`
            $sql = "UPDATE `personaltable` SET `ProfilePicture`='$imgContent', 
            `IC`='$IC', `Nationality`='$Nationality', 
            `Gender`='$Gender', `Birthday`='$Birthday', 
            `Race`='$Race', `Religion`='$Religion', 
            `Marital`='$Marital', `NewMatrics`='$NewMatrics' 
            WHERE `ID`='$ID'";
            $sql1 = "UPDATE `user` SET `Name`='$Name' WHERE `ID`='$ID'";

            try{
            $updateValue = $pdo->prepare($sql);
            $updateValue1 = $pdo->prepare($sql1);
            $updateValue -> execute();
            $updateValue1 -> execute();
            //navigate to updatePersonal.php with action telling data successfully updated into database
            header("Location:../Profile/updatePersonal.php?action=updatePersonalSuccessful");
            

            }catch (Exception $e){
                //echo the error if failed to update data into database
                echo "Error: " . $e;
            }
        }
//}
}
}
?>