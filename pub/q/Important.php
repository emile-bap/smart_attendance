if(isset($_GET['paginations'])) { ?>    
<div class="row">
    <div class="col-lg-3"></div>
    <div class="col-lg-6"></div>
</div>
<?php }




<?php $TotSubCatss = $DB_con->prepare("SELECT * FROM main_category AS mc LEFT JOIN subcategory AS sc ON mc.main_cat_id=sc.main_cat_id WHERE mc.main_cat_status='Active' AND sc.subcat_status='Active' AND sc.main_cat_id='".$main_cat_id."' ORDER BY sc.subcat_name ASC");
try {
$TotSubCatss->execute(array());
$row_count = $TotSubCatss->rowCount();
if ($row_count > 0){
while($list = $TotSubCatss->fetch(PDO::FETCH_ASSOC)){
@$main_cat_id = $list['main_cat_id'];
@$main_cat_name = $list['main_cat_name'];
@$main_cat_status = $list['main_cat_status'];
@$subcat_id = $list['subcat_id'];
echo @$subcat_name = $list['subcat_name'].'<br>';
@$subcat_status = $list['subcat_status'];	
}} else{ }} catch (PDOException $ex){ $ex->getMessage(); } ?>


<?php $TotSubCatsa = $DB_con->prepare("SELECT COUNT(*) AS TotItems FROM item AS it LEFT JOIN subcategory AS sc ON sc.subcat_id=it.subcat_id WHERE it.item_status='Active' AND sc.subcat_status='Active' AND it.subcat_id='".@$subcat_id."'");
try {
$TotSubCatsa->execute(array());
$row_counta = $TotSubCatsa->rowCount();
if ($row_counta > 0){
$ta = $TotSubCatsa->fetch(PDO::FETCH_ASSOC);
@$TotSubCata = $ta['TotItems'];	
} else{ @$TotSubCata=0; }} catch (PDOException $ex){ $ex->getMessage(); } ?> 




<?php $TotSubCatss = $DB_con->prepare("SELECT * FROM main_category AS mc LEFT JOIN subcategory AS sc ON 
mc.main_cat_id=sc.main_cat_id LEFT JOIN item AS it ON it.subcat_id=sc.subcat_id WHERE mc.main_cat_status='Active' 
AND sc.subcat_status='Active' AND sc.main_cat_id='""'");
try {
$TotSubCatss->execute(array());
$row_count = $TotSubCatss->rowCount();
if ($row_count > 0){
while($list = $TotSubCatss->fetch(PDO::FETCH_ASSOC)){
@$main_cat_id = $list['main_cat_id'];
@$main_cat_name = $list['main_cat_name'];
@$main_cat_status = $list['main_cat_status'];
@$subcat_id = $list['subcat_id'];
@$subcat_name = $list['subcat_name'];
@$subcat_status = $list['subcat_status'];
@$item_id = $list['item_id'];
@$item_name = $list['item_name'];
@$item_container = $list['item_container'];
@$item_price = $list['item_price'];	
@$item_status = $list['item_status'];	
@$item_price = $list['item_price'];	

}} else{ }} catch (PDOException $ex){ $ex->getMessage(); } ?>