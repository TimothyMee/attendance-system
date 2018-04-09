<?php
/**
 * Created by PhpStorm.
 * User: Timothy Fadayini
 * Date: 2/18/2018
 * Time: 8:07 AM
 */

    include 'include/DB.php';
    include 'include/head.php';
    include 'include/queries.php';

    $queriesObject = new queries();

    if (isset($_GET['user_id']) && !empty($_GET['user_id'])) {
        ?>

        <div class="col-md-4 col-md-offset-4 panel panel-body panel-primary" style="margin-top:20%;">
            <form action="" method="Post" class="form-group">
                <input type="text" placeholder="Confirmation Code" class="form-control" name="confirmationCode"><br>
                <input type="submit" class="btn btn-success" value="Confirm Code" name="confirmCode">
            </form>
        </div>
<?php
        if (isset($_POST['confirmCode'])){
            $code = $_POST['confirmationCode'];
            $user_id = $_GET['user_id'];

            $data  = [
              'code' => $code,
              'user_id' => $user_id
            ];

            $result = $queriesObject->confirmCode($data);

            if ($result){
                session_start();

                $_SESSION['user'] = $user_id;
                header("Location:home.php?action=index");
            }
            else{
                echo "<script>alert('Code has expired or is wrong.. Try to login again');</script>";
            }
        }
    }
?>
