<?php
session_start();

//sprawdź czy zmienna post login i password została ustawiona/wpisana
//jeśli nie to wróc na strone logowania i zakończ skrypt php
if((!isset($_POST['login'])) || (!isset($_POST['password'])))
{
    header('Location:index.php');
    exit();
}

//dołącza plik z danymi logowania do bazy:
require_once "db_credentials.php";

//włącza raportowanie błędów co pozwala na obługe za pomocą try{}catch(Exception $e){}
//MYSQLI_REPORT_STRICT to tryb "ścisły" wymusza zgłaszanie błędów związanych z bazą danych za pomocą wyjątków
mysqli_report(MYSQLI_REPORT_STRICT);
try{
    //obiekt połączenia z bazą danych
    $db_connect = new mysqli($db_host, $db_user, $db_pass, $db_name);

    if($db_connect->connect_error!=0) throw new Exception(mysqli_connect_errno());
    else{
        
        //przypisuje wysłane wartości z POSTA do zmiennych
        $login = $_POST['login'];
        $password = $_POST['password'];
        $login = htmlentities($login, ENT_QUOTES, "UTF-8");
        $result = $db_connect->query(sprintf("SELECT * FROM users WHERE login='%s'",mysqli_real_escape_string($db_connect,$login)));
        
        if(!$result) throw new Exception($db_connect->error);
    
        $users_number = $result->num_rows;
        
        if($users_number > 0)
        {
            $row = $result->fetch_assoc();
            
            if(password_verify($password, $row['password']))
            {
                $_SESSION['logged'] = true;
                $_SESSION['id'] = $row['id'];
                $_SESSION['login'] = $row['login'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['surname'] = $row['surname'];
                //usuwa sesyjną błędu
                unset($_SESSION['error']);
                //zwalnia pamięć przez wyniki z bazy danych
                $result->free_result();
                //po zalogowaniu przenosi do głównego panelu
                header('Location: control_panel.php');
            }
            else
            {
            //jeśli hasło było nieprawidłowe dodaje do zmiennej sesyjnej tekst wyświetlający się w index pod formularzem
            $_SESSION['error'] = '<span class="login-error">NIEPRAWIDŁOWY LOGIN LUB HASŁO1!</span>';
            header('Location: index.php');
            }
        }
        else
        {
            //jeśli login był nieprawidłowy dodaje do zmiennej sesyjnej tekst wyświetlający się w index pod formularzem
            $_SESSION['error'] = '<span class="login-error">NIEPRAWIDŁOWY LOGIN LUB HASŁO2!</span>';
            header('Location: index.php');
        }
        //zamknięcie połączenia z bazą danych
        $db_connect->close();
    }
}
catch(Exception $e)
{
    echo '<Błąd style="color:red;">Błąd servera! Przepraszamy za niedogodności i prosimy o cierpliwość</span>';
        //po dodaniu na server usuwa się tą linie
        echo '<br/>Informacja developerska:'.$e;
}
?>