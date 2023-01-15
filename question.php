<?php

require('database.php');
require('settings.php');
session_start();

function checkDuplicate() {
    if (in_array(base64_decode($_GET['question']), $_SESSION['answered'])) {
        return true;
    } else {
        return false;
    }
}


if (!isset($_SESSION['user'])) {
    header("Location: logout.php");
} else { 
    if (isset($_GET['question'])) {
        $question = base64_decode($_GET['question']);
        if (false === $question) {
            header("Location: logout.php");
        } else {
            //echo "<script>alert('".$question."');</script>";
            if (checkDuplicate()) {
                if (isset($_GET['bypass'])) {
                    if ($_GET['bypass']) {
                    } else {
                        //echo(sizeof($_SESSION['answered']) . " " . $maxquestion);
                        if (sizeof($_SESSION['answered']) >= $maxquestions || sizeof(['answered']) >= $maxquestions) {
                            $result = 2147483647;
                        } else {
                            while (in_array($result, $_SESSION['answered'])) {
                                $result = rand(1, $maxquestion);
                            }
                        }
                        header("Location: question.php?question=".base64_encode($result));
                    }
                } else {
                    if (sizeof($_SESSION['answered']) >= $maxquestions || sizeof(['answered']) >= $maxquestions) {
                        $result = 2147483647;
                    } else {
                        while (in_array($result, $_SESSION['answered'])) {
                            $result = rand(1, $maxquestion);
                        }
                    }
                    header("Location: question.php?question=".base64_encode($result));
                }
            } else {
                switch ($question) {
                    case '1':
                        $type = "4-choice";
                        $q = "ข้อใดไม่ใช่แม่น้ำสายหลักในบราซิล";
                        $a1 = "แม่น้ำอะเมซอน";
                        $a2 = "แม่น้ำปารานา";
                        $a3 = "แม่น้ำไนล์";
                        $a4 = "แม่น้ำมาเดรา";
                        $description = "แม่น้ำไนล์อยู่ทวีปแอฟริกา";
                        $correct = base64_encode(3);
                        break;
                    case '2':
                        $type = "4-choice";
                        $q = "เมืองหลวงของบราซิลคือข้อไร?";
                        $a1 = "ริโอเดจาเนโร";
                        $a2 = "เซาเปาโล";
                        $a3 = "ซัลวาดอร์";
                        $a4 = "บราซิเลีย";
                        $description = "บราซิเลียเป็นเมืองหลวงของบราซิล";
                        $correct = base64_encode(4);
                        break;
                    case '3':
                        $type = "4-choice";
                        $q = "ภาษาทางการของบราซิลคือภาษาใด?";
                        $a1 = "ภาษาสเปน";
                        $a2 = "ภาษาโปรตุเกส";
                        $a3 = "ภาษาฝรั่งเศส";
                        $a4 = "ภาษาอังกฤษ";
                        $description = "บราซิเลียเป็นเมืองหลวงของบราซิล";
                        $correct = base64_encode(2);
                        break;
                    case '4':
                        $type = "input";
                        $q = "จงเรียงคำต่อไปนี้ให้มีความหมาย<br>I R L B Z A";
                        $description = "Brazil เป็นประเทศที่อยู่ทวีปอเมริกาใต้";
                        $correct = base64_encode("brazil");
                        break;
                    case '5':
                        $type = "input";
                        $q = "จงเรียงคำต่อไปนี้ให้มีความหมาย<br>N O A M Z A N<br>R I E A R F O S T";
                        $description = "ป่าอเมซอนเป็นป่าที่ใหญ่ที่สุดในโลก";
                        $correct = base64_encode("amazon rainforest");
                        break;
                    case '6':
                        $type = "input";
                        $q = "จงเรียงคำต่อไปนี้ให้มีความหมาย<br>C R F I A A";
                        $description = "ป่าอเมซอนเป็นป่าที่ใหญ่ที่สุดในโลก";
                        $correct = base64_encode("africa");
                        break;
                    case '7':
                        $type = "4-choice";
                        $q = "สกุลเงินของบราซิลคือข้อไร?";
                        $a1 = "ดอลลาร์";
                        $a2 = "ยูโร";
                        $a3 = "เรียว";
                        $a4 = "เงินเปโซ";
                        $description = "1 เรียวมีค่าประมาณ 0.15 ดอลลาร์ หรือ 4.9 บาท";
                        $correct = base64_encode(3);
                        break;
                    case '8':
                        $type = "4-choice";
                        $q = "บราซิลมีพรมแดนร่วมกับประเทศต่างๆ ยกเว้นข้อใด?";
                        $a1 = "อุรุกวัย";
                        $a2 = "โคลอมเบีย";
                        $a3 = "สหรัฐอเมริกา";
                        $a4 = "เปรู";
                        $description = "บราซิลมีพรมแดนร่วมกับประเทศต่างๆแต่ไม่มีพรมแดนติดกับสหรัฐอเมริกา";
                        $correct = base64_encode(3);
                        break;
                    case '9':
                        $type = "4-choice";
                        $q = "สัตว์ประจำชาติของบราซิลคือข้อใด?";
                        $a1 = "จากัวร์";
                        $a2 = "นกทูแคน";
                        $a3 = "อนาคอนด้า";
                        $a4 = "คาปิบาร่า";
                        $description = "จากัวร์เป็นสัตว์ประจำชาติของประเทศบราซิล";
                        $correct = base64_encode(1);
                        break;
                    case '10':
                        $type = "input";
                        $q = "จงเติมคำต่อไปนี้ให้ถูกต้อง<br>A__zon ____forest<br>ตอบเป็นคำทั้งหมดเช่น Br____ = Brazil";
                        $description = "";
                        $correct = base64_encode("amazon rainforest");
                        break;
                    default:
                        header("Location: logout.php");
                }
            }
        
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="template-question.css">
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
                <h1><?= $q ?></h1>
                <div></div>
            </div>
            <div class="login-card-form" id="form" style="align-items:center; justify-content: center; width:100%;" >
                <?php if ($type == "4-choice") { 
                    $l = array(1, 2, 3, 4);
                    shuffle($l);
                    foreach ($l as $v) {
                        if ($v == 1) {
                            ?> <button type="button" style="width: 90%; font-family: 'Kanit', sans-serif;" id="btn-1" onclick="submit('1');"><?= $a1 ?></button> <?php
                        } else if ($v == 2) {
                            ?> <button type="button" style="width: 90%; font-family: 'Kanit', sans-serif;" id="btn-2" onclick="submit('2');"><?= $a2 ?></button> <?php
                        } else if ($v == 3) {
                            ?> <button type="button" style="width: 90%; font-family: 'Kanit', sans-serif;" id="btn-3" onclick="submit('3');"><?= $a3 ?></button> <?php
                        } else if ($v == 4) {
                            ?> <button type="button" style="width: 90%; font-family: 'Kanit', sans-serif;" id="btn-4" onclick="submit('4');"><?= $a4 ?></button> <?php
                        }
                    }
                    ?>
                <?php } ?>
                <?php if ($type == "input") { ?>
                    <input type="text" placeholder="ใส่คำตอบ" id="answer" style="font-family: 'Kanit', sans-serif;" autofocus>
                    <button type="button" id="btnsub" style="width: 90%; font-family: 'Kanit', sans-serif;" onclick="submit('input');">ส่งคำตอบ</button>
                    <script>
                        let input = document.getElementById("answer");
                        input.addEventListener("keypress", function(event) {
                        if (event.key === "Enter") {
                            event.preventDefault();
                            document.getElementById("btnsub").click();
                        }
                        });
</script>
                    <?php } ?>
                </div>
        </div>
    </div>
</body>
</html>
    
<?php } } else { header("Location: logout.php"); } } ?>

