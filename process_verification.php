<?php

if (isset($_POST['VerPas']) && !empty($_POST['VerPas'])) {

    include 'include/DB.php';
    include 'include/queries.php';

    $queriesObject = new queries();

    $data = explode(";", $_POST['VerPas']);
    $user_id = $data[0];
    $vStamp = $data[1];
    $time = $data[2];
    $sn = $data[3];
    $base_path = 'http://localhost/myWork/fingerprintSample/code/';

    $fingerData = $queriesObject->getUserFinger($user_id);
    $device = $queriesObject->getDeviceBySn($sn);

    $data = $queriesObject->selectUser($user_id);
    $user_name = $data['user_name'];

    $salt = md5($sn . $fingerData[0]['finger_data'] . $device[0]['vc'] . $time . $user_id . $device[0]['vkey']);

    if (strtoupper($vStamp) == strtoupper($salt)) {

        $log = $queriesObject->createLog($user_name, $time, $sn);
    }
}

?>

<!--<script type="text/javascript">

    $('title').html('Message');
/*    user_name = $('#user_name').val();
    time = $('#time').val();*/
    load('http://localhost/myWork/fingerprintSample/code/messages.php?user_name=Timothy&time=14.02.00');

</script>-->
