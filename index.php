<?php
session_start();

if((isset($_SESSION['logged'])) && ($_SESSION['logged']==true))
{
    header("Location: control_panel.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">

    <title>Menedżer haseł</title>
</head>
<body>
    <div class="container">
            <form action="login.php" method="post">
                
                <input type="text" name="login" placeholder="login">
                
                <input type="password" name="password" placeholder="hasło">
                
                <input type="submit" class="btn" value="Zaloguj się">
            </form>
            
            <a href="register.php" class="register">Nowe Konto</a>
        <?php
            if(isset($_SESSION['error'])) echo $_SESSION['error'];

            if(isset($_SESSION['register_success'])) 
	            {
	            	echo '<span style="color: white; font-weight: bold">KONTO ZOSTAŁO UTWORZONE!</span>';
	            	unset($_SESSION['register_success']);
	            }
                    
                //Usuwanie zmiennych pamiętających wartości wpisane do formularza
                if(isset($_SESSION['fr_nick'])) unset($_SESSION['fr_nick']);
                if(isset($_SESSION['fr_email'])) unset($_SESSION['fr_email']);
                if(isset($_SESSION['fr_pass'])) unset($_SESSION['fr_pass']);
                if(isset($_SESSION['fr_repass'])) unset($_SESSION['fr_repass']);
                if(isset($_SESSION['fr_statue'])) unset($_SESSION['fr_statue']);
                //usuwanie błędów rejestracji
                if(isset($_SESSION['e_nick'])) unset($_SESSION['e_nick']);
                if(isset($_SESSION['e_email'])) unset($_SESSION['e_email']);
                if(isset($_SESSION['e_pass'])) unset($_SESSION['e_pass']);
                if(isset($_SESSION['e_statue'])) unset($_SESSION['e_statue']);
                if(isset($_SESSION['e_captcha'])) unset($_SESSION['e_captcha']);
        ?>
    </div>
</body>
</html>