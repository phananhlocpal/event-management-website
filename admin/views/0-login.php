<!DOCTYPE html>
<html lang="en">
<?php
    session_start();
    include '../controllers/authController.php';

    if (isset($_POST['username']) && isset($_POST['password'])) {
        $authController = new AuthController();
        
        $reslt = $authController->processLogin();
       
        if ($reslt === 'success')
        {
            header("location: 0-home.php");
        }
        else
        {
            echo $reslt;
        }
    }
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PClub Home</title>
    <link rel="stylesheet" href="public/css/login.css" type="text/css" media ="screen">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="shortcut icon" type="image/png" href="public/img/logo/2.png"/>
</head>

<body>
    <div style = "display: flex; justify-content: center; align-items: center; width: 100vw; height: 100vh;">
        <div class="body__container">
            <!--------------------------- Left Box ----------------------------->

            <div class="container__left">
                <div>
                    <img src="public/img/logo/3.png">
                </div>
                
            </div>

            <!-------------------- ------ Right Box ---------------------------->

            <div class="container__right">
                <div class="container__right-child">
                    <div class="greeting">
                        <h2>Hello, again!</h2>
                    </div>
                    <form action="" method = "POST">
                        <div class="block__inputUsername">
                            <input type="text" placeholder="Username" id ="username" name = "username">
                        </div>
                        <div class="block__inputPassword">
                            <input type="password" placeholder="Password" id ="password" name = "password">
                        </div>
                        
                        <div class="btn">
                            <button class="btn btn-lg btn-primary w-100 fs-6" type="submit">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>



</html>