<?php 

session_start();
//include("Users/Nuthaphon/xampp2/htdocs/settings.php");
require("../settings.php");
require("../database.php");

if (base64_decode($_POST['answer']) == $_POST['selected']) {
    if (!in_array($_POST['id'], $_SESSION['answered'])) {
        array_push($_SESSION['answered'], $_POST['id']);
    }
    $redirect = generatenonDuplicate(false);
    if ($redirect == 2147483647) {
        $sql = "UPDATE international SET played = $maxquestions, correct = ".($_SESSION['correct']+1).", wrong = ".$_SESSION['wrong']." WHERE id = ".$_SESSION['id'];
        $que = mysqli_query($con, $sql);
    }
    $_SESSION['correct'] += 1;
    echo "S".$redirect;
} else {
    $_SESSION['wrong'] += 1;
    echo generatenonDuplicate(true);
}

function generatenonDuplicate($allowsame) {
    global $maxquestion;
    global $maxquestions;
    $result = rand(1, $maxquestion);
    if (sizeof($_SESSION['answered']) >= $maxquestions || sizeof(['answered']) >= $maxquestions) {
        if ($allowsame) {
            return $_POST['id'];
        }
        return 2147483647;
    } else {
        while (in_array($result, $_SESSION['answered'])) {
            $result = rand(1, $maxquestion);
        }
        return $result;
    }
    
}

?>