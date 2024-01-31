<?php
$correctFlag = '0xKIMOZ{GDSC_BENHA_SQLI}';

if (isset($_POST['flag'])) {
    $userFlag = $_POST['flag'];

    if ($userFlag === $correctFlag) {
        echo "<h2>Congratulations! You have successfully completed the challenges.</h2>";
    } else {
        echo "<h2>Incorrect flag. Please try again.</h2>";
    }
}
?>