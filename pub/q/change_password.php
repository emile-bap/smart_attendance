<?php
if($_SESSION['position_id']==1){   
$link="<a href='super_admin?updateHDFSDJ=".md5(56)."&updateHDFSDJ=".md5(56)."&profilexx=".$_SESSION['user_id']."&user_name_to_editxx=".$_SESSION['user_name']." ".$_SESSION['user_othername']."&updateHDFSDJ=".md5(56)."'><i class='fa fa-edit'></i> click here</a>"; }

if($_SESSION['position_id']<>1 || $_SESSION['position_id']<>4){ 
$link="<a href='mcfsp_staff?updateHDFSDJ=".md5(56)."&updateHDFSDJ=".md5(56)."&profilexx=".$_SESSION['user_id']."&user_name_to_editxx=".$_SESSION['user_name']." ".$_SESSION['user_othername']."&updateHDFSDJ=".md5(56)."'><i class='fa fa-edit'></i> click here</a>"; }

if($_SESSION['position_id']==4){   
$link="<a href='mcfsp_student?updateHDFSDJ=".md5(56)."&updateHDFSDJ=".md5(56)."&profilexx=".$_SESSION['user_id']."&user_name_to_editxx=".$_SESSION['user_name']." ".$_SESSION['user_othername']."&updateHDFSDJ=".md5(56)."'><i class='fa fa-edit'></i> click here</a>"; }
?>



<style>
.alert {
  padding: 5px;
  background-color:#fff;
  color: #006699;
  width:80%;
  margin:1% 10% 0% 10%;
  border-radius:100px;
}
.alert a { color:#006699;}
.closebtn {
  margin-left: 5%;
  color: #f00;
  font-weight: bold;
  float: right;
  font-size: 30px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
}

.closebtn:hover {
  color: black;
}
</style>



<div class="alert" id="blink">
  <span class="closebtn" style='margin:2% 2% 0% 0%;' onclick="this.parentElement.style.display='none';">&times;</span> 
 <img src='<?= $_SESSION['user_photo']; ?>' style='border-radius:100%; height:50px; width:auto;' class='zoom'> 
 <?= 'Dear <b>'.$_SESSION['user_othername'].' '.$_SESSION['user_name']; ?></b> update your password <?= $link; ?>
 </div>

