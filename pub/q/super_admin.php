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
    <div id="app">
        <div id="sidebar" class='active'>
            <div class="sidebar-wrapper active">
    <div class="sidebar-header">


<center>
<?php if(@$logo=='' || @$name=='') { echo ' Set system LOGO and NAME'; } 
else { ?><img src="<?= @$logo; ?>" class="zoom" title="<?= @$name; ?>" style="height:50px; width:auto;"></center>
<?php } ?>
		
<center>
<!-- <h5 style="font-weight:bold;"><?= @$name; ?></h5> -->
<hr><h4><?= @$_SESSION['position_name']; ?> Dashboard</h4>
</center>
				
    </div>
    <div class="sidebar-menu">
        <ul class="menu">
            


<li class="sidebar-item"><a data-toggle="modal" data-target="#set_staff" class='sidebar-link' title="Record staff"><i data-feather="edit" width="20"></i> <span>Enrollment</span></a></li>


<li class="sidebar-item  has-sub"><a href="#" class='sidebar-link'><i data-feather="settings" width="20"></i> <span> Configuration</span></a>
<ul class="submenu ">
<li><a href="?listofclasses=LIST OF CLASSES"><i data-feather="folder"></i>  Class</a></li>

<li><a href="?attendancerfid&title=Smart Attendance"><i data-feather="check-circle"></i>  Attendance</a></li>
</ul>
</li>

<li class="sidebar-item  has-sub"><a href="#" class='sidebar-link'><i data-feather="user-check" width="20"></i> <span> Personal Settings</span></a>
<ul class="submenu ">
<li><a href="?view=LIST OF STAFF&title=List of all staff&ghj=1"><i data-feather="users"></i>  Staff</a></li>
<li><a href="?view=LIST OF STUDENTS&title=List of all students&ghj=2"><i data-feather="list"></i> Students</a></li>
</ul>
</li>

<li class="sidebar-item  has-sub"><a href="#" class='sidebar-link'><i  data-feather="printer" width="20"></i> <span> Reporting</span></a>
<ul class="submenu ">
<li><a href="?listofclasses=LIST OF CLASSES&title=Attendancer"><i data-feather="check-circle"></i> Attendance</a></li>
</ul>
</li>

<li class="sidebar-item "><a href="logout?logout=<?= $_SESSION['user_id']; ?>" class='sidebar-link'><i data-feather="log-out" width="20"></i> <span> Sign Out</a></li>

	
</ul>
    </div>
    <button class="sidebar-toggler btn x"><i data-feather="x"></i> Close</button>
</div>
        </div>
        <div id="main">
            <nav class="navbar navbar-header navbar-expand navbar-light">
                <a class="sidebar-toggler" href="#"><span class="navbar-toggler-icon"> </span> </a> 
                <a data-toggle="modal" data-target="#search" style="color:#005292; font-weight:bold; margin-left:5%;">Search</a>

<div class="modal fade" id="search" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header">
<b><i data-feather="search"></i> Search person</b></div><div class="modal-body"><div class="col-md-2"></div><div class="col-md-12">
<form class="form-horizontal" method="GET" enctype="multipart/form-data"><div class="form-group"><div class="col-sm-12">
<input type="text" placeholder="Search person..." required class="form-control" name="key" style="margin-bottom:2%;">
<button type="submit" class="btn" style="background-color:#005292; color:#fff;"><i data-feather="search"></i> Search now</button>
<span data-dismiss="modal" class="btn btn-danger" style="float:right;"><i data-feather="x"></i> Close</span>
</div></div></div><br style="clear:both;"/><div class="modal-footer"></div></form></div></div></div></div>



                <button class="btn navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav d-flex align-items-center navbar-light ml-auto">
                        
						
						
						
                        <li class="dropdown">
                       

                            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                                <div class="avatar mr-1">
                                    <img src="<?php if($_SESSION['user_photo']=='') { echo 'Photo'; } else { ?>  <?= @$_SESSION['user_photo']; ?> <?php } ?>" alt="" srcset="">
                                </div>
                                <div class="d-none d-md-block d-lg-inline-block">Hi <?= @$_SESSION['user_name']; ?> <i data-feather="settings"></i></div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item active" href="?profilexx=<?= $_SESSION['user_id']; ?>&user_name_to_editxx=<?= @$_SESSION['user_othername'].' '.@$_SESSION['user_name']; ?>"><i data-feather="user"></i> Account</a>
                                <a class="dropdown-item" href="logout?logout=<?= $_SESSION['user_id']; ?>"><i data-feather="log-out"></i> Logout</a>
                            </div>
                        </li>
						

						
						
						
                    </ul>
                </div>
            </nav>
            
<div class="main-content container-fluid">


<div class="row">
<!-- Pagination -->
<div class="modal fade" id="pagination" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header">
<h2>Page Limitation</h2></div><div class="modal-body"><div class="col-md-2"></div><div class="col-md-12">
<form class="form-horizontal" method="POST" enctype="multipart/form-data"><div class="form-group"><div class="col-sm-12">
<input type="number" placeholder="Page limit..." required class="form-control" name="pagelimit" style="margin-bottom:2%;">
<button type="submit" name="savepagelimit" class="btn" style="background-color:#005292; color:#fff;"><i data-feather="save"></i> Save page limit</button>
<span data-dismiss="modal" class="btn btn-danger" style="float:right;"><i data-feather="x"></i> Close</span>
</div></div></div><br style="clear:both;"/><div class="modal-footer"></div></form></div></div></div></div>
<!-- End of pagination -->



             
<?php
        
if(isset($_GET['paginations'])) { ?>    
<div class="row">
    <div class="col-lg-3"></div>
    <div class="col-lg-6" style="color:#000; text-align:justify; padding:5%; border-radius:5px; border:solid 2px #ccc;">
        <h3><?= $_GET['paginations']; ?></h3><hr><?= $messpg; ?></div>
</div>
<?php }



if(isset($_GET['listofschools'])) {
    $limit = $pag_limit;
    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
    $offset = ($current_page - 1) * $limit; ?>
    <div class="row">
        <h3><?= @$_GET['listofschools']; ?></h3>
        <div class="col-lg-3"><form class="form-horizontal" method="POST"   enctype="multipart/form-data"> 
    <input type="text" autofocus class="form-control" style="margin-bottom:4%; float:left;"  placeholder="Type school name" name="center_name" required> 
    <input type="submit" name="save_center" class="btn btn2" style="background-color:#005292; width:100%;  padding:2% 6% 2% 6%; color:#fff;" value="Save School"></form>	
    </div>
        <div class="col-lg-9">
    <?php
    $stms_access = $DB_con->prepare("SELECT * FROM centers ORDER BY center_name ASC LIMIT $limit OFFSET $offset");
    try {
    $stms_access->execute(array());
    $row_count_access = $stms_access->rowCount();
    if ($row_count_access > 0){
        // calculate total pages
    $stmtf = $DB_con->prepare("SELECT COUNT(*) as total FROM centers");
    $stmtf->execute();
    $result = $stmtf->fetch(PDO::FETCH_ASSOC);
    $total_pages = ceil($result['total'] / $limit);
    $count=1; ?>
    
    <table style="width:100%;">
    <thead>
    <tr>
    <th style="color: #fff; background-color:#005292; padding:0.8%;">Name</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $i=1;
    while($access = $stms_access->fetch(PDO::FETCH_ASSOC)){
    $record_1 = $access['center_id'];
    $record_2n = $access['center_name'];
    $character_count = strlen($record_2n);
    if($character_count > 142){ $dot='...';}
    else{ $dot='';}
    $record_2 = substr($access['center_name'],0,142).''.$dot;
    $record_3 = $access['center_status'];
    ?> <tr>
    <td style="color: #000; padding:0.5%;" scope="row"><?= $i++.'. '.$record_2; ?></td>
   </tr><?php }} else{ }}
    catch (PDOException $ex) { $ex->getMessage(); } ?>
    </tbody></table>
    <?php
    echo '<div class="pagination">';
    if ($current_page > 1) {
    echo '<a href="?listofschools=center&page=' . ($current_page - 1) . '" class="prev">&laquo; Prev</a>'; }
    $show_dots = false;
    for ($i = 1; $i <= @$total_pages; $i++) {
    if ($i == $current_page) {
    echo '<span class="current">' . $i . '</span>';
    } else {
    if ($i > ($current_page - 3) && $i < ($current_page + 3)) {
    echo '<a href="?listofschools=center&page='.$i.'">'.$i.'</a>';
    $show_dots = true; 
    } elseif ($show_dots) {
    echo '...';
    $show_dots = false;
    }}}
    if ($current_page < @$total_pages) {
    echo '<a href="?listofschools=center&page=' . ($current_page + 1) . '" class="next">Next &raquo;</a>'; }
    echo '</div>'; ?>
    </div></div>
    <?php }




