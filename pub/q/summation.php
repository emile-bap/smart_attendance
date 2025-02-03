<?php
//==Sum of staff
$stmtfstaff = $DB_con->prepare("SELECT COUNT(*) AS TotStaff FROM registration AS reg WHERE reg.user_position<>3");
$stmtfstaff->execute();
$resultstaff = $stmtfstaff->fetch(PDO::FETCH_ASSOC);
$totstaff = $resultstaff['TotStaff'];
?>