<?php 

session_start();

//check if user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: logout.php");
}

//check if user is already played
if ($_SESSION['played'] == 0) {
    header("Location: logout.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="template.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap" rel="stylesheet">
    <link href="/lib/fontawesome/css/fontawesome.css" rel="stylesheet">
    <link href="/lib/fontawesome/css/brands.css" rel="stylesheet">
    <link href="/lib/fontawesome/css/solid.css" rel="stylesheet">

    <script src="lib/jquery.js"></script>
    <script src="lib/sweetalert.js"></script>
    <script src="lib/bootstrap/js/bootstrap.js"></script>
    <?php require('lib/main.php') ?>
</head>

<body>
    <div class="login-card-container">
        <div class="login-card">
            <div class="login-card-header">
                <h1>ผลการเล่น</h1>
                <div></div>
            </div>
            <div class="login-card-form" id="form" style="align-items:center; justify-content: center; width:100%;" >
                <div>
                ห้อง: <?php echo($_SESSION['class'] . "/" . $_SESSION['room']); ?><br>
                จำนวนข้อทั้งหมด: <?php echo($_SESSION['correct']+$_SESSION['wrong'])?><br>
                ตอบถูก: <?php echo($_SESSION['correct']) ?><br>
                ตอบผิด: <?php echo($_SESSION['wrong'])?><br>
                <br>
                <br>
                สามารถไปรับรางวัลได้ที่ซุ้มประเทศ Brazil
                </div>  
            </div>
        </div>
    </div>
</body>
</html>