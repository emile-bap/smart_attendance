<?php
session_start();
if($_SESSION['user_id']) { }
else {echo @$failed.'<meta http-equiv="refresh"'.'content="0; URL=logout?logout='.@$_SESSION['user_id'].'">'; } 
include "connection.php"; ?>

<script src="tab/js/tab1.js"></script>  
<script src="tab/js/tab2.js"></script>
<link rel="shortcut icon" href="<?= @$logo; ?>">
<style>
*{ font-size:14px;}
th,td{ padding:1%;}
table{ width:100%;}
</style>

<?php
$stms_pagination = $DB_con->prepare("SELECT * FROM pagination WHERE pagination_user_id='".@$_SESSION['user_id']."'");
try {
$stms_pagination->execute();
$row_count_pagination = $stms_pagination->rowCount();
if ($row_count_pagination > 0) {
$pagination = $stms_pagination->fetch(PDO::FETCH_ASSOC);
$pag_limit = $pagination['pagination_limit'];}
else { $pag_limit =5;}
} catch (PDOException $ex) {
echo "Error: " . htmlspecialchars($ex->getMessage()); } 
$messpg="Hello <b>".@$_SESSION['user_name']." ".@$_SESSION['user_othername']."</b>,
You’ve set the pagination to show <b>".@$pag_limit."</b> items per page.
This keeps it friendly and straightforward. Feel free to modify it based on your needs!"; 

//====Some Totals
include 'summation.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?= @$logo; ?>">
<title><?= @$abbreviation.' '.@$_SESSION['position_name']; ?></title>
    
    <link rel="stylesheet" href="public_html/assets/css/bootstrap.css">    
    <link rel="stylesheet" href="public_html/assets/vendors/chartjs/Chart.min.css">
    <link rel="stylesheet" href="public_html/assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="public_html/assets/css/app.css">
</head>
<body>


<?php
if(isset($_GET['student_id'])) {
        $att_student_id=$_GET['student_id'];
        @$student_name=$_GET['student_name'];
        $att_agent_id=$_SESSION['user_name'].' '.$_SESSION['user_othername'];
        $att_day=date('l');
        $att_date=date('Y-m-d');
        $att_time=date('H:i:s');
        $observation='Thank You for Marking Your Attendance.
<br>Keep up the good work!<br><br>
Best regards,<br>
'.$att_agent_id.'<br>
'.$_SESSION['position_name'];

        $save_access= $DB_con->prepare("INSERT INTO attendance(att_student_id, att_agent_id, att_day, att_date, att_time, observation) VALUES (?,?,?,?,?,?)");
        $save_access->execute(array($att_student_id,$att_agent_id,$att_day,$att_date,$att_time,$observation));
        echo '<div style="border:2px #ccc solid; margin:2% 5% 2% 5%; border-radius:10px; padding:2%;"><center><img src="logo/logon.jpg" style="width:auto; padding:2%; height:120px;"><br>'.$observation.'</center></div>';} ?>

</body>
</html>
