<?php
session_start();

if(isset($_POST['login']))
{
    //udana walidacja? Załóżmy, że tak
    $wszystko_ok=true;

    if(strlen($_POST['name'])<=0)
    {
        $wszystko_ok=false;
        $_SESSION['e_name']='Musisz podać imię!';
    }

    if(strlen($_POST['surname'])<=0)
    {
        $wszystko_ok=false;
        $_SESSION['e_surname']='Musisz podać nazwisko!';
    }

    //Sprawdź poprawność nickname
    $login = $_POST['login'];

    //Sprawdzenie długości nicka
    if((strlen($login)<3) || (strlen($login)>20))
    {
        $wszystko_ok=false;
        $_SESSION['e_login']='Login musi posiadać od 3 do 20 znaków!';
    }
    //Sprawdzenie czy nick składa się ze znaków alfanumerycznych
    if(ctype_alnum($login)==false)
    {
        $wszystko_ok=false;
        $_SESSION['e_login']='Login może składać się tylko z liter i cyfr (bez polskich znaków!)';
    }

    //Sprawź poprawność hasła
    $pass = $_POST['password'];
    $repass = $_POST['re_password'];

    if((strlen($pass)<=8) || (strlen($pass)>20))
    {
        $wszystko_ok=false;
        $_SESSION['e_pass']='Hasło musi posiadać od 8 do 20 znaków!';
    }

    if($pass!=$repass)
    {
        $wszystko_ok=false;
        $_SESSION['e_pass']='Podane hasła nie są identyczne!';
    }

    $pass_hash = password_hash($pass, PASSWORD_DEFAULT);

    $name = $_POST['name'];
    $surname = $_POST['surname'];

    //Zapamiętaj wprowadzone dane
    $_SESSION['fr_name'] = $name;
    $_SESSION['fr_surname'] = $surname;
    $_SESSION['fr_login'] = $login;
    $_SESSION['fr_pass'] = $pass;
    $_SESSION['fr_repass'] = $repass;

    ///sprawdzenie czy jest już w bazie
    require_once "db_credentials.php";
    mysqli_report(MYSQLI_REPORT_STRICT);
    try
    {
        $connect_db = new mysqli($db_host, $db_user, $db_pass, $db_name);
        if($connect_db->connect_errno!=0) 
        {
            throw new Exception(mysqli_connect_errno());
        }
        else
        {
            //Czy login istnieje
            $result = $connect_db->query("SELECT id FROM users WHERE login='$login'");

            if(!$result) throw new Exception($polaczenie->error);
            $ile_maili = $result->num_rows;
            if($ile_maili>0)
            {
                $wszystko_ok=false;
                $_SESSION['e_login']='Istnieje już konto przypisane do tego loginu!';
            }

            if($wszystko_ok==true)
            {
                //wszystkie testy zaliczone, użytkownik zostaje dodany do bazy danych
                if($connect_db->query("INSERT INTO users VALUES(NULL, '$login', '$name', '$surname', '$pass_hash')"))
                {
                    $_SESSION['register_success'] = true;
                    header('Location: index.php');
                }
                else
                {
                    throw new Exception($connect_db->error);
                }
            }

            $connect_db->close();
        }
    }
    catch(Exception $e)
    {
        echo '<span style="color:red;">Błąd servera! Przepraszamy za niedogodności i prosimy o cierpliwość</span>';
        //po dodaniu na server usuwa się tą linie
        echo '<br/>Informacja developerska:'.$e;
    }
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
        <form method="post">
                
                <input type="text" value="<?php 
                if(isset($_SESSION['fr_name']))
                {
                    echo $_SESSION['fr_name'];
                    unset($_SESSION['fr_name']);
                } ?>" name="name" placeholder="imię"/><br/>
                <?php 
                if(isset($_SESSION['e_name']))
                {
                    echo '<div class="error">'.$_SESSION['e_name'].'</div>';
                    unset($_SESSION['e_name']);
                }?>
                
                <input type="text" value="<?php 
                if(isset($_SESSION['fr_surname']))
                {
                    echo $_SESSION['fr_surname'];
                    unset($_SESSION['fr_surname']);
                } ?>" name="surname" placeholder="nazwisko"><br>
                <?php 
                if(isset($_SESSION['e_surname']))
                {
                    echo '<div class="error">'.$_SESSION['e_surname'].'</div>';
                    unset($_SESSION['e_surname']);
                }
                ?>
            
                <input type="text" value="<?php 
                if(isset($_SESSION['fr_login']))
                {
                    echo $_SESSION['fr_login'];
                    unset($_SESSION['fr_login']);
                } ?>" name="login" placeholder="login">
                <?php 
                if(isset($_SESSION['e_login']))
                {
                    echo '<div class="error">'.$_SESSION['e_login'].'</div>';
                    unset($_SESSION['e_login']);
                }
                ?>

                <input type="password" value="<?php 
                if(isset($_SESSION['fr_pass']))
                {
                    echo $_SESSION['fr_pass'];
                    unset($_SESSION['fr_pass']);
                } ?>" name="password" placeholder="hasło">
                <?php 
                if(isset($_SESSION['e_pass']))
                {
                    echo '<div class="error">'.$_SESSION['e_pass'].'</div>';
                    unset($_SESSION['e_pass']);
                }
                ?>
            
                <input type="password" value="<?php 
                if(isset($_SESSION['fr_repass']))
                {
                    echo $_SESSION['fr_repass'];
                    unset($_SESSION['fr_repass']);
                } ?>" name="re_password" placeholder="powtórz hasło">
                <?php 
                if(isset($_SESSION['e_repass']))
                {
                    echo '<div class="error">'.$_SESSION['e_repass'].'</div>';
                    unset($_SESSION['e_repass']);
                }
                ?>
            
            <input type="submit" class="btn" value="Załóż konto">
        </form>
    </div>
</body>
</html>