<!-- BACK END -->
<?php
    if (isset($_POST['user'])){
        // Dane z formularza
        $user = $_POST['user'];
        $pass = $_POST['pass'];
        $pass2 = $_POST['pass2'];
        // nawiązanie połączenia z bazą danych
        $dbhost="mariadb105.server146596.nazwa.pl";
        $dbuser="server146596_test";
        $dbpassword="Paczunchapl1"; 
        $dbname="server146596_test";
        $link = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
        if (!$link) {
            echo "Błąd połączenia z MySQL." . PHP_EOL;
            echo "Errno: " . mysqli_connect_errno() . PHP_EOL;
            echo "Error: " . mysqli_connect_error() . PHP_EOL;
            exit;
        }
        if($pass == $pass2 && $user != ""){
            mkdir($user);
            if ($link->query("INSERT INTO `users7`(`id`,`user`,`pass`) VALUES (NULL, '$user', '$pass')")){
                header('Location: index.php');
            }else{
                echo "Błąd przy rejestracji: Wpisz te same hasła lub wpisz nazwę użytkownika!";
            }
            $link->close();
        }
    }
?>
<!-- FRONT END -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Malicki</title>
</head>
<body>
    <form method="post" action="rejestracja.php">
        Login: <br /><input type="text" name="user" /> <br />
        Hasło: <br /><input type="password" name="pass" /> <br /><br />
        Powtórz hasło: <br /><input type="password" name="pass2" /> <br /><br />
        <input type="submit" value="Zarejestruj się" />
    </form>
 
</body>
</html>