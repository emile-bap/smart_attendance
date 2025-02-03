<?php 
session_start();
include 'connection.php';
?>



<!DOCTYPE HTML>
<html oncontextmenu="return false">
<head>
<title>Logout  <?= $name; ?></title>
<link rel="shortcut icon" href="<?= $logo; ?>">

<style>
<style>
@media only screen and (min-width: 201px) 
{
body, html, head {background: linear-gradient(to bottom, #e4e4e4 20%, #e4e4e4 80%) no-repeat fixed; text-align:center;}
body img{ margin-bottom:1%;}
.border-login{ background-color:#F7F7F7; padding:2% 2% 10% 2%; border-radius:10px;}
}

@media only screen and (min-width: 769px)
{
body, html, head{background: linear-gradient(to bottom, #e4e4e4 20%, #e4e4e4 80%) no-repeat fixed;  text-align:center;}
body img{ margin-bottom:0%; }
.border-login{ background-color:#FFF; padding:2% 2% 10% 2%; border-radius:10px;}
}
</style>

<body>
<div class="app-cam" style="color:#006699; font-size:16px;">
<center><br><br><br> 
<?php 
if(isset($_GET['logout']) && isset($_SESSION['user_id'])){
echo 'Thank you <span>'.$_SESSION['user_othername'].' '.@$_SESSION['user_name'].'<br /> You are signing out</span></center>';
@$logout_time= date('h:i:s A');
@$logout_date= date('Y-m-d');
@$logout_day= date('l');
@$login_status= 'Offline';
@$login_student_id= $_SESSION['user_id'];

@$sql = "UPDATE login SET logout_time = :logout_time, logout_date = :logout_date, logout_day = :logout_day, login_status = :login_status 
WHERE login.login_student_id = :login_student_id";
@$stmt = $DB_con->prepare($sql);
@$stmt->bindParam(':logout_time', $logout_time, PDO::PARAM_INT); 
@$stmt->bindParam(':logout_date', $logout_date, PDO::PARAM_INT); 
@$stmt->bindParam(':logout_day', $logout_day, PDO::PARAM_INT); 
@$stmt->bindParam(':login_status', $login_status, PDO::PARAM_INT); 
@$stmt->bindParam(':login_student_id', $login_student_id, PDO::PARAM_INT);    
@$stmt->execute(); }

session_unset();
session_destroy();
echo $signout.'<meta http-equiv="refresh"'.'content="0; URL=../../index?#Welcome today '.date('l_d/m/Y_h:i:s_A').'">'; ?>

</div>
</body>
</html>