if(isset($_GET['listofclasses'])) {
    $limit = $pag_limit;
    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
    $offset = ($current_page - 1) * $limit; ?>
    <div class="row">
        <h3><?= @$_GET['listofclasses']; ?></h3>
        <div class="col-lg-3"><form class="form-horizontal" method="POST"   enctype="multipart/form-data"> 
    <input type="text" autofocus class="form-control" style="margin-bottom:4%; float:left;"  placeholder="Type class name" name="class_name" required> 
    <input type="submit" name="save_class" class="btn btn2" style="background-color:#005292; width:100%;  padding:2% 6% 2% 6%; color:#fff;" value="Save Class"></form>	
    </div>
        <div class="col-lg-9">
    <?php
    $stms_access = $DB_con->prepare("SELECT * FROM classes ORDER BY class_name ASC LIMIT $limit OFFSET $offset");
    try {
    $stms_access->execute(array());
    $row_count_access = $stms_access->rowCount();
    if ($row_count_access > 0){
        // calculate total pages
    $stmtf = $DB_con->prepare("SELECT COUNT(*) as total FROM classes");
    $stmtf->execute();
    $result = $stmtf->fetch(PDO::FETCH_ASSOC);
    $total_pages = ceil($result['total'] / $limit);
    $count=1; ?>
    
    <table style="width:100%;">
    <thead>
    <tr>
    <th style="color: #fff; background-color:#005292; padding:0.8%;">#</th>
    <th style="color: #fff; background-color:#005292;">Name</th>
    <?php if(@$_GET['title']=='Attendancer'){ ?>
        <th style="color: #fff; background-color:#005292; text-align:center;" colspan="2">Attendance Report</th>
        <?php } else{ } ?>
    </tr>
    </thead>
    <tbody>
    <?php
    $i=1;
    while($access = $stms_access->fetch(PDO::FETCH_ASSOC)){
    $record_1 = $access['class_id'];
    $record_2n = $access['class_name'];
    $character_count = strlen($record_2n);
    if($character_count > 142){ $dot='...';}
    else{ $dot='';}
    $record_2 = substr($access['class_name'],0,142).''.$dot;
    $record_3 = $access['class_status']; ?> <tr>
    <td style="color: #000; padding:0.5%;" scope="row"><?= $i++; ?></td>
    <td style="color: #000;"><?= $record_2; ?></td>
    <?php if(@$_GET['title']=='Attendancer'){ ?>
        <td style="color: #000; padding:0.5%;" scope="row"><a href="print?reportofattendance=<?= $record_1; ?>&nnc=<?= $record_2n; ?>&title=Attendance report of <?= $record_2n; ?> class today <?= date('Y_m_d_H_i_s'); ?>"><i data-feather="check-circle"></i> General attendance Report</a></td>
        <td style="color: #000; padding:0.5%;" scope="row"><a href="print?search_name=<?= $record_1; ?>&nnc=<?= $record_2n; ?>&title=Attendance report of <?= $record_2n; ?> class today <?= date('Y_m_d_H_i_s'); ?>" style="color:green;"><i data-feather="check-square"></i> Advanced attendance Report</a></td>
    <?php } else{ ?><?php } ?>
    </tr><?php }} else{ }}
    catch (PDOException $ex) { $ex->getMessage(); } ?>
    </tbody></table>
    <?php
    echo '<div class="pagination">';
    if ($current_page > 1) {
    echo '<a href="?listofclasses='.$_GET['listofclasses'].'&title='.@$_GET['title'].'&page=' . ($current_page - 1) . '" class="prev">&laquo; Prev</a>'; }
    $show_dots = false;
    for ($i = 1; $i <= @$total_pages; $i++) {
    if ($i == $current_page) {
    echo '<span class="current">' . $i . '</span>';
    } else {
    if ($i > ($current_page - 3) && $i < (@$current_page + 3)) {
    echo '<a href="?listofclasses='.$_GET['listofclasses'].'&title='.@$_GET['title'].'&page='.$i.'">'.$i.'</a>';
    $show_dots = true; 
    } elseif ($show_dots) {
    echo '...';
    $show_dots = false;
    }}}
    if ($current_page < @$total_pages) {
    echo '<a href="?listofclasses='.$_GET['listofclasses'].'&title='.@$_GET['title'].'&page=' . ($current_page + 1) . '" class="next">Next &raquo;</a>'; }
    echo '</div>'; ?>
    </div></div>
    <?php }    




