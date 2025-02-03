<style>
*{ font-family:Arial; font-size:13px;}
a{ color:#006699; text-decoration:none;}
</style>

<?php 
@include ("connection.php");

$stms_access = $DB_con->prepare("SELECT message.msg_id, registration.user_name, registration.user_reg_no, registration.user_names, message.msg_subject, message.msg_message, message.msg_message_replied, message.msg_time,  message.msg_status, message.msg_receiver FROM registration, message WHERE message.msg_receiver=registration.user_id AND message.msg_receiver='".$_SESSION['user_id']."' ORDER BY message.msg_status,message.msg_id DESC");
try {
$stms_access->execute(array());
$row_count_access = $stms_access->rowCount();
if ($row_count_access > 0)
{
$i=0;
while($access = $stms_access->fetch(PDO::FETCH_ASSOC))
{
$i++;
$record_1 = $access['msg_id'];
$record_2 = $access['msg_subject'];
$record_3 = $access['msg_message'];
$record_4 = $access['msg_time'];
$record_6 = $access['msg_status'];
$record_7 = $access['user_name']." ".$access['user_names'];
$record_8 = $access['user_reg_no'];

if($record_6==1)
{
echo "<a>".$record_4."</a><br><u>Subject</u>: ".$record_2."<br><u>Receiver</u>: ".$record_7."<br>".$record_3."<hr>"; 
}
else
{}
}}
else{ }
}
catch (PDOException $ex) 
{
echo $ex->getMessage();
}
?>
<a>Messages for all</a>
<hr />

<?php
$stms_access = $DB_con->prepare("SELECT DISTINCT(message.msg_id), registration.user_name, registration.user_reg_no, registration.user_names, message.msg_subject, message.msg_message, message.msg_message_replied, message.msg_time,  message.msg_status, message.msg_receiver FROM registration, message WHERE message.msg_receiver=0 AND message.msg_sender='".$_SESSION['user_id']."' ORDER BY message.msg_status,message.msg_id DESC LIMIT 0,1");
try {
$stms_access->execute(array());
$row_count_access = $stms_access->rowCount();
if ($row_count_access > 0)
{
$i=0;
while($access = $stms_access->fetch(PDO::FETCH_ASSOC))
{
$i++;
$record_1 = $access['msg_id'];
$record_2 = $access['msg_subject'];
$record_3 = $access['msg_message'];
$record_4 = $access['msg_time'];
$record_6 = $access['msg_status'];
$record_7 = $access['user_name']." ".$access['user_names'];
$record_8 = $access['user_reg_no'];

if($record_6==1)
{
echo "<a>".$record_4."</a><br><u>Subject</u>: ".$record_2."<br><u>Receiver</u>: ".$record_7."<br>".$record_3."<hr>"; 
}
else
{}
}}
else{  }
}
catch (PDOException $ex) 
{
echo $ex->getMessage();
}
?>