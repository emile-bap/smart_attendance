 
<?php 
session_start();
include 'connection.php';
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sign In  <?= @$name; ?></title>
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
                    <div class="text-center mb-2">
                        <img src="<?= @$logo; ?>" height="98" class='mb-1'>

<center style="color:#00B1B5;">
<?php
$error = "";
$success = "";

if (isset($_POST['login'])) {
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $sql = "SELECT * 
                FROM registration AS pr 
                INNER JOIN position AS pp ON pp.position_id = pr.user_position 
                INNER JOIN country AS pc ON pc.country_id = pr.user_country 
                INNER JOIN cells AS pcells ON pcells.Cell_ID = pr.user_cell 
                INNER JOIN sectors AS psectors ON psectors.Sector_ID = pcells.Sector_ID 
                INNER JOIN district AS pd ON pd.DistrictID = psectors.District_ID 
                INNER JOIN province AS ppv ON ppv.ProvinceID = pd.ProvinceID 
                INNER JOIN system AS pschool ON pschool.id = pr.school_id 
                WHERE pr.user_status = 1 
                AND pr.username = :username 
                AND pr.user_password = :password";

        $stmt = $DB_con->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        
        try {
            $stmt->execute();
            $row_count = $stmt->rowCount();

            if ($row_count > 0) {
                $row1 = $stmt->fetch(PDO::FETCH_ASSOC);
                $_SESSION['user_id'] = $row1['user_id'];
                $_SESSION['position_id'] = $row1['position_id'];
                $_SESSION['user_othername'] = $row1['user_othername'];
                $_SESSION['user_name'] = $row1['user_name'];
                $_SESSION['user_reg_no'] = $row1['user_reg_no'];
                $_SESSION['user_email'] = $row1['user_email'];
                $_SESSION['user_phone'] = $row1['user_phone'];
                $_SESSION['user_gender'] = $row1['user_gender'];
                $_SESSION['user_photo'] = $row1['user_photo'];
                $_SESSION['user_status'] = $row1['user_status'];
                $_SESSION['country_name'] = $row1['country_name'];
                $_SESSION['position_name'] = $row1['position_name'];
                $_SESSION['user_password'] = $row1['user_password'];
                $_SESSION['username'] = $row1['username'];

                if ($_SESSION['position_id'] == 1) {
                    echo '<center>'.$success."<br><b style='color:#00B1B5;'><i class='fa fa-user'> Dear ". $_SESSION['user_othername'] ." ". $_SESSION['user_name']."<br> Login successful.</i></b></center>";
                    echo '<meta http-equiv="refresh" content="0;url=super_admin?profilexx='.$_SESSION['user_id'].'&user_name_to_editxx='.$_SESSION['user_othername'] ." ". $_SESSION['user_name'].'">';}

                            else if ($_SESSION['position_id'] == 2) {
                                    echo '<center>'.$success."<br><b style='color:#00B1B5;'><i class='fa fa-user'> Dear ". $_SESSION['user_othername'] ." ". $_SESSION['user_name']."<br> Login successful.</i></b></center>";
                                    echo '<meta http-equiv="refresh" content="0;url=parent?key='.$_SESSION['user_othername'].'">';}

                                    else if ($_SESSION['position_id'] == 3) {
                                            echo '<center>'.$success."<br><b style='color:#00B1B5;'><i class='fa fa-user'> Dear ". $_SESSION['user_othername'] ." ". $_SESSION['user_name']."<br> Login successful.</i></b></center>";
                                            echo '<meta http-equiv="refresh" content="0;url=discipline?listofclasses=LIST OF CLASSES&title=Attendancer">';}

               else {
                    echo $error = "<label style='color:#f00;'>Login failure, try again.</label>";
                    echo '<meta http-equiv="refresh" content="2;url=../../index">';
                }
            } else {
                echo $error = "<label style='color:#f00;'>Login failure, try again.</label>";
                echo '<meta http-equiv="refresh" content="2;url=../../index">';
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo $error = "<label style='color:#f00;'>Please provide both username and password.</label>";
        echo '<meta http-equiv="refresh" content="2;url=../../index">';
    }
}
?>
</center>

                    </div>

                    
                    








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
