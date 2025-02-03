<?php 
include 'pub/q/connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= @$name; ?></title>
    <link rel="icon" href="pub/q/<?= @$logo; ?>">
    <style>
        /* Global Reset */
        body{ background-color: #0e4b64; }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Container for the whole page */
        .container {
            display: flex;
            flex-wrap: wrap;
            height: 100vh;
            background-color: #0e4b64;
        }

        /* Left section (Project details) */
        .left {
            flex: 1;
            background-color: #0e4b64;
            color: #fff;
            padding: 30px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: center;
            font-family:Calibri;
        }

        .left h1 {
            font-size: 2.5em;
            margin-bottom: 20px;
        }

        .left p {
            font-size: 1.2em;
            line-height: 1.5;
            margin-bottom: 30px;
        }

        /* Right section (Login form) */
        .right {
            flex: 1;
            background-color: #0e4b64;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px;
            font-family:Calibri;
        }

        /* Form styling */
        .form-container {
            width: 100%;
            max-width: 400px;
            background-color: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        /* Logo Section */
        .logo {
            margin-bottom: 30px; /* Space between the logo and the rest of the form */
        }

        .logo img {
            max-width: 150px;
            height: auto;
        }

        .form-container h2 {
            margin-bottom: 20px;
            color: #333333;
        }

        .input-group {
            margin-bottom: 20px;
        }

        .input-group label {
            font-size: 1.1em;
            margin-bottom: 5px;
            color: #0e4b64;
        }

        .input-group input {
            width: 100%;
            padding: 12px;
            font-size: 1em;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .input-group input:focus {
            border-color: #0e4b64;
            outline: none;
        }

        .fingerprint-btn {
            width: 100%;
            padding: 12px;
            background-color: #0e4b64;
            color: #ffffff;
            font-size: 1.1em;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 15px;
        }

        .fingerprint-btn:hover {
            background-color: #075a7d;
        }

        .login-btn {
            width: 100%;
            padding: 12px;
            background-color: #0e4b64;
            color: #ffffff;
            font-size: 1.1em;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .login-btn:hover {
            background-color: #00796b;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .left, .right {
                flex: 0 0 100%;
            }

            .form-container {
                padding: 20px;
            }

            .logo img {
                max-width: 120px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
      
        <!-- Right Section: Login Form -->
        <div class="right">
            <div class="form-container">
              
            <center><b style="color:#000; font-size:20px;"><?= strtoupper($name); ?></b><br>
            <img src="pub/q/<?= @$logo; ?>" style="height:auto; width:50%;" alt="<?= @$name; ?> Logo"><br>
        </center>

                <h2>Sign In</h2>
                <form style="text-align:left;" action="pub/q/staff" method="POST">
                    <div class="input-group">
                        <!-- <label for="username">Username</label> -->
                        <input type="text" id="username" name="username" autofocus placeholder="Username" required style="margin-bottom:2%;">
                   
                        
                        <!-- <label for="password">Password</label> -->
                        <input type="password" id="password" name="password" placeholder="Password" required>
                    </div>
                    <button type="submit" name="login" class="login-btn">Login</button>
                    <!-- <button type="button" class="fingerprint-btn">Use Fingerprint</button> -->
                </form>
            </div>
        </div>
    </div>

</body>
</html>