if(isset($_GET['key'])) {
        $limit = @$pag_limit;
    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
    @$offset = ($current_page - 1) * @$limit; ?>
    <div class="bs-example4" data-example-id="simple-responsive-table">
    <div class="table-responsive" >
    
    <a data-toggle="modal" data-target="#set_staff" title="Record new staff" class="btn" style="float:right; margin-bottom:1%; background-color:#005292; color:#fff;"><i class="fa fa-plus"></i> Add new</a>
    <?= "<span class='btn' style='float:left; margin-bottom:1%; background-color:#005292; color:#fff;'><i data-feather='list'></i> Result found on <b> ...".$_GET['key']."...</b></span>";
    
    $stms_access = $DB_con->prepare("SELECT * FROM registration pr INNER JOIN 
    position pp ON pp.position_id = pr.user_position INNER JOIN 
    country pc ON pc.country_id = pr.user_country INNER JOIN 
    cells pcells ON pcells.Cell_ID = pr.user_cell INNER JOIN 
    sectors psectors ON psectors.Sector_ID = pcells.Sector_ID INNER JOIN 
    district pd ON pd.DistrictID = psectors.District_ID INNER JOIN 
    province ppv ON ppv.ProvinceID = pd.ProvinceID INNER JOIN system 
    ps ON ps.id = pr.school_id INNER JOIN 
    centers AS c ON c.center_id=pr.center INNER JOIN classes AS cl ON
    cl.class_id=pr.class_id WHERE    

    user_othername LIKE '%".$_GET['key']."%' OR 
user_othername  LIKE '%".$_GET['key']."%' OR 
 pr.user_name  LIKE '%".$_GET['key']."%' OR 
 pr.user_email  LIKE '%".$_GET['key']."%' OR 
 pr.user_phone  LIKE '%".$_GET['key']."%' OR 
 pr.user_gender  LIKE '%".$_GET['key']."%' OR 
 pr.user_photo  LIKE '%".$_GET['key']."%' OR 
 pr.user_status  LIKE '%".$_GET['key']."%' OR 
 pc.country_name  LIKE '%".$_GET['key']."%' OR 
 pp.position_name  LIKE '%".$_GET['key']."%' OR 
 pcells.CellName LIKE '%".$_GET['key']."%' OR 
 psectors.SectorName LIKE '%".$_GET['key']."%' OR 
 pd.DistrictName LIKE '%".$_GET['key']."%'OR 
 ppv.ProvinceName LIKE '%".$_GET['key']."%' OR 
 c.center_name LIKE '%".$_GET['key']."%' OR 
 pr.username LIKE '%".$_GET['key']."%'  OR 
 pr.user_reg_no LIKE '%".$_GET['key']."%' OR 
 cl.class_name LIKE '%".$_GET['key']."%' ORDER BY ps.abbreviation, pp.position_id ASC LIMIT $limit OFFSET $offset");
    try {
    $stms_access->execute(array());
    $row_count_access = $stms_access->rowCount();
    if ($row_count_access > 0) {
    
    // calculate total pages
    $stmtf = $DB_con->prepare("SELECT COUNT(*) AS total FROM registration pr INNER JOIN 
    position pp ON pp.position_id = pr.user_position INNER JOIN 
    country pc ON pc.country_id = pr.user_country INNER JOIN 
    cells pcells ON pcells.Cell_ID = pr.user_cell INNER JOIN 
    sectors psectors ON psectors.Sector_ID = pcells.Sector_ID INNER JOIN 
    district pd ON pd.DistrictID = psectors.District_ID INNER JOIN 
    province ppv ON ppv.ProvinceID = pd.ProvinceID INNER JOIN system 
    ps ON ps.id = pr.school_id INNER JOIN 
    centers AS c ON c.center_id=pr.center INNER JOIN classes AS cl ON
    cl.class_id=pr.class_id WHERE     
user_othername LIKE '%".$_GET['key']."%' OR 
 pr.user_name LIKE '%".$_GET['key']."%' OR 
 pr.user_email LIKE '%".$_GET['key']."%' OR 
 pr.user_phone LIKE '%".$_GET['key']."%' OR 
 pr.user_gender LIKE '%".$_GET['key']."%' OR 
 pr.user_photo LIKE '%".$_GET['key']."%' OR 
 pr.user_status LIKE '%".$_GET['key']."%' OR 
 pc.country_name LIKE '%".$_GET['key']."%' OR 
 pp.position_name LIKE '%".$_GET['key']."%' OR 
 pcells.CellName LIKE '%".$_GET['key']."%' OR 
 psectors.SectorName LIKE '%".$_GET['key']."%' OR 
 pd.DistrictName LIKE '%".$_GET['key']."%' OR 
 ppv.ProvinceName LIKE '%".$_GET['key']."%' OR 
 c.center_name LIKE '%".$_GET['key']."%' OR 
 pr.username LIKE '%".$_GET['key']."%'  OR 
 pr.user_reg_no LIKE '%".$_GET['key']."%' OR 
 cl.class_name LIKE '%".$_GET['key']."%'");
    $stmtf->execute();
    $result = $stmtf->fetch(PDO::FETCH_ASSOC);
    $total_pages = ceil($result['total'] / $limit);
    $count=1; ?>
    <table style="width:100%; ">
    <thead><tr>
    <th style="color:#fff; background-color:#005292; padding:0.7%;" colspan="3"> Personal Details</th>
    <th style="color:#fff; background-color:#005292; padding:0.7%;" colspan="2">Parents</th>
    <th style="color:#fff; background-color:#005292; text-align:center;" colspan="3">Options</th>
    </tr></thead><tbody>
    <?php $i=1;
    while($access = $stms_access->fetch(PDO::FETCH_ASSOC)) {
    $record_1 = $access['user_id'];
    $record_22 = $access['user_othername']." ".$access['user_name'];
    $record_2 = $access['user_name'];
    $record_4 = strtolower($access['user_email']);
    $record_5 = $access['user_phone'];
    $record_7 = $access['user_gender'];
    $record_8 = $access['user_photo'];
    $record_9 = $access['user_status'];
    $record_12 = $access['country_name'];
    $record_13 = $access['position_name'];
    $CellName = $access['CellName'];
    $SectorName = $access['SectorName'];
    $DistrictName = $access['DistrictName'];
    $ProvinceName = $access['ProvinceName'];
    $position_id = $access['position_id'];
    $namen = $access['name'];
    $center = $access['center_name'];
    $user_reg_no = $access['user_reg_no'];
    $class_name = $access['class_name'];
    $qrcode = $access['qrcode'];
    $mother = $access['mother'];
    $father = $access['father'];
    
    if($class_name==''){$class_names='';}
    else{$class_names=$class_name.' - ';}
    $gt=$record_1*678576100; ?>
    <tr>
    <td scope="row" style="color:#000; padding:0.5%;"><?= $i++; ?></td>
    <td scope="row" style="<?= $color; ?>"><?= $record_2; ?></td>
<td style="<?= $color; ?>"> <?= $class_names.' '.$center; ?></td>
<td style="<?= $color; ?>"> <?= $father; ?></td>
<td style="<?= $color; ?>"> <?= $mother; ?></td>
<td style="<?= $color; ?>;">
<a href="?myreport=<?= $gt; ?>&reportof=<?= $record_2; ?>">
<a data-toggle="modal" data-target="#account<?= $record_1; ?>" style="color:indianred; margin-left:5%;"><i data-feather="user"></i> Card</a>
<div class="modal fade" id="account<?= $record_1; ?>" aria-hidden="true">
<div class="modal-dialog"><div class="modal-content">
<center><h3><i data-feather="user"></i> Student Profile</h3> </center><hr>
<div class="modal-body"> <div class="col-md-12">
    
<img src="<?= $record_8; ?>" style="height:80px; width:80px; padding:1%; border:2px #005292 solid; border-radius:100%;">
<img src="<?= $qrcode; ?>" style="height:80px; float:right; width:80px; padding:1%; border:2px #005292 solid; border-radius:5px;">
<br>
Name: <b><?=  $record_22; ?></b><br>
Class: <b><?= $class_name; ?></b><br>
School: <b><?= $center; ?></b><br>
QR Code: 
<?php 
if($qrcode==''){ ?><b><a href="?qrcode&student_id=<?= $record_1; ?>&name=<?=  $record_22; ?>&class=<?=  $class_name; ?>"> Generate new QR Code of <?=  $record_22; ?></a></b><?php }
else{ ?><b><a href="?qrcode&student_id=<?= $record_1; ?>&name=<?=  $record_22; ?>&class=<?=  $class_name; ?>"> Update QR Code of <?=  $record_22; ?></a></b><br> 
Print card: <b><a href="card?qrcode&student_id=<?= $record_1; ?>&name=<?=  $record_22; ?>&class=<?=  $class_name; ?>"> Print student card of <?=  $record_22; ?></a></b><br> 
Attendance: <b><a href="?attendance=<?= $record_1; ?>&name=<?=  $record_22; ?>&class=<?=  $class_name; ?>"> Make attendance on <?=  $record_22; ?></a></b><?php } ?>


</b><br><br>
</div></div></div></div> </a></td>
 </tr> 
  <?php }}
    else{   ?><center><div class="spinner"><br>Empty</div></center>  <?php }}catch (PDOException $ex) {$ex->getMessage();} ?>
    </tbody></table><div class="col-sm-8"><?php
    
    
    
    echo '<div class="pagination">';
    if ($current_page > 1) {
    echo '<a href="?view='.$_GET['view'].'&title='.$_GET['title'].'&ghj='.$_GET['ghj'].'&page=' . ($current_page - 1) . '" class="prev">&laquo; Prev</a>'; }
    $show_dots = false;
    for ($i = 1; $i <= @$total_pages; $i++) {
    if ($i == $current_page) {
    echo '<span class="current">' . $i . '</span>';
    } else {
    if ($i > ($current_page - 3) && $i < ($current_page + 3)) {
    echo '<a href="?view='.$_GET['view'].'&title='.$_GET['title'].'&ghj='.$_GET['ghj'].'&page='.$i.'">'.$i.'</a>';
    $show_dots = true; 
    } elseif ($show_dots) {
    echo '...';
    $show_dots = false;
    }}}
    if ($current_page < @$total_pages) {
    echo '<a href="?view='.$_GET['view'].'&title='.$_GET['title'].'&ghj='.$_GET['ghj'].'&page=' . ($current_page + 1) . '" class="next">Next &raquo;</a>'; }
    echo '</div>'; 
    
    
    ?></div></div>
    <?php }
    
    
    if(isset($_GET['attendancerfid'])) { ?>
<div class="col-sm-3"></div>
<div class="col-sm-6"><div class="col-md-12">
<form class="form-horizontal" method="GET" enctype="multipart/form-data">
<input type="text" placeholder="Swipe the ID Card..." autofocus required class="form-control" name="keys" style="margin-top:15%;border-radius:100px; padding:4%;"></form></div><?php } 



        if(isset($_GET['keys'])) {
        $stms_access = $DB_con->prepare("SELECT * FROM registration pr INNER JOIN 
        position pp ON pp.position_id = pr.user_position INNER JOIN 
        country pc ON pc.country_id = pr.user_country INNER JOIN 
        cells pcells ON pcells.Cell_ID = pr.user_cell INNER JOIN 
        sectors psectors ON psectors.Sector_ID = pcells.Sector_ID INNER JOIN 
        district pd ON pd.DistrictID = psectors.District_ID INNER JOIN 
        province ppv ON ppv.ProvinceID = pd.ProvinceID INNER JOIN system 
        ps ON ps.id = pr.school_id INNER JOIN 
        centers AS c ON c.center_id=pr.center INNER JOIN classes AS cl ON
        cl.class_id=pr.class_id WHERE pr.rfid='".$_GET['keys']."'");
        try {
        $stms_access->execute(array());
        $row_count_access = $stms_access->rowCount();
        if ($row_count_access > 0) {
        $access = $stms_access->fetch(PDO::FETCH_ASSOC);
        $record_1 = $access['user_id'];
        $record_22 = $access['user_othername']." ".$access['user_name'];
        $record_2 = $access['user_name'];
        $record_4 = strtolower($access['user_email']);
        $record_5 = $access['user_phone'];
        $record_7 = $access['user_gender'];
        $record_8 = $access['user_photo'];
        $record_9 = $access['user_status'];
        $record_12 = $access['country_name'];
        $record_13 = $access['position_name'];
        $CellName = $access['CellName'];
        $SectorName = $access['SectorName'];
        $DistrictName = $access['DistrictName'];
        $ProvinceName = $access['ProvinceName'];
        $position_id = $access['position_id'];
        $namen = $access['name'];
        $center = $access['center_name'];
        $user_reg_no = $access['user_reg_no'];
        $class_name = $access['class_name'];
        $qrcode = $access['qrcode'];
        $mother = $access['mother'];
        $father = $access['father'];

        $att_student_id=$record_1;
        $att_agent_id=$_SESSION['user_name'].' '.$_SESSION['user_othername'];
        $att_day=date('l');
        $att_date=date('Y-m-d');
        $att_time=date('H:i:s');
            
        echo '<center><img src="'.$record_8.'" style="height:120px; width:120px;"></center>';
        $observation='Dear '.$record_22.',<br>
Thank You for Marking Your Attendance.
<br>Keep up the good work!<br><br>
Best regards,<br>
'.$att_agent_id.'<br>
'.$_SESSION['position_name'];

echo  "<center>".$observation."</center>";
        $save_access= $DB_con->prepare("INSERT INTO attendance(att_student_id, att_agent_id, att_day, att_date, att_time, observation) VALUES (?,?,?,?,?,?)");
       $save_access->execute(array($att_student_id,$att_agent_id,$att_day,$att_date,$att_time,$observation));
       echo '<meta http-equiv="refresh"'.'content="2; URL=?attendancerfid&title=Smart Attendance">';
      
       }
        else{ 
            echo '<meta http-equiv="refresh"'.'content="0; URL=?attendancerfid&title=Smart Attendance">';   ?>
            <center><div class="spinner"><br>Empty</div></center>  <?php }}
            catch (PDOException $ex) {$ex->getMessage();}}       






    if(isset($_GET['attendance'])) {
        $att_student_id=$_GET['attendance'];
        $student_name=$_GET['name'];
        $att_agent_id=$_SESSION['user_name'].' '.$_SESSION['user_othername'];
        $att_day=date('l');
        $att_date=date('Y-m-d');
        $att_time=date('H:i:s');
        $observation='Dear '.$student_name.',<br>
Thank You for Marking Your Attendance.
<br>Keep up the good work!<br><br>
Best regards,<br>
'.$att_agent_id.'<br>
'.$_SESSION['position_name'];

        $save_access= $DB_con->prepare("INSERT INTO attendance(att_student_id, att_agent_id, att_day, att_date, att_time, observation) VALUES (?,?,?,?,?,?)");
        $save_access->execute(array($att_student_id,$att_agent_id,$att_day,$att_date,$att_time,$observation));
        echo $success.'<meta http-equiv="refresh"'.'content="0; URL=?key='.substr($student_name,0,5).'">';}


    
    if(isset($_GET['qrcode'])){ ?>
    <div class="row">
    <div class="col-lg-12" style="text-align:justify; background-color:#ccc; padding:1%; border-radius:5px; margin:1%;"><h4>Generate QR Code</h4><hr>
    <?php 
    $student_id=$_GET['student_id'];
    $namex=$_GET['name'];
    $class=$_GET['class'];
    echo 'Dear <b>'.$_SESSION['user_othername'].'</b>, copy the following link and paste into the right side QR field, 
    then generate QR code of <b>'.$namex.'</b>, class of <b>'.$class.'</b><hr><b>Link:</b><br>'; ?>

    <div class="container">
        <!-- Left Side -->
        <div class="box" id="leftBox">https://eschool.rw/teenager_movement/pub/q/student-card?student_id=<?= $student_id; ?>&student_name=<?= $namex; ?></div>

        <!-- Right Side -->
        <div class="box" id="rightBox">
            <p style="color:green;" onclick="copyToClipboard()">Click here to COPY the above link, and then PASTE it into the below QR URL to generate new QR Code.</p>


            <div class="modal fade" id="updateqrcode" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <b><i data-feather="search"></i> QR Code of <?= $_GET['name']; ?></b>
            </div>
            <div class="modal-body">
                <div class="col-md-2"></div>
                <form class="form-horizontal" method="POST" enctype="multipart/form-data">
                    <input type="hidden" class="form-control" name="student_id" value="<?= $_GET['student_id']; ?>">
                    <input type="hidden" class="form-control" name="name" value="<?= $_GET['name']; ?>">
                    
                    <!-- Image Upload Section -->
                    <label for="picture">Upload QR Code of <?= $_GET['name']; ?></label><br>
                    <input type="file" class="form-control" id="picture" name="picture" required style="margin-bottom:2%;" accept="image/*" onchange="previewImage(event)">

                    <!-- Image Preview -->
                    <div id="imagePreviewContainer" style="margin-top: 10px;">
                        <img id="imagePreview" src="#" alt="Image Preview" style="display: none; max-width: 100%; height: auto; border: 1px solid #ddd; padding: 5px;">
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" name="save_qr" class="btn" style="background-color:#005292; float:left; width:100%; padding:2% 6% 2% 6%; color:#fff;">
                        <i data-feather="save"></i> Confirm and Save
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Function to preview the uploaded image
    function previewImage(event) {
        const imagePreview = document.getElementById('imagePreview');
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();

            reader.onload = function (e) {
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block'; // Show the preview
            };

            reader.readAsDataURL(file); // Read the file as a data URL
        } else {
            imagePreview.style.display = 'none'; // Hide the preview if no file is selected
        }
    }
</script>




        </div>
    </div>

    <!-- Button to Copy Content -->
    <div style="text-align: center;">
    <button class="btn" data-toggle="modal" data-target="#updateqrcode" style="background-color:#005292; color:#fff;">Upload generated QR Code of <?= $namex; ?></button>
    </div>

    <script>
        function copyToClipboard() {
            // Get the content of the left box
            const leftContent = document.getElementById('leftBox').innerHTML;

            // Create a temporary textarea element
            const textarea = document.createElement('textarea');
            textarea.value = leftContent; // Set the content to the textarea's value

            // Append textarea to the body
            document.body.appendChild(textarea);

            // Select the content
            textarea.select();
            textarea.setSelectionRange(0, 99999); // For mobile devices

            // Copy the content to the clipboard
            document.execCommand('copy');

            // Remove the temporary textarea
            document.body.removeChild(textarea);

            // Alert the user
            alert('Content copied to clipboard! You can paste it using Ctrl+V or the mouse.');
        }
    </script>
 
 















    </div>
    <div class="col-lg-12">
        <iframe style="float:left; width:100%; height:430px;" src="https://qrquick.io/?gad_source=5&gclid=EAIaIQobChMI5NG9h-OwiQMVirCDBx0JTAAlEAAYAyAAEgJdPfD_BwE#google_vignette"></iframe>
    </div>
    </div><?php }




if(isset($_GET['ghj'])) {
@$qry=@$_GET['ghj'];
if($qry==1){ $q=' pp.position_id NOT IN (2)'; }
else{ $q=' pp.position_id=2'; }
$limit = @$pag_limit;
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
@$offset = ($current_page - 1) * @$limit; ?>
<div class="bs-example4" data-example-id="simple-responsive-table">
<div class="table-responsive" >

<a data-toggle="modal" data-target="#set_staff" title="Record new staff" class="btn" style="float:right; margin-bottom:1%; background-color:#005292; color:#fff;"><i class="fa fa-plus"></i> Add new</a>
<?= "<span class='btn' style='float:left; margin-bottom:1%; background-color:#005292; color:#fff;'><i data-feather='list'></i> ".$_GET['title']."</span>";

$stms_access = $DB_con->prepare("SELECT * FROM registration pr INNER JOIN position pp ON pp.position_id = pr.user_position INNER JOIN country pc ON pc.country_id = pr.user_country INNER JOIN cells pcells ON pcells.Cell_ID = pr.user_cell INNER JOIN sectors psectors ON psectors.Sector_ID = pcells.Sector_ID INNER JOIN district pd ON pd.DistrictID = psectors.District_ID INNER JOIN province ppv ON ppv.ProvinceID = pd.ProvinceID INNER JOIN system ps ON ps.id = pr.school_id INNER JOIN centers AS c ON c.center_id=pr.center LEFT JOIN classes AS cl ON cl.class_id=pr.class_id WHERE $q ORDER BY ps.abbreviation, pp.position_id ASC LIMIT $limit OFFSET $offset");
try {
$stms_access->execute(array());
$row_count_access = $stms_access->rowCount();
if ($row_count_access > 0) {

// calculate total pages
$stmtf = $DB_con->prepare("SELECT COUNT(*) AS total FROM registration pr INNER JOIN position pp ON pp.position_id = pr.user_position INNER JOIN country pc ON pc.country_id = pr.user_country INNER JOIN cells pcells ON pcells.Cell_ID = pr.user_cell INNER JOIN sectors psectors ON psectors.Sector_ID = pcells.Sector_ID INNER JOIN district pd ON pd.DistrictID = psectors.District_ID INNER JOIN province ppv ON ppv.ProvinceID = pd.ProvinceID INNER JOIN system ps ON ps.id = pr.school_id INNER JOIN centers AS c ON c.center_id=pr.center LEFT JOIN classes AS cl ON cl.class_id=pr.class_id WHERE $q");
$stmtf->execute();
$result = $stmtf->fetch(PDO::FETCH_ASSOC);
@$total_pages = ceil($result['total'] / $limit);
$count=1; ?>
<table style="width:100%; ">
<thead><tr>
<th style="color:#fff; background-color:#005292; padding:0.7%;">#</th>
<th style="color:#fff; background-color:#005292; ">Name</th>
<th style="color:#fff; background-color:#005292;">Position</th>
<th style="color:#fff; background-color:#005292;">School</th>
</tr></thead><tbody>
<?php $i=1;
while($access = $stms_access->fetch(PDO::FETCH_ASSOC)) {
$record_1 = $access['user_id'];
$record_2 = $access['user_othername']." ".$access['user_name'];
$record_4 = strtolower($access['user_email']);
$record_5 = $access['user_phone'];
$record_7 = $access['user_gender'];
$record_8 = $access['user_photo'];
$record_9 = $access['user_status'];
$record_12 = $access['country_name'];
$record_13 = $access['position_name'];
$CellName = $access['CellName'];
$SectorName = $access['SectorName'];
$DistrictName = $access['DistrictName'];
$ProvinceName = $access['ProvinceName'];
$position_id = $access['position_id'];
$namen = $access['name'];
$center = $access['center_name'];
$user_reg_no = $access['user_reg_no'];
$class_name = $access['class_name'];
if($class_name==''){$class_names='';}
else{$class_names=$class_name.' - ';}
$gt=$record_1*678576100; ?>
<tr>
<td scope="row" style="<?= $color; ?>; padding:0.5%;"><?= $i++; ?></td>
<td scope="row" style="<?= $color; ?>;"><?= $record_2; ?></td>
<td style="<?= $color; ?>;"><?= $record_13; ?></td>
<td style="<?= $color; ?>"> <?= $class_names.' '.$center; ?></td>
</tr> <?php }}
else{   ?><center><div class="spinner"><br>Empty</div></center>  <?php   }}catch (PDOException $ex) {$ex->getMessage();} ?>
</tbody></table><div class="col-sm-8"><?php



echo '<div class="pagination">';
if ($current_page > 1) {
echo '<a href="?view='.$_GET['view'].'&title='.$_GET['title'].'&ghj='.$_GET['ghj'].'&page=' . ($current_page - 1) . '" class="prev">&laquo; Prev</a>'; }
$show_dots = false;
for ($i = 1; $i <= @$total_pages; $i++) {
if ($i == $current_page) {
echo '<span class="current">' . $i . '</span>';
} else {
if ($i > ($current_page - 3) && $i < ($current_page + 3)) {
echo '<a href="?view='.$_GET['view'].'&title='.$_GET['title'].'&ghj='.$_GET['ghj'].'&page='.$i.'">'.$i.'</a>';
$show_dots = true; 
} elseif ($show_dots) {
echo '...';
$show_dots = false;
}}}
if ($current_page < @$total_pages) {
echo '<a href="?view='.$_GET['view'].'&title='.$_GET['title'].'&ghj='.$_GET['ghj'].'&page=' . ($current_page + 1) . '" class="next">Next &raquo;</a>'; }
echo '</div>'; 


?></div></div>
<?php }





if(isset($_GET['reportlist'])) {
$ri=$_GET['reportlist']-55450009;
$limit = @$pag_limit;
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
@$offset = ($current_page - 1) * @$limit; ?>
<div class="bs-example4" data-example-id="simple-responsive-table">
<div class="table-responsive" >

<a href="?subcategory=DIFFERENT REPORTS" title="Record new staff" class="btn" style="float:right; margin-bottom:1%; background-color:#005292; color:#fff;"><i class="fa fa-plus"></i> Add new</a>
<?= "<span class='btn' style='float:left; margin-bottom:1%; background-color:#005292; color:#fff;'><i data-feather='list'></i> ".@$_GET['bhgnema']." Reports</span>";

$stms_access = $DB_con->prepare("SELECT * FROM registration pr INNER JOIN position pp ON pp.position_id = pr.user_position INNER JOIN country pc ON pc.country_id = pr.user_country INNER JOIN cells pcells ON pcells.Cell_ID = pr.user_cell INNER JOIN sectors psectors ON psectors.Sector_ID = pcells.Sector_ID INNER JOIN district pd ON pd.DistrictID = psectors.District_ID INNER JOIN province ppv ON ppv.ProvinceID = pd.ProvinceID INNER JOIN system ps ON ps.id = pr.school_id INNER JOIN report AS rep ON rep.report_user=pr.user_id INNER JOIN subcategory AS sub ON sub.subcat_id=rep.report_cat_id INNER JOIN main_category AS m ON m.main_cat_id=sub.main_cat_id WHERE pp.position_id NOT IN (1,2) AND rep.report_cat_id='".$ri."' ORDER BY rep.report_date_time DESC LIMIT $limit OFFSET $offset");
try {
$stms_access->execute(array());
$row_count_access = $stms_access->rowCount();
if ($row_count_access > 0) {

// calculate total pages
$stmtf = $DB_con->prepare("SELECT COUNT(*) as total FROM registration pr INNER JOIN position pp ON pp.position_id = pr.user_position INNER JOIN country pc ON pc.country_id = pr.user_country INNER JOIN cells pcells ON pcells.Cell_ID = pr.user_cell INNER JOIN sectors psectors ON psectors.Sector_ID = pcells.Sector_ID INNER JOIN district pd ON pd.DistrictID = psectors.District_ID INNER JOIN province ppv ON ppv.ProvinceID = pd.ProvinceID INNER JOIN system ps ON ps.id = pr.school_id INNER JOIN report AS rep ON rep.report_user=pr.user_id INNER JOIN subcategory AS sub ON sub.subcat_id=rep.report_cat_id INNER JOIN main_category AS m ON m.main_cat_id=sub.main_cat_id WHERE pp.position_id NOT IN (1,2) AND rep.report_cat_id='".$ri."'");
$stmtf->execute();
$result = $stmtf->fetch(PDO::FETCH_ASSOC);
$total_pages = ceil($result['total'] / $limit);
$count=1; ?>
<table style="width:100%; ">
<thead><tr>
<th style="color:#fff; background-color:#005292;">Report</th>
<th style="color:#fff; background-color:#005292; padding:0.7%;"> Date</th>
<th style="color:#fff; background-color:#005292;">Reporter</th>
<th style="color:#fff; background-color:#005292;">Contact</th>
<th style="color:#fff; background-color:#005292;" colspan="5"><center>Options</center></th>
</tr></thead><tbody>
<?php $i=1;
while($access = $stms_access->fetch(PDO::FETCH_ASSOC)) {
$record_1 = $access['user_id'];
$record_2 = $access['user_othername']." ".$access['user_name'];
$record_4 = strtolower($access['user_email']);
$record_5 = $access['user_phone'];
$record_7 = $access['user_gender'];
$record_8 = $access['user_photo'];
$record_9 = $access['user_status'];
$record_12 = $access['country_name'];
$record_13 = $access['position_name'];
$CellName = $access['CellName'];
$SectorName = $access['SectorName'];
$DistrictName = $access['DistrictName'];
$ProvinceName = $access['ProvinceName'];
$position_id = $access['position_id'];
$namen = $access['name'];
$center = $access['center'];
// Report
$report_id = $access['report_id'];
$report_cat_id = $access['report_cat_id'];
$report_date = $access['report_date'];
$report_info = $access['report_info'];
$report_info2 = nl2br($access['report_info']);
$report_image = $access['report_image'];
$report_date_time = $access['report_date_time'];
$report_date_time2 = substr($access['report_date_time'],0,10);
$dnow=date('Y-m-d');
$report_status = $access['report_status'];
// Sub category
$subcat_id = $access['subcat_id'];
$subcat_name = $access['subcat_name'];
// Main category
$main_cat_id = $access['main_cat_id'];
$main_cat_name = $access['main_cat_name'];
$report_id2=$report_id+343444009;
?>

<tr>
<td scope="row" style="color:#000;"><?= $i++.'. '.$subcat_name; ?></td>
<td style="color:#000;"><?= $report_date; ?></td>
<td style="color:#000;"><?= $record_2.', '.$record_13; ?></td>
<td style="color:#000;"><?= $record_5; ?></td>
<td style="<?= $color; ?>;"><a data-toggle="modal" data-target="#detailreport<?= $report_id; ?>"> <i data-feather="external-link"></i> Report</a>
<!-- Details report -->
<div class="modal fade" id="detailreport<?= $report_id; ?>" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header">
<strong style="width:100%;"><center><i data-feather="list"></i> Details of this  <?= @$subcat_name; ?>'s Report
</center></strong></div><div class="modal-body"><div class="col-md-2"></div><div class="col-md-12">
Reporter: <strong><?= $record_2; ?></strong><br>
Reporter Contact: <strong><?= $record_5; ?></strong><br>
Center: <strong><?= $center; ?></strong><hr>
<strong>Report Category:</strong> <?= $subcat_name; ?><br>
<strong>Report Date:</strong> <?= @$report_date; ?><br>
<strong>Reporting Date:</strong> <?= @$report_date_time; ?><br>
<?php if($report_image==''){} else{ ?>
<strong>Report picture:</strong> <img src="<?= $report_image; ?>" style="height:auto; width:100%;"><br><?php } ?>
<strong>Report Description:</strong> <?= @$report_info2; ?><br>
</div></div></div></div></div>        
<!-- Details report -->

</td>

<td><a data-toggle="modal" data-target="#editreport<?= $report_id; ?>" style="color:#005292; margin-bottom:2%; float:left; width:100%; text-align:left;" title="Edit"><i data-feather="edit"></i> Update </a>

<!-- Hotel: 0788521208
     Hotel: 078539 -->

<!-- Upload new report -->
<div class="modal fade" id="editreport<?= $report_id; ?>" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header">
<strong style="width:100%;"><center><i data-feather="edit"></i> Edit this  <?= @$subcat_name; ?>'s Report
</center></strong></div><div class="modal-body"><div class="col-md-2"></div><div class="col-md-12">
<form class="form-horizontal" method="POST" enctype="multipart/form-data">
<input type="hidden" name="report_id" value="<?= $report_id; ?>">
    <!-- Item Sub Category Selection -->
    <div style="float:left; width:49%;">
        <?php 
        $stmta = $DB_con->prepare("SELECT * FROM subcategory AS sc RIGHT JOIN main_category AS mc ON mc.main_cat_id=sc.main_cat_id WHERE sc.subcat_status='Active' AND sc.subcat_id!='".$subcat_id."' ");
        $stmta->execute(); 
        $iira=2; 
        ?>
        <select name="subcat_id" required class="form-control" style="margin-bottom:1%;">
            <option value="<?= $subcat_id; ?>">1. <?= $subcat_name; ?></option>
            <?php while($rowa = $stmta->fetch(PDO::FETCH_ASSOC)) { ?>
                <option value="<?= $rowa['subcat_id']; ?>"><?= $iira++.'. '.$rowa['subcat_name']; ?></option>
            <?php } ?>
        </select>
    </div>

    <!-- Date -->
    <div style="float:right; width:49%;">
        <input type="date" required name="date" placeholder="Report date..." max="<?= date('Y-m-d'); ?>" value="<?= @$report_date; ?>" class="form-control" autofocus>
    </div>

      <!-- Item Description -->
    <textarea name="info" placeholder="Report description..." style="height:120; margin:2% 0% 2% 0%;" class="form-control"><?= @$report_info2; ?></textarea>
    Existing picture: <img src="<?= $report_image; ?>" style="height:150px; width:auto;"><br>
    <!-- Upload Image and Preview -->
    Upload new supporting picture <i style="color:indianred;">(If Any)</i>
    <input type="hidden" name="picture2" value="<?= $report_image; ?>">
    <input type="file" name="picture" id="imageInput" accept="image/*" class="form-control" onchange="previewImage(event)">
    <img id="imagePreview" src="" alt="Image Preview" style="display: none; margin-top: 10px; width:auto; height:80px;">

    <!-- Submit Button -->
    <button type="submit" name="save_report_edited" class="btn" style="background-color:#005292; width:100%; float:left; margin-top:2%; padding:2% 6% 2% 6%; color:#fff;">
        <i data-feather="save"></i> Confirm and Save
    </button>
</form>
  
<script>
    function previewImage(event) {
        const imageInput = event.target;
        const preview = document.getElementById("imagePreview");

        // Check if a file is selected
        if (imageInput.files && imageInput.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = "block"; // Show the image preview
            };

            reader.readAsDataURL(imageInput.files[0]); // Convert the image file to a URL
        }
    }
</script>
</div></div></div></div></div>        
<!-- End of upload report -->






</td>


</tr> <?php }}
else{   ?><center><div class="spinner"><br>Empty</div></center>  <?php   }}catch (PDOException $ex) {$ex->getMessage();} ?>
</tbody></table><div class="col-sm-8"><?php
echo '<div class="pagination">';
if ($current_page > 1) {
echo '<a href="?reportlist=REPORTS&reportlist='.$_GET['reportlist'].'&page=' . ($current_page - 1) . '" class="prev">&laquo; Prev</a>'; }
$show_dots = false;
for ($i = 1; $i <= @$total_pages; $i++) {
if ($i == $current_page) {
echo '<span class="current">' . $i . '</span>';
} else {
if ($i > ($current_page - 3) && $i < ($current_page + 3)) {
echo '<a href="?reportlist=REPORTS&reportlist='.$_GET['reportlist'].'&page='.$i.'">'.$i.'</a>';
$show_dots = true; 
} elseif ($show_dots) {
echo '...';
$show_dots = false;
}}}
if ($current_page < @$total_pages) {
echo '<a href="?reportlist=REPORTS&reportlist='.$_GET['reportlist'].'&page=' . ($current_page + 1) . '" class="next">Next &raquo;</a>'; }
echo '</div>'; ?></div></div>
<?php }






if(isset($_GET['profilexx'])) { 
$stms_access = $DB_con->prepare("SELECT * FROM country, position, registration, province, district, sectors, cells, centers WHERE registration.user_position=position.position_id AND registration.user_country=country.country_id AND registration.user_cell=cells.Cell_ID AND cells.Sector_ID=sectors.Sector_ID AND sectors.District_ID=district.DistrictID AND district.ProvinceID=province.ProvinceID AND centers.center_id=registration.center AND registration.user_id='".$_GET['profilexx']."'");
try {
$stms_access->execute(array());
$row_count_access = $stms_access->rowCount();
if ($row_count_access > 0) { ?>
<div class="row">
    <div class="col-lg-1"></div>
    <div class="col-lg-9">
<table>
<thead>
<tr>
<th colspan="2" ><h3><i data-feather="user"></i> Update <?= $_GET['user_name_to_editxx']; ?></h3></th>
</tr></thead><tbody>
<?php $i=1;
while($access = $stms_access->fetch(PDO::FETCH_ASSOC)) { 
$record_0 = $access['user_id'];
$record_1 = $access['user_othername'];
$record_2 = $access['user_name'];
$record_3 = $access['user_reg_no'];
$record_4 = $access['user_email'];
$record_5 = $access['user_phone'];
$record_7 = $access['user_gender'];
$record_8 = $access['user_photo'];
$record_9 = $access['user_status'];
$record_10 = $access['username'];
$record_11 = $access['user_password'];
$record_12 = $access['country_name'];
$record_13 = $access['position_name'];
$position_id = $access['position_id'];
$ProvinceName = $access['ProvinceName'];
$DistrictName = $access['DistrictName'];
$SectorName = $access['SectorName'];
$CellName = $access['CellName'];
$center = $access['center_name'];
$qrcode = $access['qrcode'];
$father = $access['father'];
$mother = $access['mother']; ?>
<tr>
<td style="color:#000;"><center><img src="<?= $record_8; ?>" style="border-radius:5px; width:225px; height:auto;"></center></td>
<td style="color:#000; padding:0% 0% 0% 8%;">
<span style="color:#005292;"><?= $record_13.' '. $record_1.' '.$record_2; ?></span><br>
<u>Contact</u>: <span style="color:#005292;"><?= $record_5; ?></span><br>  
<u>Email</u>: <span style="color:#005292;"><?= $record_4; ?></span><br>
<u>Country</u>: <span style="color:#005292;"><?= $record_12; ?></span><br> 
<u>School</u>: <span style="color:#005292;"><?= $center; ?></span><br>
</td>

</tr>
<?php
}} else{   ?><center>Table is empty.<br><div class="spinner"></div></center>  <?php   } } catch (PDOException $ex) { $ex->getMessage(); }
?>
</tbody></table></div></div></div></div>

<?php
}

if(isset($_GET['RestoreUser'])) { 
$RestoreUser=$_GET['RestoreUser'];
$posi=$_GET['posi'];
@$view_clients_in=$_GET['view_clients_in'];
@$view_clients_in_name=$_GET['view_clients_in_name'];
$sql = "UPDATE registration SET user_status = 1 WHERE registration.user_id = :RestoreUser";
$stmt = $DB_con->prepare($sql);
$stmt->bindParam(':RestoreUser', $RestoreUser, PDO::PARAM_INT);   
$stmt->execute();
echo $success. '<meta http-equiv="refresh"'.'content="0; URL=?view=LIST%20OF%20STUDENTS&title=List%20of%20all%20students&ghj='.$posi.'">';}




if(isset($_POST['cardno'])) { 
    $newcardno=$_POST['cardno'];
    $user_id=$_POST['user_id'];
    $sql = "UPDATE registration SET user_reg_no =:newcardno WHERE user_id=:user_id";
    $stmt = $DB_con->prepare($sql);
    $stmt->bindParam(':newcardno', $newcardno, PDO::PARAM_INT); 
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);   
    $stmt->execute();
    echo $success. '<meta http-equiv="refresh"'.'content="0; URL=#">';}



