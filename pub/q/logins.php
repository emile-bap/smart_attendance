<?php session_start(); ?>

<script src="tab/js/tab1.js"></script>  
<script src="tab/js/tab2.js"></script>
<link href="css/fa_icon.css" rel="stylesheet">

<?php 
include("connection.php");
include("include_fetch_school.php");
?>

<link rel="shortcut icon" href="<?= @$logo; ?>">
<style>	
*{ font-family:<?= @$font_family; ?>; outline:none;}
@media only screen and (min-width: 201px) 
{
body, html, head {background: linear-gradient(to bottom, #F8F9F9 20%, #F8F9F9 80%) no-repeat fixed; text-align:center;}
body img{ margin-bottom:1%; width:auto; height:80px; margin-top:1%; border-radius:2px; }
.border-login{ background-color:#F8F9F9; padding:2% 2% 10% 2%; border-style:groove; border-width: 1px; border-color:#D6DBDF; margin-top:5%; border-radius:8px; margin-top:30%;}
}

@media only screen and (min-width: 769px)
{
body, html, head{background: linear-gradient(to bottom, #F8F9F9 20%, #F8F9F9 80%) no-repeat fixed;  text-align:center;}
body img{ margin-bottom:0%; width:auto; height:80px; margin-top:1%; border-radius:2px; }
.border-login{ background-color:#F8F9F9; padding:2% 2% 10% 2%; border-style:groove; border-width: 1px; border-color:#D6DBDF; margin-top:5%; border-radius:8px; margin-top:30%;}
}
</style>

<body>
<div class="app-cam">
<div class="border-login" style="background-color:#fff;"><!--<p><strong><?= @$name; ?><br><?= @$abbreviation; ?></strong></p>-->




<?php
$error = "";
$success = "";


if(isset($_POST['login_student'])){
if(!empty($_POST['username']) AND !empty($_POST['password']) ){
$username=$_POST['username'];
$password=md5($_POST['password']);

$stmt = $DB_con->prepare("SELECT * FROM registration AS r LEFT JOIN system AS s ON s.id=r.school_id LEFT JOIN country AS c ON c.country_id=r.user_country LEFT JOIN position AS pos ON pos.position_id=r.user_position LEFT JOIN cells AS cel ON cel.Cell_ID=r.user_cell LEFT JOIN sectors AS sec ON sec.Sector_ID=cel.Sector_ID LEFT JOIN district AS dis ON dis.DistrictID=sec.District_ID LEFT JOIN province AS pro ON pro.ProvinceID=dis.ProvinceID LEFT JOIN classes AS cla ON cla.class_id=r.user_class_id LEFT JOIN faculty AS tra ON tra.faculty_id=cla.faculty_id LEFT JOIN class_letter AS let ON let.letter_id=cla.level_id LEFT JOIN parents AS pa ON pa.student_id=r.user_id WHERE r.user_reg_no='".$username."' AND r.user_password='".$password."' AND r.user_status=1");
try {
$stmt->execute(array());
$row_count = $stmt->rowCount();
if ($row_count > 0){
$row1 = $stmt->fetch(PDO::FETCH_ASSOC);
$_SESSION['user_id']=$row1['user_id'];
$_SESSION['position_id']=$row1['position_id'];
$_SESSION['faculty_id']=$row1['faculty_id'];
$_SESSION['class_id']=$row1['class_id'];
$_SESSION['user_othername']=$row1['user_othername'];
$_SESSION['user_name']=$row1['user_name'];
$_SESSION['user_reg_no']=$row1['user_reg_no'];
$_SESSION['user_email']=$row1['user_email'];
$_SESSION['user_phone']=$row1['user_phone'];
$_SESSION['user_gender']=$row1['user_gender'];
$_SESSION['user_photo']=$row1['user_photo'];
$_SESSION['user_status']=$row1['user_status'];
$_SESSION['country_name']=$row1['country_name'];
$_SESSION['position_name']=$row1['position_name'];
$_SESSION['faculty_name']=$row1['faculty_name'];
$_SESSION['section']=$row1['department_name'];
$_SESSION['letter_id']=$row1['letter_id'];
$_SESSION['class_name']=$row1['class_alphabetic'];
$_SESSION['user_password']=$row1['user_password'];
$_SESSION['collegeid']=$row1['id'];


@$stms_access = $DB_con->prepare("SELECT * FROM registration, position, country, province, district, sectors, cells, classes, class_letter, faculty, parents, system WHERE position.position_id=registration.user_position AND country.country_id=registration.user_country AND cells.Cell_ID=registration.user_cell AND sectors.Sector_ID=cells.Sector_ID AND district.DistrictID=sectors.District_ID AND province.ProvinceID=district.ProvinceID AND position.position_id=4 AND classes.class_id=registration.user_class_id AND class_letter.letter_id=classes.level_id AND faculty.faculty_id=classes.faculty_id AND parents.student_id=registration.user_id AND registration.user_status=1 AND system.id=registration.school_id AND system.id=classes.school_id AND registration.user_id='".$_SESSION['user_id']."'");
try {
$stms_access->execute(array());
$row_count_access = $stms_access->rowCount();
if ($row_count_access > 0){
$access = $stms_access->fetch(PDO::FETCH_ASSOC);
$_SESSION['class_id']= $access['class_id'];
$_SESSION['class_name']= $access['class_alphabetic'];
$_SESSION['position_id']= $access['position_id'];
$_SESSION['position_name']= $access['position_name'];
$_SESSION['user_reg_no']= $access['user_reg_no'];
$_SESSION['faculty_id']= $access['faculty_id'];
$_SESSION['faculty_name']= $access['faculty_name'];
echo "You are ". $access['user_othername'].' '.$access['user_name'].' <br>You have enrolled in '.$_SESSION['class_name'].' '.$access['faculty_name'];
$login_student_id=$_SESSION['user_id'];
$login_time=date('h:i:s A');
$login_date=date('Y-m-d');
$login_day=date('l');
$logout_time='';
$logout_date='';
$logout_day ='';
$login_status='Online';
$save_login= $DB_con->prepare("INSERT INTO login (login_student_id, login_time, login_date, logout_time, logout_date, login_day, logout_day, login_status) VALUES (?,?,?,?,?,?,?,?)");
$save_login->execute(array($login_student_id, $login_time, $login_date, $logout_time, $logout_date, $login_day, $logout_day, $login_status));    
}else{ }}catch (PDOException $ex) {$ex->getMessage();}

$success="<center><b style='color:#006699;'><br><i class='fa fa-check'></i> Login successful.</b><br><br></center>";

if($_SESSION['position_id']==4){   
echo $success.'<meta http-equiv="refresh"'.'content="1; URL=mcfsp_student?&profilexx='.$_SESSION['user_id'].'&user_name_to_editxx='.$_SESSION['user_othername'].' '.$_SESSION['user_name'].'">';  
}}else{
echo $error="<center><b style='color:indianred;'><i class='fa fa-times fa-spin'></i> Login failure try again !!!</b></center>"; echo'<meta http-equiv="refresh"'.'content="5; URL=../../index?LOGIN AS STUDENT">';
}}catch (PDOException $e) {$e->getMessage();}}}



if(@$logo=='') {}else { ?><img src="<?= @$logo; ?>" alt="Loading..."/><br><?php } ?>


</div>





<script>
function myFunction() {
var x = document.getElementById("myInput");
if (x.type === "password") {
x.type = "text";
} else {
x.type = "password";
}}

function myFunction2() {
var x = document.getElementById("myInput2");
if (x.type === "password") {
x.type = "text";
} else {
x.type = "password";
}}

function myFunction3() {
var x = document.getElementById("myInput3");
if (x.type === "password") {
x.type = "text";
} else {
x.type = "password";
}}
</script>


