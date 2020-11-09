<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Malicki</title>
</head>
<body>
    <h1>Witaj</h1>
    <h3>Zaloguj się!</h3>
    <a href="logowanie.php">Logowanie</a><br><br>
    <h3>Zarejestruj się!</h3>
    <a href="rejestracja.php">Rejestracja</a><br><br>
    <?php
    if(isset($_COOKIE['user'])){
            if($_COOKIE['zalogowany'] == 1) {
                echo 'Twój login: '.$_COOKIE['user'].'';
                echo '<br/>';
                echo 'Twoje hasło: '.$_COOKIE['pass'].'';
                echo '<br/>';    
                echo '<a href="logout.php">Wyloguj</a>';
            } else {   
                echo 'Niezalogowany!!';
            }
        }
    ?>
</body>
</html>