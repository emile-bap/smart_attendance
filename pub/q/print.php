
<link rel="shortcut icon" href="<?= @$logo; ?>">

<style>
*{ font-size:14px; color:#000;}
td,th{ padding:0.4%; }
td{ color:#000; }
.img{ height:auto; width:180px; border-radius:5px; padding:1%; border:1px solid #00B1B5;}
.img:hover{ height:auto; width:100%; border-radius:5px; padding:1%; border:1px solid #00B1B5;}
    </style>

<?php
session_start();
// if(@$_SESSION['user_id']) { }
// else {echo @$failed.'<meta http-equiv="refresh"'.'content="0; URL=logout?logout='.@$_SESSION['user_id'].'">'; } 
include "connection.php"; 
include 'header_printing.php'; 



//============================person report
if(isset($_GET['personreport'])) {
    $get=$_GET['personreport'];
    if($get != ''){ $selectid=$get/87800900; $gof= "WHERE rep.report_user='".$selectid."'"; }
    else{$selectid=''; $gof='';}
     ?>
    <div class="bs-example4" data-example-id="simple-responsive-table">
    <div class="table-responsive" >

    <?= "<span class='btn' style='float:left; margin-bottom:1%; background-color:#00B1B5; color:#fff;'><i class='fa fa-list'></i> ".$_GET['title']."</span>"; ?>
    <?php $stms_access = $DB_con->prepare("SELECT * FROM registration pr INNER JOIN position pp ON pp.position_id = pr.user_position INNER JOIN country pc ON pc.country_id = pr.user_country INNER JOIN cells pcells ON pcells.Cell_ID = pr.user_cell INNER JOIN sectors psectors ON psectors.Sector_ID = pcells.Sector_ID INNER JOIN district pd ON pd.DistrictID = psectors.District_ID INNER JOIN province ppv ON ppv.ProvinceID = pd.ProvinceID INNER JOIN system ps ON ps.id = pr.school_id INNER JOIN report AS rep ON rep.report_user=pr.user_id INNER JOIN subcategory AS sub ON sub.subcat_id=rep.report_cat_id INNER JOIN main_category AS m ON m.main_cat_id=sub.main_cat_id INNER JOIN centers AS c ON c.center_id=pr.center $gof ORDER BY rep.report_date_time DESC");
    try {
    $stms_access->execute(array());
    $row_count_access = $stms_access->rowCount();
    if ($row_count_access > 0) {
    $count=1; ?>
    <table style="width:100%; ">
    <thead><tr>
    <th style="color:#fff; background-color:#00B1B5;">Reporter</th>
    <th style="color:#fff; background-color:#00B1B5; padding:0.7%;"> Dates</th>
    <th style="color:#fff; background-color:#00B1B5;">Supporting picture & Document</th>
    <th style="color:#fff; background-color:#00B1B5;">Description & Comment</th>
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
    $comment = nl2br($access['comment']);
    // Report
    $report_id = $access['report_id'];
    $report_cat_id = $access['report_cat_id'];
    $report_date = $access['report_date'];
    $report_info = $access['report_info'];
    $report_info2 = nl2br($access['report_info']);
    $report_image = $access['report_image'];
    $report_doc = $access['report_doc'];
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
    <td scope="row" style="color:#000;" valign="top">Report No: <?= $i++; ?><br>
    Reporter: <strong><?= $record_2; ?></strong><br>
    Reporter Contact: <strong><?= $record_5; ?></strong><br>
    Center: <strong><?= $center; ?></strong></td>
    <td style="color:#000;" valign="top"><strong>Report Category:</strong> <?= $subcat_name; ?><br>
    <strong>Report Date:</strong> <?= @$report_date; ?><br>
    <strong>Reporting Date:</strong> <?= @$report_date_time; ?></td>
    <td style="<?= $color; ?>;" valign="top">
    <?php if($report_image==''){} else{ ?>
    <img src="<?= $report_image; ?>" class="img"><br><?php } 
    
    if($report_doc==''){} else{ ?>
        <strong>Report document:</strong> <a href="<?= $report_doc; ?>" target="_blank"><i class="fa fa-download"></i> Download document</a><br><?php }
     ?>
        </td>
        
    <td style="<?= $color; ?>;" valign="top">
    <?php 
    if($comment==''){} else{ ?>
    <strong>Report comment:</strong><br><?= @$comment; ?><br><br><?php }
    ?>
    <strong>Report Description:</strong><br><?= @$report_info2; ?>
        </td>
   
        </tr>  <?php }}
    else{  ?><center>Table is empty. <br><div class="spinner"></div></center>  <?php   }}catch (PDOException $ex) {$ex->getMessage();} ?>
    </tbody></table><div class="col-sm-8"> </div></div>
    <?php }    
//============================end person report







if(isset($_GET['printallinvof'])) {
    $limit = @$pag_limit;
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
@$offset = ($current_page - 1) * @$limit; ?>
<div class="bs-example4" data-example-id="simple-responsive-table">
<div class="table-responsive" >

<?php $stms_access = $DB_con->prepare("SELECT * FROM registration pr INNER JOIN 
position pp ON pp.position_id = pr.user_position INNER JOIN 
country pc ON pc.country_id = pr.user_country INNER JOIN 
cells pcells ON pcells.Cell_ID = pr.user_cell INNER JOIN 
sectors psectors ON psectors.Sector_ID = pcells.Sector_ID INNER JOIN 
district pd ON pd.DistrictID = psectors.District_ID INNER JOIN 
province ppv ON ppv.ProvinceID = pd.ProvinceID INNER JOIN system 
ps ON ps.id = pr.school_id INNER JOIN 
centers AS c ON c.center_id=pr.center INNER JOIN classes AS cl ON
cl.class_id=pr.class_id WHERE pr.user_id='".$_GET['printallinvof']."'");
try {
$stms_access->execute(array());
$row_count_access = $stms_access->rowCount();
if ($row_count_access > 0) {
$count=1; ?>
<table style="width:100%; ">
<thead><tr>
<th style="color:#fff; background-color:#005292; padding:0.7%;"> Student Details</th>
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
if($class_name==''){$class_names='';}
else{$class_names=$class_name.'';}
$gt=$record_1*678576100; ?>
<tr>
<td scope="row" style="color:#000; padding:0.5%;">
Name: <b><?= $record_22; ?></b><br>
Gender: <b><?= $record_7; ?></b><br>
Email: <b><?= $record_4; ?></b><br>
Phone: <b><?= $record_5; ?></b><br>
Class: <b><?= $class_names; ?></b><br>
School: <b><?= $center; ?></b></td>
</tr> 


<tr>
<?php
$stms_invoice_paid = $DB_con->prepare("SELECT * FROM payment AS p LEFT JOIN registration AS r ON r.user_id=p.paid_student_id WHERE p.paid_student_id='".$record_1."' ORDER BY p.paid_id DESC");
try {
$stms_invoice_paid->execute(array());
$row_count_invoice_paid = $stms_invoice_paid->rowCount();
if ($row_count_invoice_paid > 0) { ?>
<table style="width:100%; ">
<thead><tr>
<th style="color:#fff; background-color:#005292; padding:0.7%;">#</th>
<th style="color:#fff; background-color:#005292;">Date</th>
<th style="color:#fff; background-color:#005292;">Description</th>
<th style="color:#fff; background-color:#005292;">Amount</th>
<th style="color:#fff; background-color:#005292;">Code</th>
</tr></thead><tbody>
<?php $ip=1; $summ=0;
while($paid = $stms_invoice_paid->fetch(PDO::FETCH_ASSOC)) {
$paid_id = $paid['paid_id'];
$paid_student_id = $paid['paid_student_id'];
$paid_amount = $paid['paid_amount'];
$paid_order_code = $paid['paid_order_code'];
$paid_status = $paid['paid_status'];
$paid_description = $paid['paid_description'];
$paid_date = $paid['paid_date'];
$summ=$summ+$paid_amount;
?>
<tr>
<td scope="row" style="color:#000; padding:0.5%;"><?= $ip++; ?>.</td>
<td style="<?= $color; ?>;"><?= $paid_date; ?></td>
<td style="<?= $color; ?>;"><?= $paid_description; ?></td>
<td style="<?= $color; ?>;"><?= number_format($paid_amount); ?> Rwf</td>
<td style="<?= $color; ?>;"><?= $paid_order_code; ?></td>
</tr> <?php } ?>
<tr>
<td colspan="3" style="color:#fff; background-color:#005292; text-align:right;">Total amount :</td>
<td colspan="3" style="color:#fff; background-color:#005292; text-align:left;"><?= number_format($summ); ?> Rwf</td></tr>
<?php }
else{ }}catch (PDOException $ex) {$ex->getMessage();} ?>


</tr>



<?php }}
else{   ?><center><div class="spinner"><br>Empty</div></center>  <?php }}catch (PDOException $ex) {$ex->getMessage();} ?>
</tbody></table><div class="col-sm-8"></div></div>
<?php }



if(isset($_GET['printinvoiceid'])) {
    $limit = @$pag_limit;
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
@$offset = ($current_page - 1) * @$limit; ?>
<div class="bs-example4" data-example-id="simple-responsive-table">
<div class="table-responsive" >

<?php $stms_access = $DB_con->prepare("SELECT * FROM registration pr INNER JOIN 
position pp ON pp.position_id = pr.user_position INNER JOIN 
country pc ON pc.country_id = pr.user_country INNER JOIN 
cells pcells ON pcells.Cell_ID = pr.user_cell INNER JOIN 
sectors psectors ON psectors.Sector_ID = pcells.Sector_ID INNER JOIN 
district pd ON pd.DistrictID = psectors.District_ID INNER JOIN 
province ppv ON ppv.ProvinceID = pd.ProvinceID INNER JOIN system 
ps ON ps.id = pr.school_id INNER JOIN 
centers AS c ON c.center_id=pr.center INNER JOIN classes AS cl ON
cl.class_id=pr.class_id WHERE pr.user_id='".$_GET['printinvoiceid']."'");
try {
$stms_access->execute(array());
$row_count_access = $stms_access->rowCount();
if ($row_count_access > 0) {
$count=1; ?>
<table style="width:100%; ">
<thead><tr>
<th style="color:#fff; background-color:#005292; padding:0.7%;"> Student Details</th>
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
if($class_name==''){$class_names='';}
else{$class_names=$class_name.'';}
$gt=$record_1*678576100; ?>
<tr>
<td scope="row" style="color:#000; padding:0.5%;">
Name: <b><?= $record_22; ?></b><br>
Gender: <b><?= $record_7; ?></b><br>
Email: <b><?= $record_4; ?></b><br>
Phone: <b><?= $record_5; ?></b><br>
Class: <b><?= $class_names; ?></b><br>
School: <b><?= $center; ?></b></td>
</tr> 


<tr>
<?php
$stms_invoice_paid = $DB_con->prepare("SELECT * FROM payment AS p LEFT JOIN registration AS r ON r.user_id=p.paid_student_id WHERE p.paid_order_code='".$_GET['printinvoice']."' ORDER BY p.paid_id DESC");
try {
$stms_invoice_paid->execute(array());
$row_count_invoice_paid = $stms_invoice_paid->rowCount();
if ($row_count_invoice_paid > 0) { ?>
<table style="width:100%; ">
<thead><tr>
<th style="color:#fff; background-color:#005292; padding:0.7%;">#</th>
<th style="color:#fff; background-color:#005292;">Date</th>
<th style="color:#fff; background-color:#005292;">Description</th>
<th style="color:#fff; background-color:#005292;">Amount</th>
<th style="color:#fff; background-color:#005292;">Code</th>
</tr></thead><tbody>
<?php $ip=1; $summ=0;
while($paid = $stms_invoice_paid->fetch(PDO::FETCH_ASSOC)) {
$paid_id = $paid['paid_id'];
$paid_student_id = $paid['paid_student_id'];
$paid_amount = $paid['paid_amount'];
$paid_order_code = $paid['paid_order_code'];
$paid_status = $paid['paid_status'];
$paid_description = $paid['paid_description'];
$paid_date = $paid['paid_date'];
$summ=$summ+$paid_amount;
?>
<tr>
<td scope="row" style="color:#000; padding:0.5%;"><?= $ip++; ?>.</td>
<td style="<?= $color; ?>;"><?= $paid_date; ?></td>
<td style="<?= $color; ?>;"><?= $paid_description; ?></td>
<td style="<?= $color; ?>;"><?= number_format($paid_amount); ?> Rwf</td>
<td style="<?= $color; ?>;"><?= $paid_order_code; ?></td>
</tr> <?php } ?>
<tr>
<td colspan="3" style="color:#fff; background-color:#005292; text-align:right;">Total amount :</td>
<td colspan="3" style="color:#fff; background-color:#005292; text-align:left;"><?= number_format($summ); ?> Rwf</td></tr>
<?php }
else{ }}catch (PDOException $ex) {$ex->getMessage();} ?>


</tr>



<?php }}
else{   ?><center><div class="spinner"><br>Empty</div></center>  <?php }}catch (PDOException $ex) {$ex->getMessage();} ?>
</tbody></table><div class="col-sm-8"></div></div>
<?php }








if(isset($_GET['reportofattendance'])) {
    @$qry=@$_GET['reportofattendance'];
    $limit = @$pag_limit;
    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
    @$offset = ($current_page - 1) * @$limit; ?>
    <div class="bs-example4" data-example-id="simple-responsive-table">
    <div class="table-responsive" >
    
    <?= "<span class='btn' style='float:left; margin-bottom:1%; background-color:#005292; color:#fff;'><i data-feather='list'></i> Attendance Report, Class: ".$_GET['nnc']."</span>"; ?>
 
    <?php $stms_access = $DB_con->prepare("SELECT * FROM attendance AS att LEFT JOIN registration pr ON att.att_student_id=pr.user_id 
    INNER JOIN position pp ON pp.position_id = pr.user_position INNER JOIN country pc ON pc.country_id = pr.user_country INNER JOIN 
    cells pcells ON pcells.Cell_ID = pr.user_cell INNER JOIN sectors psectors ON psectors.Sector_ID = pcells.Sector_ID INNER JOIN 
    district pd ON pd.DistrictID = psectors.District_ID INNER JOIN province ppv ON ppv.ProvinceID = pd.ProvinceID INNER JOIN system ps 
    ON ps.id = pr.school_id INNER JOIN centers AS c ON c.center_id=pr.center LEFT JOIN classes AS cl ON cl.class_id=pr.class_id WHERE 
    cl.class_id='".$qry."' ORDER BY att.att_id DESC");
    try {
    $stms_access->execute(array());
    $row_count_access = $stms_access->rowCount();
    if ($row_count_access > 0) {
    $count=1; ?>
    <table style="width:100%; ">
    <thead><tr>
    <th style="color:#fff; background-color:#005292; padding:0.7%;">#</th>
    <th style="color:#fff; background-color:#005292;">Name</th>
    <th style="color:#fff; background-color:#005292;">Day</th>
    <th style="color:#fff; background-color:#005292;">Date</th>
    <th style="color:#fff; background-color:#005292;">Time</th>
    <th style="color:#fff; background-color:#005292;">Done By</th>
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
    $att_agent_id = $access['att_agent_id'];
    $att_day = $access['att_day'];
    $att_date = $access['att_date'];
    $att_time = $access['att_time'];
    $observation = $access['observation']; ?><tr>
    <td scope="row" style="color:#000; padding:0.5%;"><?= $i++; ?></td>
    <td style="color:#000;"><?= $record_2; ?></td>
    <td style="color:#000;"><?= $att_day; ?></td>
    <td style="color:#000;"><?= $att_date; ?></td>
    <td style="color:#000;"><?= $att_time; ?></td>
    <td style="color:#000;"><?= $att_agent_id; ?></td>
    </tr> <?php }}
    else{   ?><center><div class="spinner"><br>Empty</div></center>  <?php   }}catch (PDOException $ex) {$ex->getMessage();} ?>
    </tbody></table> </div>
    <?php }
    

    
if(isset($_GET['reportofattendancesingle'])) {
    @$qry=@$_GET['reportofattendancesingle'];
    $limit = @$pag_limit;
    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
    @$offset = ($current_page - 1) * @$limit; ?>
    <div class="bs-example4" data-example-id="simple-responsive-table">
    <div class="table-responsive" >
    
    <?= "<span class='btn' style='float:left; margin-bottom:1%; background-color:#005292; color:#fff;'><i data-feather='list'></i> Attendance Report of  ".$_GET['nnc']."</span>"; ?>
 
    <?php $stms_access = $DB_con->prepare("SELECT * FROM attendance AS att LEFT JOIN registration pr ON att.att_student_id=pr.user_id 
    INNER JOIN position pp ON pp.position_id = pr.user_position INNER JOIN country pc ON pc.country_id = pr.user_country INNER JOIN 
    cells pcells ON pcells.Cell_ID = pr.user_cell INNER JOIN sectors psectors ON psectors.Sector_ID = pcells.Sector_ID INNER JOIN 
    district pd ON pd.DistrictID = psectors.District_ID INNER JOIN province ppv ON ppv.ProvinceID = pd.ProvinceID INNER JOIN system ps 
    ON ps.id = pr.school_id INNER JOIN centers AS c ON c.center_id=pr.center LEFT JOIN classes AS cl ON cl.class_id=pr.class_id WHERE 
    pr.user_id='".$qry."' ORDER BY att.att_id DESC");
    try {
    $stms_access->execute(array());
    $row_count_access = $stms_access->rowCount();
    if ($row_count_access > 0) {
    $count=1; ?>
    <table style="width:100%; ">
    <thead><tr>
    <th style="color:#fff; background-color:#005292; padding:0.7%;">#</th>
    <th style="color:#fff; background-color:#005292;">Name</th>
    <th style="color:#fff; background-color:#005292;">Day</th>
    <th style="color:#fff; background-color:#005292;">Date</th>
    <th style="color:#fff; background-color:#005292;">Time</th>
    <th style="color:#fff; background-color:#005292;">Done By</th>
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
    $att_agent_id = $access['att_agent_id'];
    $att_day = $access['att_day'];
    $att_date = $access['att_date'];
    $att_time = $access['att_time'];
    $observation = $access['observation']; ?><tr>
    <td scope="row" style="color:#000; padding:0.5%;"><?= $i++; ?></td>
    <td style="color:#000;"><?= $record_2; ?></td>
    <td style="color:#000;"><?= $att_day; ?></td>
    <td style="color:#000;"><?= $att_date; ?></td>
    <td style="color:#000;"><?= $att_time; ?></td>
    <td style="color:#000;"><?= $att_agent_id; ?></td>
    </tr> <?php }}
    else{   ?><center><div class="spinner"><br>Empty</div></center>  <?php   }}catch (PDOException $ex) {$ex->getMessage();} ?>
    </tbody></table> </div>
    <?php }
    



    if (isset($_GET['search_name'])) {
        $qry = isset($_GET['search_name']) ? htmlspecialchars($_GET['search_name']) : '';
        ?>

        <div class="bs-example4" data-example-id="simple-responsive-table">
        <div class="table-responsive" >
      <?= "<span class='btn' style='float:left; margin-bottom:1%; background-color:#005292; color:#fff;'><i data-feather='list'></i> Attendance Report found on " . htmlspecialchars($_GET['search_name']) . "</span>"; ?>
                <form method="GET" action="" style="float:right;" class="Noprint">
                    <label for="search_name">Student name:</label>
                    <input type="text" name="search_name" id="search_name" placeholder="Enter name">
                    <button type="submit" class="btn" style="color:#fff; background-color:#005292;">Search now</button>
                </form>
        <?php $stms_access = $DB_con->prepare("SELECT * FROM attendance AS att LEFT JOIN registration pr ON att.att_student_id=pr.user_id 
        INNER JOIN position pp ON pp.position_id = pr.user_position INNER JOIN country pc ON pc.country_id = pr.user_country INNER JOIN 
        cells pcells ON pcells.Cell_ID = pr.user_cell INNER JOIN sectors psectors ON psectors.Sector_ID = pcells.Sector_ID INNER JOIN 
        district pd ON pd.DistrictID = psectors.District_ID INNER JOIN province ppv ON ppv.ProvinceID = pd.ProvinceID INNER JOIN system ps 
        ON ps.id = pr.school_id INNER JOIN centers AS c ON c.center_id=pr.center LEFT JOIN classes AS cl ON cl.class_id=pr.class_id WHERE 
        CONCAT(pr.user_othername, ' ', pr.user_name) LIKE '%".$_GET['search_name']."%' ORDER BY att.att_id DESC");
        try {
        $stms_access->execute(array());
        $row_count_access = $stms_access->rowCount();
        if ($row_count_access > 0) {
        $count=1; ?>
        <table style="width:100%; ">
        <thead><tr>
        <th style="color:#fff; background-color:#005292; padding:0.7%;">#</th>
        <th style="color:#fff; background-color:#005292;">Name</th>
        <th style="color:#fff; background-color:#005292;">Day</th>
        <th style="color:#fff; background-color:#005292;">Date</th>
        <th style="color:#fff; background-color:#005292;">Time</th>
        <th style="color:#fff; background-color:#005292;">Done By</th>
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
        $att_agent_id = $access['att_agent_id'];
        $att_day = $access['att_day'];
        $att_date = $access['att_date'];
        $att_time = $access['att_time'];
        $observation = $access['observation']; ?><tr>
        <td scope="row" style="color:#000; padding:0.5%;"><?= $i++; ?></td>
        <td style="color:#000;"><?= $record_2; ?></td>
        <td style="color:#000;"><?= $att_day; ?></td>
        <td style="color:#000;"><?= $att_date; ?></td>
        <td style="color:#000;"><?= $att_time; ?></td>
        <td style="color:#000;"><?= $att_agent_id; ?></td>
        </tr> <?php }}
        else{   ?><center><div class="spinner"><br>Empty</div></center>  <?php   }}catch (PDOException $ex) {$ex->getMessage();} ?>
        </tbody></table> </div>
        <?php }
        
    




include 'done_by.php';
include 'footer_printing.php';
?>