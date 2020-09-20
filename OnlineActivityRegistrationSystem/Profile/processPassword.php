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
        if(isset($_POST['password']) && isset($_POST['newpassword'])
        && isset($_POST['repeatpassword']) ){

            //set all the data posted from form and define a variable
            $Password = $_POST['password'];
            $newPassword = $_POST['newpassword'];

            //select password from `user` matching $ID with `ID`
            $passwordCheck = "SELECT * FROM `user` WHERE `ID`='$ID'";
            $stmt = $pdo->prepare($passwordCheck);
            $stmt->execute();
            while ($row = $stmt->fetch()) {
                $hashPassword = $row['Password'];
            }
            $verify = validatePassword($Password,$hashPassword);
            if($verify == true){
                $salt = "roA&h2u!PoaWr2u";
                $hash = hash("sha256", $newPassword . $salt);
                //update the new password by hashing it and insert it matching $ID with `ID`
                $sql = "UPDATE `user` SET `Password`='$hash' WHERE `ID`='$ID'";

                try{
                    $stmt = $pdo->prepare($sql);
                    $stmt -> execute();
                    //navigate to changePasswprd.php with action telling data successfully updated into database
                    header("Location:../Profile/changePassword.php?action=passwordChanged");
                }catch (Exception $e){
                    //echo the error if failed to update data into database
                    echo "Error: " . $e;
                }
            }else{
                //navigate to changePassword.php with action telling failed to update into database
                header("Location:../Profile/changePassword.php?action=invalidPassword");
            }
            $pdo = null;

        }
//}
}
}
//function to validate the password from databse and from post method
function validatePassword($Password, $hashPassword){
    $salt = "roA&h2u!PoaWr2u";

    $password = hash("sha256", $Password . $salt);

    if ($password == $hashPassword) {
        return true;
    } else {
        return false;
    }
}
?>