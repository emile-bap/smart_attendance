<?php
@session_start();
if($_SESSION['user_id']) { }
else { header("Location:logout?logout"); }
include 'connection.php';
?>
<!DOCTYPE HTML>
<html oncontextmenu="return false">
<head>
<title><?= @$name.' '.@$_GET['title']; ?></title>
<link rel="shortcut icon" href="<?= @$logo; ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Modern Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<body>

<div class="main-content container-fluid">
    <div class="row">
<div class="col-lg-4"><img src="<?= $logo; ?>" style="height:70px;"></div>
<div class="col-lg-8"><h3 style="font-size:18px; font-weight:bold; color:#000;"><?= $name.'<br>Contact: '.$phone.'<br>Email: '.$email; ?></h3></div>
<!-- <div class="col-lg-2"><img src="<?= $stamp; ?>" style="height:70px;"></div> -->


    
<link rel="stylesheet" href="public_html/assets/css/bootstrap.css">    
    <link rel="stylesheet" href="public_html/assets/vendors/chartjs/Chart.min.css">
    <link rel="stylesheet" href="public_html/assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="public_html/assets/css/app.css">

    <div style="float:left; width:100%; margin:1% 0% 1% 0%; padding:1px; background-color:#00B1B5;"></div>