if(isset($_GET['EditUser_by_id'])) { 
$data_0=$_GET['EditUser_by_id'];
$data_1=$_GET['EditUser_by_fname'];
$data_2=$_GET['EditUser_by_lname'];
$data_3=$_GET['EditUser_by_email'];
$data_4=$_GET['EditUser_by_phone'];
$data_6=$_GET['EditUser_by_username'];
$data_7=$_GET['EditUser_by_password'];
$data_8=$_GET['EditUser_by_position'];
$data_9=$_GET['EditUser_by_reg_no'];
$data_10=$_GET['EditUser_by_reg_gender'];	
$position=$_GET['posi'];
$position1=$_GET['posi']; 
$father=$_GET['father']; 
$mother=$_GET['mother']; ?>

<div class="row">
    <div class="col-lg-2"></div>
    <div class="col-lg-8">
<form class="form-horizontal" method="POST"  enctype="multipart/form-data" style="color:#005292;">
<?= " <h4 style='float:left; width:100%; margin:2% 0% 2% 0%; color:#fff; background-color:#005292;' class='btn'><i class='fa fa-list-ul'></i> UPDATE <b>".$data_2." ".$data_1."</b></h4>"; ?><br>
<div style="float:left; width:49%;">
Name<br>
<input type="hidden" class="form-control" name="data_0" value="<?= $data_0; ?>">
<input type="hidden" class="form-control" name="position" value="<?= $position; ?>">
<input type="text" class="form-control" name="data_1" value="<?= $data_1; ?>" required></div>
<div style="float:right; width:49%;">Other name<br>
<input type="text" class="form-control" name="datax_1" value="<?= $data_2; ?>" required></div>
<div style="float:left; width:49%;">
Gender<br />
<select class="form-control" required name="gender">
<option value="<?= $_GET['EditUser_by_reg_gender']; ?>"><?= $_GET['EditUser_by_reg_gender']; ?></option>
<option value="Male">Male</option>
<option value="Female">Female</option>
</select></div>

<div style="float:right; width:49%;">
Position<br>

<select class="form-control" name="position_id" required>
<option value="<?= $position1; ?>"><?= '1. '.$data_8; ?></option>
<?php $stms_position = $DB_con->prepare("SELECT * FROM position as p WHERE p.position_id NOT IN ('".$_GET['posi']."',4)   AND p.position_status=1 ORDER BY p.position_name ASC");
try {
$stms_position->execute(array());
$row_count_position = $stms_position->rowCount();
if ($row_count_position > 0) {  $poo=2;
while($position = $stms_position->fetch(PDO::FETCH_ASSOC)) { 
$position_id=$position['position_id'];	
$position_name=$position['position_name']; ?>
<option value="<?= $position_id; ?>"><?= $poo++.'. '.$position_name; ?></option><?php }}else{} } catch (PDOException $ex) { $ex->getMessage(); } ?>
</select></div>


<div style="float:left; width:49%;">
Email<br>
<input type="text" class="form-control" name="data_2" value="<?= $data_3; ?>" required></div>
<div style="float:right; width:49%;">Phone<br><input type="text" class="form-control" name="data_3" value="<?= $data_4; ?>" required></div>

<div style="float:left; width:49%;">Father<br>
<input type="text" class="form-control" name="father" value="<?= $father; ?>" placeholder="Father..." required></div>
<div style="float:right; width:49%;">Mother<br>
<input type="text" class="form-control" name="mother" value="<?= $mother; ?>" placeholder="Mother..." required></div>


<div style="float:left; width:49%;">Username<br>
<input type="text" class="form-control" name="data_5" value="<?= $data_6; ?>" required></div>
<div style="float:right; width:49%;">Password<br>
<input type="password" class="form-control" name="data_6" placeholder="Password..." style="margin-bottom:2%;" required></div>

<button type="submit" name="save_update"  class="btn" style="background-color:#005292; width:100%; color:#fff;"><i data-feather="save"></i> Save the changes</button></div></div></div></form></div><?php }


