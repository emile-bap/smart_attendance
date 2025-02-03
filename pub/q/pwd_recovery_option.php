<?php include("connection.php"); ?>

<!DOCTYPE HTML>
<html oncontextmenu="return false">
<head>
<title>Logout - <?php echo $name; ?></title>
<link rel="shortcut icon" href="<?php echo $logo; ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Modern Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href="css/font-awesome.css" rel="stylesheet">
</head>

<style>
@media only screen and (min-width: 201px) 
{
body, html, head {background: linear-gradient(to bottom, #e4e4e4 20%, #e4e4e4 80%) no-repeat fixed; text-align:center;}
body img{ margin-bottom:1%; width:auto; height:80px; margin-top:1%; border-radius:2px; }
.border-login{ background-color:#F7F7F7; padding:2% 2% 5% 2%; border-radius:10px;}
}

@media only screen and (min-width: 769px)
{
body, html, head{background: linear-gradient(to bottom, #e4e4e4 20%, #e4e4e4 80%) no-repeat fixed;  text-align:center;}
body img{ margin-bottom:0%; width:auto; height:80px; margin-top:1%; border-radius:2px; }
.border-login{ background-color:#FFF; padding:2% 2% 5% 2%; border-radius:10px;}
}
</style>

<body>
<div class="app-cam">
<div class="border-login">
<img src="<?php echo $logo; ?>" alt=""/><br>
<span style="color:#006699;"><?php echo $name; ?></span>
<?php
//======ACCEPT RECOVER PWD
if(isset($_POST['recover_pwd'])) 
{
$student_email=$_POST['email'];
$student_new_password=md5($_POST['new_password']);
$student_confirm_new_password=md5($_POST['confirm_password']);	

if($student_new_password != $student_confirm_new_password)
{
echo "<center><p style='color:#F00; font-size:16px;'><img src='images/images/ajax-loader-gears.gif' style='height:80px;'><br>Passwords are not matched, try again !!!</p></center><br><br>";
echo'<meta http-equiv="refresh"'.'content="2; URL=pwd_recovery_option?T-HGHH_'.md5(date("y")).'&your_email='.$student_email.'&T-HGHH_'.md5(date("y")).'&T-HGHH_'.md5(date("y")).'">'; 	
}

else
{
$student_email=$_POST['email'];
$student_new_password=md5($_POST['new_password']);
$sql = "UPDATE registration SET user_password = :student_new_password WHERE registration.user_email = :student_email";
$stmt = $DB_con->prepare($sql);
$stmt->bindParam(':student_email', $student_email, PDO::PARAM_INT);
$stmt->bindParam(':student_new_password', $student_new_password, PDO::PARAM_INT);       
$stmt->execute();
if($sql)
{
echo "<center><br><br><p style='color:#09f; font-size:16px;'><img src='images/images/ajax-loader-gears.gif' style='height:80px;'><br>
Passwords changed !!!</p></center>";
echo'<meta http-equiv="refresh"'.'content="2; URL=index?welcome">'; 
//==================== END OF MESSAGE TO DISPLAY====================== 
}}}
?>

<?php
if(isset($_GET['your_email']))
{
$email_sent=$_GET['your_email'];
?>
<form class="form-horizontal" method="POST" action="pwd_recovery_option" enctype="multipart/form-data">
<input type="hidden" name="email" value="<?php echo $email_sent; ?>"><br>
<span style="float:left; margin-bottom:0%; color:#006699; margin-top:4%;"><i  class="fa fa-key"></i> New password</span>
<input type="password" placeholder="New Password" name="new_password" autofocus required style="background-color:#FFF; border:solid 1px #ccc; font-size:14px; border-radius:5px; color:#006699; border-color:#CCC; border-style:solid;" title="<?php echo $email_sent; ?>">
<span style="float:left; margin-bottom:0%; color:#006699; margin-top:4%;"><i  class="fa fa-key"></i> Confirm password</span>
<input type="password" placeholder="Confirm New Password" name="confirm_password" required style="background-color:#FFF; border:solid 1px #ccc; font-size:14px; border-radius:5px; color:#006699; border-color:#CCC; border-style:solid;">


<div class="submit" style="width:100%; float:left;">
<button type="submit" name="recover_pwd" style="background-color:#006699; color:#fff; font-size:16px; float:left; padding:1% 5% 1% 5%; border-style:none; border-radius:100px; margin-top:4%;"><i class="fa fa-spin fa-spinner"></i> Recover your password</button>
<button type="reset"  style="background-color:#98E7AA; color:#000; font-size:16px; float:right; padding:1% 5% 1% 5%; border-style:none; border-radius:100px; margin-top:4%;"><i class="fa fa-refresh"></i> Restart</button>
</div>

</form>
<a href="index?welcome again" style="margin-top:1%; text-align:right; float:right; width:100%;"><i class="fa fa-sign-in"></i> Login again</a>
<div class="clearfix"></div>
<?php
}
?>
</div>
</div>

<div class="login">
<p style="color:#000;">Copyrights &copy; <?php echo date('Y'); ?>. All rights reserved &reg; eSchool</p>
</div>
</body>
</html>