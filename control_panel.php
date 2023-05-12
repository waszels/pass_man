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
        <div id="content-menager">
             
            <div id="titles">
                <div class="title">
                    <span class="title-menager">Hasła wspólne</span>
                </div>
                
                <div class="title">
                    <span class="title-menager">Hasła prywatne</span>
                </div>
            </div>
            
            <div id="tables">
                <div class="divtable">
                    <table class="table-pass">
                        <tr>
                            <th class="table-header">Miejsce</th>
                            <th class="table-header">Login</th>
                            <th class="table-header">Hasło</th>
                        </tr>
                    </table>
                </div>
                
                <div class="divtable">
                    <table class="table-pass">
                        <tr>
                            <th class="table-header">Miejsce</th>
                            <th class="table-header">Login</th>
                            <th class="table-header">Hasło</th>
                        </tr>
                    </table>
                </div>
            </div> 
        
        <div class="content-nav">
            
            <div class="buttons-div">
                
                <div id="div-form">
                    <form>
                        <span class="text-nav">Dodawanie nowego hasła</span>
                        <input type="text" name="new_place" placeholder="miejsce">
                        <input type="text" name="new_login" placeholder="login">
                        <input type="password" name="new_password" placeholder="hasło">
                        <input type="password" name="new_password_confirm" placeholder="potwierdź hasło">
                        <input type="submit" value="Dodaj" id="pass-send">
                        <input type="radio" name="privacy" value="private" class="radio-type">
                        <span class="radio-text">Prywatne</span>
                        <input type="radio" name="privacy" value="common" class="radio-type">
                        <span class="radio-text">Wspólne</span>
                    </form>
                </div>
                
                <div id="div-statement"></div>
            
            </div>

            <div class="buttons-div"></div>
        </div>
    </div>

    <script src="jquery-3.6.3.min.js"></script>
    <script src="control_panel.js"></script>
</body>
</html>