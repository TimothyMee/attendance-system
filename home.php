<?php
/**
 * Created by PhpStorm.
 * User: Paul Fadayini
 * Date: 2/18/2018
 * Time: 4:40 PM
 */

    include 'include/DB.php';
    include 'include/head.php';
    include 'include/queries.php';

    $queriesObject = new queries();
    session_start();
    if (isset($_SESSION['user'])){
        if (isset($_GET['action']) && $_GET['action'] == 'index') {
            $sessionID = $_SESSION['user'];
            $userData = $queriesObject->selectUser($sessionID);
            ?>

            <div class="col-md-10 col-md-offset-1 panel panel-primary" style="margin-top:10%;">
                <div class="panel-heading">
                    Welcome
                    <form action="" method="post" style="float:right;">
                        <input type="submit" class="btn btn-danger btn-sm" name="logout" value="LOGOUT!!!">
                    </form>
                </div>

                <div class="panel-body" >
                    Hi <?php echo $userData['user_name']?>, <br>
                    <h6>You Have successfully Logged in....</h6>
                </div>
            </div>
            <?php
        }
    }

    if(isset($_POST['logout'])){
        $_SESSION['user']= '';
        session_destroy();
        header("Location: index.php");
    }
?>
