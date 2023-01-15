<?php 

    require('settings.php');


session_start();
if (isset($_SESSION['user'])) {
    //echo(sizeof($_SESSION['answered']) . " " . $maxquestions);
    if (sizeof($_SESSION['answered']) >= $maxquestions || sizeof(['answered']) >= $maxquestions) {
        $result = 2147483647;
    } else {
        while (in_array($result, $_SESSION['answered'])) {
            $result = rand(1, $maxquestion);
        }
    }
    header("Location: question.php?question=".base64_encode($result));
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php require('lib/main.php') ?>
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
</head>

<body>

    <div class="login-card-container">
        <div class="login-card">
            <div class="login-card-header">
                <h1>กิจกรรมตอบคำถามประเทศ Brazil</h1>
                <div></div>
            </div>
            <form class="login-card-form" id="form">
                <div class="form-item">
                    <label class="form-text" style="font-size: calc(1rem * .8); padding-left: calc(1rem * 3.5);">(ป้องกันการตอบซ้ำ)</label>
                    <i class="fa-solid fa-address-book form-item-icon2 material-symbols-rounded"></i>
                    <input type="number" placeholder="เลขประจำตัวนักเรียน" id="user" style="font-family: 'Kanit', sans-serif;" autofocus>
                </div>
                <div class="form-item">
                    <i class="fa-solid fa-user form-item-icon material-symbols-rounded"></i>
                    <select class="form-select loginform" name="class" id="class" style="font-family: 'Kanit', sans-serif;">
                        <option value="" selected>เลือกระดับชั้น</option>
                        <?php 
                        for ($i = 1; $i <= 6; $i++) {
                            echo('<option value="'.$i.'">มัธยมศึกษาปีที่ '.$i.'</option>');
                        }             
                        ?>
                    </select>
                </div>
                <div class="form-item">
                    <i class="fa-brands fa-slack form-item-icon material-symbols-rounded"></i>
                    <select class="form-select loginform" name="class" id="room" style="font-family: 'Kanit', sans-serif;">
                        <option value="" selected>เลือกห้อง</option>
                        <?php 
                        for ($i = 1; $i <= 15; $i++) {
                            echo('<option value="'.$i.'">ห้อง '.$i.'</option>');
                        }             
                        ?>
                    </select>
                </div>
                <button type="button" onclick="login()" style="font-family: 'Kanit', sans-serif;">เข้าสู่กิจกรรม</button>
            </form>
        </div>
    </div>

</body>

</html>

<script>

    function getRandomInt(min, max) {
    min = Math.ceil(min);
    max = Math.floor(max);
    return Math.floor(Math.random() * (max - min + 1)) + min;
    }

    function login() {
        let user = $('#user').val();
        let clas = $('#class').val();
        let room = $('#room').val();

        if (user == "" || clas == "" || room == "") {
            swal({
                title: "ผิดพลาด",
                text: "กรุณากรอกข้อมูลให้ครบ!",
                icon: "error",
                button: "ปิด"
            });
        } else {
            $.ajax({
                url: "backend/login.php",
                type: "POST",
                data: {
                    user: user,
                    class: clas,
                    room: room
                },
                success: function(response) {
                    if (response == "S") {
                        swal({
                            title: "สำเร็จ",
                            text: "ระบบกำลังพาคุณไปยังหน้าตอบคำถาม",
                            icon: "success",
                            buttons: false,
                            closeOnEsc: false,
                            closeOnClickOutside: false,
                            timer: 2500,
                        }).then(something => {
                            window.location.href = "question.php?question="+btoa(getRandomInt(1, <?= $maxquestion ?>));
                        });
                    } else if (response == "R") {
                        swal({
                            title: "ผิดพลาด",
                            text: "คุณได้เล่นเกมนี้ไปแล้ว. ระบบจะพาคุณไปหน้าสรุปผล",
                            icon: "error",
                            button: "ปิด"
                        }).then(something => {
                            window.location.href = "result.php";
                        });
                    } else {
                        swal({
                            title: "ผิดพลาด",
                            text: response,
                            icon: "error",
                            button: "ปิด"
                        });
                    }
                }
            });
        }
    }
</script>