<script>
    function submit(num) {
        if (num == 'input') {
            ans = ($('#answer').val()).toLowerCase();
            $.ajax({
            type: "POST",
            data: {
                answer: "<?= $correct ?>",
                selected: ans,
                id: <?= $question ?>
            },
            url: "backend/check_answer.php",
            success: function (response) {
                if (response.startsWith("S")) {
                    swal({
                        title: "ถูกต้อง!",
                        text: "<?= $description ?>",
                        icon: "success",
                        button: "ต่อไป"
                    }).then(something => {
                        if (response.replaceAll("S", "") == "2147483647") {
                            window.location.href = "result.php";
                        } else {
                            window.location.href = "question.php?question="+btoa(response.replaceAll("S", ""));
                        }
                    });
                    setTimeout(() => {
                        
                    }, 2500);
                } else {
                    swal({
                        title: "ผิด!",
                        text: "คำตอบไม่ถูกต้อง!",
                        icon: "error",
                        button: "ปิด"
                    }).then(something => {
                        window.location.href = "question.php?question="+btoa(response);
                    });
                }
            }
        })
        } else {
            $.ajax({
            type: "POST",
            data: {
                answer: "<?= $correct ?>",
                selected: num,
                id: <?= $question ?>
            },
            url: "backend/check_answer.php",
            success: function (response) {
                if (response.startsWith("S")) {
                    swal({
                        title: "ถูกต้อง!",
                        text: "<?= $description ?>",
                        icon: "success",
                        button: "ปิด"
                    }).then(something => {
                        if (response.replaceAll("S", "") == "2147483647") {
                            window.location.href = "result.php";
                        } else {
                            window.location.href = "question.php?question="+btoa(response.replaceAll("S", ""));
                        }
                    });
                } else {
                    swal({
                        title: "ผิด!",
                        text: "คำตอบไม่ถูกต้อง!",
                        icon: "error",
                        button: "ปิด"
                    }).then(something => {
                        window.location.href = "question.php?question="+btoa(response);
                    });
                }
            }
        })
        }
        
    }
</script>