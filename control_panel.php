<?php
session_start();

if(!isset($_SESSION['logged']))
{
    header('Location: index.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style_control_panel.css">

    <title>Menedżer haseł</title>
</head>
<body>
    <header>
        <nav>
            <ul class="navigation">
                <li>MENEDŻER HASEŁ</li>
                <li>PUSTE</li>
                <li>PUSTE</li>
                <li>PUSTE</li>
                <li><a href="logout.php">WYLOGUJ SIĘ</a></li>
            </ul>
        </nav>
    </header>
    <div class="content">
            
    </div>

    <script src="jquery-3.6.3.min.js"></script>
    <script src="control_panel.js"></script>
</body>
</html>