//================REGISTER NEW USER
if(isset($_POST['save_update'])) {
@$data_0=$_POST['data_0'];//============id
@$data_1=$_POST['data_1'];//============fname
@$datax_1=$_POST['datax_1'];//============lname
@$name=$data_1.''.$datax_1;
@$data_2=$_POST['data_2'];//============email
@$data_3=$_POST['data_3'];//============phone
@$data_5=$_POST['data_5'];//============username
@$gender=$_POST['gender'];//============gender
@$reg_no=$_POST['reg_no'];//============reg_no
@$father=$_POST['father'];//============reg_no
@$mother=$_POST['mother'];//============reg_no
@$position=$_POST['position_id'];//============position
@$data_6=md5($_POST['data_6']);//============password

$sql = "UPDATE registration SET user_othername = :data_1, user_name = :datax_1, user_email = :data_2, user_phone = :data_3, user_gender=:gender, username = :data_5, user_password = :data_6, user_position=:position, father=:father, mother=:mother WHERE registration.user_id = :data_0";
$stmt = $DB_con->prepare($sql);
$stmt->bindParam(':data_0', $data_0, PDO::PARAM_INT); 
$stmt->bindParam(':data_1', $data_1, PDO::PARAM_INT); 
$stmt->bindParam(':datax_1', $datax_1, PDO::PARAM_INT); 
$stmt->bindParam(':data_2', $data_2, PDO::PARAM_INT); 
$stmt->bindParam(':data_3', $data_3, PDO::PARAM_INT); 
$stmt->bindParam(':data_5', $data_5, PDO::PARAM_INT); 
$stmt->bindParam(':data_6', $data_6, PDO::PARAM_INT); 
$stmt->bindParam(':gender', $gender, PDO::PARAM_INT);
$stmt->bindParam(':position', $position, PDO::PARAM_INT);   
$stmt->bindParam(':father', $father, PDO::PARAM_INT);   
$stmt->bindParam(':mother', $mother, PDO::PARAM_INT);   
$stmt->execute();
if($data_0==$_SESSION['user_id']){ echo $success.'<meta http-equiv="refresh"'.'content="0; URL=logout?logout">'; }
else{ echo $success.'<meta http-equiv="refresh"'.'content="0; URL=?key='.$data_5.'">'; }}


    if(isset($_POST['save_class'])) {
        $data_2=$_POST['class_name'];
        $data_3=1;	
        $save_access= $DB_con->prepare("INSERT INTO classes (class_name, class_status) 
        VALUES (?,?)");
        $save_access->execute(array($data_2,$data_3));
        echo $success.'<meta http-equiv="refresh"'.'content="0; URL=?listofclasses=LIST OF CLASSES">';}

 

if(isset($_GET['EditImage'])) { 
echo " <h4 style='margin-left:2%;'><i class='fa fa-list-ul'></i> Update picture of <u>".$_GET['Title']."</u></h4>"; ?>
<form class="form-horizontal" method="POST"  enctype="multipart/form-data" style="min-height:200px;">
<div class="form-group">
<div class="col-lg-6">
<input type="hidden" class="form-control" name="data_0" value="<?= $_GET['EditImage']; ?>">
Existing picture<br>
<img src="<?= $_GET['photo']; ?>" style="width:300px; height:auto; border-radius:3px; "><br />
Upload new<br>
<input type="file" class="form-control" name="picture_index" required>

<br><br><br>
<div class="col-sm-8">
<input type="submit" name="save_update_picture_index" class="btn" style="background-color:#005292; padding:2% 6% 2% 6%; color:#fff;" value="Accept the updating">
<button type="button" class="btn" style="color:#fff; background-color:#000; float:right;" onClick="goBack()"><i class="fa fa-rotate-left"></i> Back</button>
</div></div></div>
</form>

<?php
}







if(isset($_GET['EditPicture'])) { ?><form class="form-horizontal" method="POST"  enctype="multipart/form-data">
<div class="row">
    <div class="col-lg-3"></div>
    <div class="col-lg-6">
<input type="hidden" class="form-control" name="data_0" value="<?= $_GET['EditPicture']; ?>">
<input type="hidden" class="form-control" name="view_clients_inx" value="<?= $_GET['EditUser_by_position']; ?>">
<input type="hidden" class="form-control" name="view_clients_in_namex" value="<?= $_GET['EditUser_by_lname']; ?>">

<h4 style='margin:2% 0% 2% 0%; background-color:#005292; float:left; width:100%; color:#fff;' class='btn'><i class='fa fa-list-ul'></i> Update picture of <?= $_GET['EditUser_by_lname']; ?></h4>
<center>
Existing picture<br>
<img src="<?= $_GET['EditUser_by_photo']; ?>" style="width:180px; height:auto; border-radius:3px;"></center><br>
Upload new<br>
<input type="file" class="form-control" name="picture" required style="margin-bottom:2%;">

<button type="submit" name="save_update_picture" class="btn" style="background-color:#005292; float:left; width:100%; padding:2% 6% 2% 6%; color:#fff;"><i data-feather="save"></i> Save changes</button></div></div>
</form>
</div>
<?php
}


                    if(isset($_POST['save_qr'])) {
                        @$student_id=$_POST['student_id'];
                        @$name=$_POST['name'];
                        //============RENAMING THE PICTURE
                        $target_file = explode(".", $_FILES["picture"]["name"]);
                        $newfilename = date('Y')."_".round(microtime(true)) . '.' . end($target_file);
                        move_uploaded_file($_FILES["picture"]["tmp_name"], "images/" . $newfilename);	
                        $file_to_table="images/".$newfilename;
                        //============INSERT THE PICTURE INTO THE TABLE	
                        $sql = "UPDATE registration SET qrcode =:file_to_table WHERE registration.user_id = :student_id";	
                        $stmt = $DB_con->prepare($sql);
                        $stmt->bindParam(':file_to_table', $file_to_table, PDO::PARAM_INT);
                        $stmt->bindParam(':student_id', $student_id, PDO::PARAM_INT);    
                        $stmt->execute();
                        echo $success. '<meta http-equiv="refresh"'.'content="0; URL=?key='.substr($name,0,5).'">';
                        //==================== END OF MESSAGE TO DISPLAY====================== 
                        }
                    



if(isset($_POST['save_update_picture'])) {
@$user_id=$_POST['data_0'];
@$view_clients_in_namex=$_POST['view_clients_in_namex'];
//============RENAMING THE PICTURE
$target_file = explode(".", $_FILES["picture"]["name"]);
$newfilename = date('Y')."_".round(microtime(true)) . '.' . end($target_file);
move_uploaded_file($_FILES["picture"]["tmp_name"], "images/" . $newfilename);	
$file_to_table="images/".$newfilename;
//============INSERT THE PICTURE INTO THE TABLE	
$sql = "UPDATE registration SET user_photo =:file_to_table WHERE registration.user_id = :user_id";	
$stmt = $DB_con->prepare($sql);
$stmt->bindParam(':file_to_table', $file_to_table, PDO::PARAM_INT);
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);    
$stmt->execute();
echo $success. '<meta http-equiv="refresh"'.'content="0; URL=?view=LIST OF STAFF&title=List of all staff&ghj=1">';
//==================== END OF MESSAGE TO DISPLAY====================== 
}



