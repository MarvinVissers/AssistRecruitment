<?php
require '../datalayer/AxisDatabase.php';

$AD = new AxisDatabase();

if (isset($_POST['AxisName'])){

    $AxisName = $_POST['AxisName'];


    $AD->AxesOpslaan($AxisName);
    echo "Succes";

}else echo "failed";

?>
