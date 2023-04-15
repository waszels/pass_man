<?php
session_start();

if(isset($_POST['new_place']) 
    && isset($_POST['new_login']) 
    && isset($_POST['new_password'])
    && isset($_POST['new_password_confirm'])){
    
    $wszystko_ok = true;

    $new_place = $_POST['new_place'];
    $new_login = $_POST['new_login'];
    $new_password = $_POST['new_password'];
    $new_password_confirm = $_POST['new_password_confirm'];
    $privacy = $_POST['privacy'];

    if($new_password!=$new_password_confirm){
        $wszystko_ok = false;
        $_SESSION['e_pass_conf'] = "Hasła nie są identyczne!";
    }
    if($privacy=='private'){
        $privacy = 'private_pass';
    }
    else{
        $privacy = 'common_pass';
    }
    if($wszystko_ok=true)
    {
        require_once "db_credentials.php";
        mysqli_report(MYSQLI_REPORT_STRICT);
        try{
            $db_connect = new mysqli($db_host, $db_usr, $db_pass, $db_name);
            if($db_connect->connect_error!=0) throw new Exception(mysqli_connect_errno());
            else{
                $user_id = $_SESSION['id'];
                if($connect_db->query("INSERT INTO '$privacy' VALUES(NULL, '$user_id', '$new_place', '$new_login', '$new_password', NOW())"))
                {
                    $_SESSION['register_success'] = true;

                }
                else
                {
                    throw new Exception($connect_db->error);
                }
            }
        }
        catch(Exception $e){
        }
    }
}  
else{
    echo "<span name='error_value'>Uzupełnij wszystkie wymagane pola!</span>";
}
?>