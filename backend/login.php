<?php 
session_start();
require("../database.php");

if (isset($_POST['user']) || isset($_POST['class']) || isset($_POST['room'])) {
    $user = mysqli_real_escape_string($con, $_POST['user']);
    $class = mysqli_real_escape_string($con, $_POST['class']);
    $room = mysqli_real_escape_string($con, $_POST['room']);
    //echo "SELECT count(id) as count, id, played FROM international WHERE username = '$user' AND class = '$class' AND room = '$room'";
    $sql = "SELECT count(id) as count, id, played, correct, wrong FROM international WHERE username = '$user' AND class = '$class' AND room = '$room'";
    $que = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($que); 
    if ($row['count'] != 0) {
        $_SESSION['id'] = $row['id'];
        $_SESSION['user'] = $user;
        $_SESSION['class'] = $class;
        $_SESSION['room'] = $room;
        $_SESSION['correct'] = $row['correct'];
        $_SESSION['wrong'] = $row['wrong'];
        $_SESSION['played'] = $row['played'];
        $_SESSION['answered'] = array();
        if ($row['played'] == 0) {
            echo "S";
        } else {
            echo "R";
        }
    } else {
        echo "ไม่พบข้อมูลนักเรียน";
    }
} else {
    echo "มีบางอย่างผิดพลาด กรุณาลองอีกครั้ง";
}

?>