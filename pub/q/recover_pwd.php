<?php include("connection.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sign In | <?= @$name; ?></title>
<link rel="shortcut icon" href="<?= @$logo; ?>" >
    <link rel="stylesheet" href="public_html/assets/css/bootstrap.css">
    <link rel="stylesheet" href="public_html/assets/css/app.css">
</head>

<body>
    <div id="auth">
        
<div class="container">
    <div class="row">
        <div class="col-md-5 col-sm-12 mx-auto">
            <div class="card pt-4">
                <div class="card-body">
                    <div class="text-center mb-1">
                        <img src="<?= @$logo; ?>" style="height:98px;" class='mb-1'>
                        <h3 style="color:#00B1B5;">Password resetting</h3>
                        <p style="color:#00B1B5;">Please type your valid and used email</p>

<center style="color:#00B1B5;">
<?php
//======ACCEPT RECOVER PWD
if(isset($_POST['recover_pwd'])) 
{
$email=$_POST['email'];
$stmt = $DB_con->prepare("SELECT * FROM registration, position, country, province, district, sectors, cells WHERE position.position_id=registration.user_position AND registration.user_status=1 AND country.country_id=registration.user_country AND cells.Cell_ID=registration.user_cell AND sectors.Sector_ID=cells.Sector_ID AND district.DistrictID=sectors.District_ID AND province.ProvinceID=district.ProvinceID AND registration.user_email='".$email."'");
try {
$stmt->execute(array());
$row_count = $stmt->rowCount();
if ($row_count > 0)
{
$get = $stmt->fetch(PDO::FETCH_ASSOC);
$user_id=$get['user_id'];
$username=strtolower($get['username']);
$user_passwordz=substr((strtolower(date('l'))),1,5).'QnxP'.strtoupper(date('dsA')).'McFSP';
$user_password=md5(substr((strtolower(date('l'))),1,5).'QnxP'.strtoupper(date('dsA')).'McFSP');
echo "Username: ".$username.'<br>Password: '.$user_passwordz;

$sql = "UPDATE registration SET user_password=:user_password WHERE registration.user_id=:user_id";
$stmt = $DB_con->prepare($sql);
$stmt->bindParam(':user_password', $user_password, PDO::PARAM_INT);    
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);    
$stmt->execute();

echo "<center><b style='color:#00B1B5;'>New password is already sent to your used email.</b></center><br>";
$message1 = "Mail sent at ".date('l d/m/Y h:i:s A')."\n\nThank you\n, system is providing you the best way to recover your PASSWORD for better understanding what the system is about to focus, and then it simplifies your work, and it is also the sympatic system.\n\n
Thank you for contacting us.\n";
$message2="Your username and new password:\n\nUsername: ".$username."\nPassword: ".$user_password."\n\nMore info:\nTel_1: +250 785 384 384
Tel_2: +250 725 892 788 [Admin]\n";
$messagex=$message1.''.$message2;
@$from ='System';
$to = $email;
$headers=$from;
$subject = 'PASSWORD Recovery';
$message = $messagex; 

// Sending email
if(@mail(@$to,@$subject,@$message,@$headers)){
echo "<center><span style='color:#00B1B5;'><i class='fa fa-check'></i> Go to your email then update the default sent.</span></center>"; }
else { echo "<center><span style='color:indianred;'><i class='fa fa-times'></i> Try to connect to the internet.</span></center>"; }

}
else { echo "<center><span style='color:indianred;'><i class='fa fa-spin fa-spinner'></i> Uncognized your email<br>Correct and try again later.</span></center>";
echo '<meta http-equiv="refresh"'.'content="2; URL=recover_pwd">';
}
}
catch (PDOException $e) {
echo $e->getMessage();
}}
?>
</center>

                    </div>
                    <form method="POST" action="recover_pwd" enctype="multipart/form-data" autocomplete="off" style="color:#00B1B5;">
                        <div class="form-group position-relative has-icon-left">
                            <label for="username" style="color:#000;"><i data-feather="email"></i> Email</label>
                            
                            <div class="float-right">
                                <a href="staff" style="color:#000;"><i data-feather="power"></i> Login</a>
                            </div>

                            <div class="position-relative">
                                <input type="email" class="form-control" placeholder="Type your email..." name="email" autofocus id="email" required>
                                <div class="form-control-icon">
                                    <i data-feather="user"></i>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix">
                            <button type="submit" name="recover_pwd" style="width:100%; background-color:#00B1B5; color:#fff;" class="btn  float-right"><i data-feather="key"></i> Accept to reset your password</button>
                        </div>
                    </form>
                    








                </div>
            </div>
        </div>
    </div>
</div>

    </div>
    <script src="public_html/assets/js/feather-icons/feather.min.js"></script>
    <script src="public_html/assets/js/app.js"></script>
    <script src="public_html/assets/js/main.js"></script>
</body>

</html>
