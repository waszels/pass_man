<?php

session_start();

require_once "db_credentials.php";

$connection = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($connection->connect_errno!=0){
    echo "Error ".$connection->connect_errno;
}
else{
    $result = $connection->query("SELECT place, login, password FROM common_pass");
    while($row = $result -> fetch_assoc()){
        $data_common[] = $row;
    }

    $id_user = mysqli_real_escape_string($connection, $_SESSION['id']);
    $result = $connection->query("SELECT place, login, password FROM private_pass WHERE id_user='$id_user'");
    while($row = $result -> fetch_assoc()){
        $data_private[] = $row;
    }
    
    $data = array('json1' => $data_common, 'json2' => $data_private);
    $j_data = json_encode($data);
    echo $j_data;
    $result->free_result();
}
$connection->close();
?>