if(isset($_POST['save_staff'])) {
    $center=$_POST['center'];
    $position=$_POST['position'];
    $class_id=$_POST['class_id'];
    if($class_id==''){$class_ids='';}
    else{$class_ids=$class_id;}
    $fingerprint=date('YmdHis');
    
$school_id=1;
$last_name=strtoupper($_POST['last_name']);
$last_namen=substr(($_POST['last_name']),0,1);
$first_name=ucwords($_POST['first_name']);
$user_email=strtolower($_POST['email']);
$gender=$_POST['gender'];
$country=1;
$cell_id=25;
$user_phone=$_POST['phone'];
$username=$_POST['username'];
$father=$_POST['father'];
$mother=$_POST['mother']; 
$rfid=$_POST['rfid']; 
$password=md5($_POST['password']);
$status=1;
$fingerprints='No need';
$time_date=date('l d-m-Y h:i:s A');
$female="images/images/female.gif";
$male="images/images/man.jpg";
if($gender=='Male'){ $picture=$male; $dear='Sir'; } 
else{ $picture=$female;  $dear='Madame'; } 

$save_staffN= $DB_con->prepare("INSERT INTO registration ( user_othername, user_name,user_email, user_phone, user_gender, user_photo, user_country, user_cell, user_position, username, user_password, reg_time_date, user_status, school_id, center, user_thingerprint, class_id, father, mother, rfid) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
$save_staffN->execute(array( $last_name, $first_name, $user_email, $user_phone, $gender, $picture, $country, $cell_id, $position, $username, $password, $time_date, $status, $school_id, $center, $fingerprints, $class_ids, $father, $mother, $rfid));
 ?>
<div id="sms"><br />Dear <?= $dear; ?> <b><?= $last_name." ".$first_name; ?></b> you are well registered. <br>Remember that your <br> <u>Username:</u> <b><?= $username; ?></b> <br></div>
<?= '<meta http-equiv="refresh"'.'content="0; URL=?key='.$user_email.'">'; } ?>





<!-- NEW STAFF-->
<div class="modal fade" id="set_staff" aria-hidden="true"><div class="modal-dialog"><div class="modal-content">
    <div class="modal-header"><center><a class="modal-title btn"><i data-feather="user-plus"></i> NEW ENROLLMENT</a></center></div><div class="modal-body"><div class="col-md-2"></div><div class="col-md-12">
    <form class="form-horizontal" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <div class="col-sm-12">

            <!-- School Selection -->
            <select name="center" class="form-control" required style="margin:1% 0% 1% 0%; float:left; width:49%;">
                <!-- <option value=''>Select school</option> -->
                <?php
                $stms_address2 = $DB_con->prepare("SELECT * FROM centers where center_status=1 ORDER BY center_name ASC");
                try {
                    $stms_address2->execute(array());
                    $row_count_address2 = $stms_address2->rowCount();
                    if ($row_count_address2 > 0) {
                        $poo2 = 1;
                        while ($address2 = $stms_address2->fetch(PDO::FETCH_ASSOC)) {
                            $center_id = $address2['center_id'];
                            $center_name = $address2['center_name'];
                ?>
                            <option value='<?= $center_id; ?>'><?= $poo2++ . '. ' . $center_name; ?></option>
                <?php
                        }
                    } else {
                ?>
                        <center>Table is empty.<br>
                            <div class="spinner"></div>
                        </center>
                <?php
                    }
                } catch (PDOException $ex) {
                    $ex->getMessage();
                }
                ?>
            </select>

            <!-- Position Selection -->
            <select id="position" name="position" class="form-control" required style="margin:1% 0% 1% 0%; float:right; width:49%;">
                <option value=''>Select position</option>
                <?php
                $stms_address = $DB_con->prepare("SELECT * FROM position ORDER BY position.position_name ASC");
                try {
                    $stms_address->execute(array());
                    $row_count_address = $stms_address->rowCount();
                    if ($row_count_address > 0) {
                        $poo = 1;
                        while ($address = $stms_address->fetch(PDO::FETCH_ASSOC)) {
                            $position_id = $address['position_id'];
                            $position_name = $address['position_name'];
                ?>
                            <option value='<?= $position_id; ?>'><?= $poo++ . '. ' . $position_name; ?></option>
                <?php
                        }
                    } else {
                ?>
                        <center>Table is empty.<br>
                            <div class="spinner"></div>
                        </center>
                <?php
                    }
                } catch (PDOException $ex) {
                    $ex->getMessage();
                }
                ?>
            </select>

            <!-- Other Input Fields -->
            <input type="text" class="form-control" name="last_name" style="margin:1% 0% 1% 0%;" required autofocus title="Use uppercase" placeholder="Last name (eg: NTWALI)">
            <input type="text" class="form-control" name="first_name" style="margin:1% 0% 1% 0%; text-transform:capitalize;" required placeholder="First name (eg: Aime Blessing)">
            <input type="radio" value="Male" checked="checked" name="gender" /> Male
            <input type="radio" value="Female" name="gender" /> Female<br>
            <input type="text" class="form-control" name="phone" maxlength="10" pattern="[0-9]{10}" style="margin:1% 0% 1% 0%; float:left; width:49%;" required placeholder="Phone...(07-----)">
            <input type="email" class="form-control" name="email" style="margin:1% 0% 1% 0%; float:right; width:49%;" required placeholder="Email...">
            <input type="text" class="form-control" name="username" style="margin:1% 0% 1% 0%;" required placeholder="Username...">
            <input type="password" class="form-control" name="password" style="margin:1% 0% 1% 0%;" required placeholder="Password...">

            <!-- Class Dropdown -->
            <div id="class-container" style="margin:1% 0% 1% 0%; float:right; width:100%; display: none;">
                <select name="class_id" class="form-control">
                    <option value=''>Select class</option>
                    <?php
                    $stms_address = $DB_con->prepare("SELECT * FROM classes ORDER BY class_name ASC");
                    try {
                        $stms_address->execute(array());
                        $row_count_address = $stms_address->rowCount();
                        if ($row_count_address > 0) {
                            $poox = 1;
                            while ($address = $stms_address->fetch(PDO::FETCH_ASSOC)) {
                                $class_id = $address['class_id'];
                                $class_name = $address['class_name'];
                    ?>
                                <option value='<?= $class_id; ?>'><?= $poox++ . '. ' . $class_name; ?></option>
                    <?php
                            }
                        } else {
                    ?>
                            <center>Table is empty.<br>
                                <div class="spinner"></div>
                            </center>
                    <?php
                        }
                    } catch (PDOException $ex) {
                        $ex->getMessage();
                    }
                    ?>
            </select>
            Father name
            <input type="text" class="form-control" name="father" style="margin:1% 0% 1% 0%;" placeholder="Father...">
            Mother name
            <input type="text" class="form-control" name="mother" style="margin:1% 0% 1% 0%;" placeholder="Mother...">
            RFID Card ID
            <input type="text" class="form-control" name="rfid" style="margin:1% 0% 1% 0%;" placeholder="RFID Card ID">
            </div>

        </div>
    </div>
    <br>
    <div style="float:left; width:100%; padding:1%;"></div>
    <!-- Buttons -->
    <button type="submit" class="btn" name="save_staff" style="background-color:#005292;color:#fff; float:right;"><span data-feather="save"></span> Confirm and Save</button>
    <span data-dismiss="modal" class="btn btn-danger" style="float:left;"><i data-feather="x"></i> Close</span>
</form>

<script>
    document.getElementById('position').addEventListener('change', function () {
        const classContainer = document.getElementById('class-container');
        if (this.value === '2') { // Show class dropdown if position is 2
            classContainer.style.display = 'block';
        } else { // Hide class dropdown for other positions
            classContainer.style.display = 'none';
        }
    });
</script>


	</div></div></div></div></div>




    </section>
    </div>
    </div>
    </div>

    </div>
    </div>
 <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-left">
                        <p>2024 &copy; <?= @$abbreviation ; ?></p>
                    </div>
                    <div class="float-right">
                        <p>Developed by <a href="#"> <?= $developedby; ?></a></p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="public_html/assets/js/feather-icons/feather.min.js"></script>
    <script src="public_html/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="public_html/assets/js/app.js"></script>    
    <script src="public_html/assets/vendors/chartjs/Chart.min.js"></script>
    <script src="public_html/assets/vendors/apexcharts/apexcharts.min.js"></script>
    <script src="public_html/assets/js/pages/dashboard.js"></script>
    <script src="public_html/assets/js/main.js"></script>
<script src="js/script.js" type="text/javascript"></script>
<script src="js/script_2.js" type="text/javascript"></script>
<script src="js/script_faculty.js" type="text/javascript"></script>

	
	
    <script src="public_html/assets/js/pages/dashboard.js"></script>	
    <script src="public_html/assets/vendors/chartjs/Chart.min.js"></script>
    <script src="public_html/assets/vendors/apexcharts/apexcharts.min.js"></script>

<script>
var blink = document.getElementById('blink');
setInterval(function() 
{
blink.style.opacity = (blink.style.opacity == 0 ? 1 : 0);
}, 1000); 
</script>

<script type="text/javascript">
$(document).ready(function()
{
$('.search-box input[type="text"]').on("keyup input", function(){
/* Get input value on change */
var inputVal = $(this).val();
var resultDropdown = $(this).siblings(".result");
if(inputVal.length){
$.get("search_student_now.php", {student: inputVal}).done(function(data){
// Display the returned data in browser
resultDropdown.html(data);
});
} else{
resultDropdown.empty();
}
});

// Set search input value on click of result item
$(document).on("click", ".result p", function(){
$(this).parents(".search-box").find('input[type="text"]').val($(this).text());
$(this).parent(".result").empty();
});
});
</script>
</body>
</html>
