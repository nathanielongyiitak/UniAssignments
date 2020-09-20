<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php
session_start();
include_once('../database.php');
if(isset($_SESSION['logged_in']) && $_SESSION['user_id'] 
&& $_SESSION['user_email'] && $_SESSION['logged_in'] == true){
    if ($_SERVER['REQUEST_METHOD'] === 'GET'){
        $appNo = intval($_GET['appNo']);
        $_SESSION["selectedAppNo"] = $appNo;;
        $sql = "SELECT * FROM `accomodationapplicationtable` WHERE (`applicationNo`='$appNo')";
            try{
            $select = $pdo->prepare($sql);
            $select -> execute();
            $details=$select->fetch(PDO::FETCH_ASSOC);
            //echo the innerHTML of detailsModal in sembreak.php
            echo 
            '   <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content ">
                            <div class="modal-header text-center " style="background-color: #F8F9FA;">
                                <h4 class="modal-title w-100">Application Details</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <div id="details" class="modal-body">
                                <p id="application_details" >Application Number:
                                    <p style="font-weight: normal;">'.$details['applicationNo'].'</p>
                                </p>
                                <p id="application_details">Application Date and Time:
                                    <p style="font-weight: normal;">'.$details['date'].'</p>
                                <p id="application_details">Stay From:
                                    <p style="font-weight: normal;">'.$details['from'].'</p> 
                                </p>
                                <p id="application_details">To:
                                    <p style="font-weight: normal;">'.$details['to'].'</p>
                                </p>
                                <p id="application_details">Reason:
                                    <p style="font-weight: normal;word-break: break-all;">'.$details['reason'].'</p> 
                                </p>
                                <p id="application_details">Status:
                                    <p style="font-weight: normal;">'.$details['status'].'</p>
                                </p>
                                </div>
                                    <div class="modal-footer">';
                                    
                                            if ($details["status"]=="Pending") {
                                                echo'
                                                <p align="right">
                                            <form action="editApplication.php" method="post">
                                                <button name="editAppNo" class="btn btn-primary" value="'.$appNo.'">Edit</button>
                                            </form>
                                            
                                                <button class="btn btn-danger" data-toggle="modal" data-target="#cancelModal" value="'.$appNo.'">Cancel Application</button>
                                            
                                         </p>';                                                                           
                              echo '      
                            </div>

                        </div>
                    </div>
                    <div class="modal fade" id="cancelModal" tabindex="-1"   >
                        <div class="modal-dialog modal-dialog-centered" >
                            <div class="modal-content">

                                <div class="modal-header text-center " style="background-color: #FF695E;">
                                    <h4 class="modal-title w-100">Cancel Application Comformation</h4>
                                    
                                </div>
                                
                                <div  class="modal-body text-center">
                                   Are you sure you want to cancel this application?
                                   <br>
                                   <br>
                                </div>
                                <div class="modal-footer">
                                    <p align="right">
                                        <form method="post" action="processCancel.php">
                                        <button class="btn btn-danger" name="cancelAppNo" value="'.$appNo.'">Yes</button>
                                        </form>
                                        <button data-dismiss="modal" class="btn btn-outline-danger" >No</button>
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div> 
                    ';}
             }catch (Exception $e){
                echo "Error: " . $e;
        }
    }
}
?>
</body>
</html>
