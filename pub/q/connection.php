<?php
date_default_timezone_set('Africa/Kigali');
$DB_host = "localhost";
$DB_user = "root";
$DB_pass = "";
$DB_name = "smart_attendance";

try
{
$DB_con = new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user,$DB_pass);
$DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$DB_con->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
}catch(PDOException $e){echo $e->getMessage();}

//=================================================================================COLLEGE DETAILS
$view_system = $DB_con->prepare("SELECT * FROM system, cells, sectors, district, province WHERE system.cell_id=cells.Cell_ID AND cells.Sector_ID=sectors.Sector_ID AND sectors.District_ID=district.DistrictID AND district.ProvinceID=province.ProvinceID ORDER BY system.id ASC");
try {
$view_system->execute(array());
$row_count_access = $view_system->rowCount();
if ($row_count_access > 0){
$access_system = $view_system->fetch(PDO::FETCH_ASSOC);
@$id = $access_system['id'];	
@$logox = $access_system['logo'];
@$stampx = $access_system['stamp'];
if(@$logox=='logo/'){@$logo='images/images/images/ajax-loader-gears.gif';}  else{@$logo=@$logox;}
if(@$stampx=='logo/'){@$stamp='images/images/images/ajax-loader-gears.gif';}  else{@$stamp=@$stampx;}	
@$name = $access_system['name'];
@$abbreviation = $access_system['abbreviation'];
@$email = $access_system['email'];
@$phone = $access_system['phone'];
@$pobox = $access_system['pobox'];
@$motto = $access_system['motto'];
@$website = $access_system['website'];
@$izina_ry_ubutore = $access_system['izina_ry_ubutore'];
@$manager = $access_system['manager'];
@$font_family = $access_system['font_family'];
@$category = $access_system['category'];
@$tin = $access_system['tin'];
@$momopay = $access_system['momopay'];
@$nameonmomo = $access_system['nameonmomo'];
$Cell_ID = $access_system['Cell_ID'];
$CellName = $access_system['CellName'];
$SectorName = $access_system['SectorName'];
$DistrictName = $access_system['DistrictName'];
$ProvinceName = $access_system['ProvinceName'];	
$developedby = $access_system['developedby'];	
} else{ echo "<center><span id='blink'><i class='fa fa-times'></i> College is not set!</span></center>"; }} catch (PDOException $ex){ $ex->getMessage(); }
$success='<center><div class="spinner"></div><br /> Successful done !</center>';
$failed='<center><div class="spinner"></div><br />  College is not set!</center>';
$signout='<center><div class="spinner"></div><br />  Dear, you are sign out!</center>';



 ?>



<script> 
function goBack() { window.history.back() } 
</script>
<style media=print> 
.Noprint{display:none; border-style:none;}   
</style>

<style>
.whatsapp-float {
    position: fixed;
    bottom: 10;
    right: 10;
    z-index: 1000;
}




@keyframes spin {
0% { transform: rotate(0deg); }
100% { transform: rotate(360deg); }
}

.spinner {
margin: 20px auto;
width: 80px;
height: 80px;
border: 15px solid #e4e4e4;
border-top: 15px solid #fff;
border-radius: 50%;
animation: spin 5s linear infinite;
}


.pagination {
display: flex;
justify-content: center;
align-items: center;
margin: 10px 0;
float:left;
width:90%;
}

.pagination a, .pagination span {
display: inline-block;
padding: 5px 10px;
margin: 0 5px;
font-size: 16px;
color: #333;
border: 1px solid #ccc;
border-radius: 3px;
text-decoration: none;
}

.pagination a:hover {
background-color: #000;
color: #fff;
text-decoration:none;
}
.pagination .current {
background-color: #005292;
color: #fff;
}



tr:nth-child(odd) { background-color: #e4e4e4;}
tr:nth-child(even) {  background-color: #fff;}
ul, li, a, span{ color:#005292;}
</style>
