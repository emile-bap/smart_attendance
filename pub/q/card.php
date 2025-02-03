<?php
session_start();
if ($_SESSION['user_id']) {
} else {
    echo @$failed . '<meta http-equiv="refresh" content="0; URL=logout?logout=' . @$_SESSION['user_id'] . '">';
}
include "connection.php";
@$company = $name;
?>

<!DOCTYPE HTML>
<html oncontextmenu="return false">
<head>
    <link rel="shortcut icon" href="<?= @$logo; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Vertical Card Layout</title>
    <style>
        * {
            font-family: <?= $font_family; ?>;
        }

        #card_print {
            font-family: <?= $font_family; ?>;
            margin: 20px auto;
            padding: 0;
            width: 240px; /* Vertical layout width */
            height: 360px; /* Vertical layout height */
            background-color: #FF0;
            border-radius: 10px;
            box-shadow: 5px 5px 10px #888888;
            display: flex;
            flex-direction: column; /* Aligns child elements vertically */
            overflow: hidden;
        }

        #card_header_left {
            width: 100%;
            background-color: #006699;
            padding: 10px;
            text-align: center;
        }

        #card_header_left .header_logo {
            max-width: auto;
            height: 30px;
        }

        #card_header_right {
            width: 98%;
            background-color: #069;
            text-align: center;
            padding: 1%;
            color: #fff;
        }

        #card_header_right .tap {
            font-family: Century Gothic;
            color: #fff;
            font-size: 14px;
        }

        #card_header_right .defining {
            font-family: Comic Sans MS;
            font-size: 12px;
            color: #fff;
        }

        #sub_header {
            width: 98%;
            background-color: #069;
            padding: 1%;
            text-align: center;
            color: #fff;
        }

        #sub_header .name-patient {
            font-family: Century Gothic;
            font-weight: bold;
            color: #fff;
        }

        #sub_header .profile_picture {
            height: 80px;
            width: 80px;
            border-radius: 50%;
            border: solid 3px #fff;
        }

        #bottom {
            background-color: #060;
            color: #FFF;
            width: 98%;
            padding: 2%;
            text-align: center;
            border-radius: 0px;
        }

        #bottom span {
            display: block;
            font-size: 12px;
            margin-top: 5px;
            color: #fff;
            text-align:center;
        }

        #bottom2 {
            background-color: #9FC4F0;
            width: 98%;
            padding: 1%;
            text-align: center;
            border-radius: 0px 0px 10px 10px;
        }

        #bottom2 span {
            font-size: 12px;
            display: block;
            color: #fff;
            text-align:center;
        }
    </style>
</head>
<body>
    <?php
    if (isset($_GET['qrcode'])) {
        echo "<title>" . $name . " Printing card No" . $_GET['student_id'] . " of " . $_GET['name'] . "</title>";
        $PrintCartOfLeader = $_GET['student_id'];
        $stms_access = $DB_con->prepare("SELECT * FROM registration pr 
            INNER JOIN position pp ON pp.position_id = pr.user_position 
            INNER JOIN country pc ON pc.country_id = pr.user_country 
            INNER JOIN cells pcells ON pcells.Cell_ID = pr.user_cell 
            INNER JOIN sectors psectors ON psectors.Sector_ID = pcells.Sector_ID 
            INNER JOIN district pd ON pd.DistrictID = psectors.District_ID 
            INNER JOIN province ppv ON ppv.ProvinceID = pd.ProvinceID 
            INNER JOIN system ps ON ps.id = pr.school_id 
            INNER JOIN centers AS c ON c.center_id = pr.center 
            INNER JOIN classes AS cl ON cl.class_id = pr.class_id 
            WHERE pr.user_id = :user_id");
        try {
            $stms_access->execute(['user_id' => $PrintCartOfLeader]);
            $row_count_access = $stms_access->rowCount();
            if ($row_count_access > 0) {
                while ($access = $stms_access->fetch(PDO::FETCH_ASSOC)) {
                    $record_22 = $access['user_othername'] . " " . $access['user_name'];
                    $class_name = $access['class_name'];
                    $qrcode = $access['qrcode'];
                    $record_8 = $access['user_photo'];
                    $position_name = $access['user_photo'];
    ?>
    <div id="card_print">
        <div id="card_header_left">
            <img src="<?= @$logo; ?>" class="header_logo">
        </div>
        <div id="card_header_right">
            <span class="tap"><?= $access['center_name']; ?></span><br><br>
            <span class="defining" style="padding:2%;">Student ID Card</span>
        </div>
        <div id="sub_header">
            <span class="name-patient"><?= $record_22; ?><br>
            <img src="<?= @$record_8; ?>" class="profile_picture"><br>
            Class: <?= $class_name; ?></span>
        </div>
        <div id="bottom">
            <span><img src="<?= @$qrcode; ?>" style="width: 80px; height: 80px;"></span>
        </div>
        <span style="color:#000; text-align:center; margin-top:2%;">Validity: <?= date('F Y', strtotime('+1 year')); ?></span>
    </div>
    <?php
                }
            } else {
                echo '<b style="color:indianred; text-align:center;">No record available</b>';
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    include 'printer.php';
    ?>



</body>
</html>
