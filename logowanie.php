<!-- BACK END -->
<?php
    $licznik = 0;
    if (isset($_POST['user'])){ // Ten jeden if obejmujący cały back end służy w 1 celu: Aby nie wywalało błędu spowodowanego nullami przy
                                //zmiennych user oraz pass, gdy odwołamy się do formularza po raz pierwszy

        // Funkcje, ktore beda wykorzystywane w kodzie
        function ip_details($info) {  
            $json = file_get_contents ("http://ipinfo.io/{$info}/geo");
            $details = json_decode ($json);
            return $details;
        }

        // Odbierz dane od użytkownika
        $user = $_POST['user'];
        $pass = $_POST['pass'];


        // Cookie
        $cookie_name = "user";
        $cookie_value = "";
        $cookie_time = "time()+3600*24";

        //Flagi
        $status = "zalogowany";

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
        // Logowanie, ale najpierw sprawdź liczbę prób oraz, czy w ogólnie taki użytkownik istnieje
        if(isset($_POST['user'])){
            $licznik = $_POST['licznik'];
            if($licznik < 4){
                $result = mysqli_query($link, "SELECT * FROM `users7` WHERE user='$user'");
                $rekord = mysqli_fetch_array($result);
                // $_SESSION['id'] = $rekord['id'];
                // $_SESSION['user'] = $rekord['user'];
            }
        }
        // Czy istnieje
        if(!$rekord){ // Jeśli nie
            echo "Brak użytkownika o takim loginie!";
        } else { //Jeśli tak
            if($rekord['pass']==$pass){ // Gdy hasło poprawne
                $cookie_value = $user;
                setcookie($cookie_name, $cookie_value, (int)$cookie_time);
                setcookie("pass", $pass, (int)$cookie_time);
                setcookie("zalogowany", TRUE, (int)$cookie_time);
                echo '<script type="text/javascript">location.href = "menu.php"</script>';

                // Dane na potrzeby tabeli "logi"
                $ipaddress = $_SERVER["REMOTE_ADDR"];
                $details = ip_details($ipaddress);
                $details -> ip;
                $info = $details -> ip;
                $data = date ("Y-m-d", time());
                $czas = date ("H:i", time());
                $p = ',';
                $czas2 = $data . $p . $czas;

                //Wstaw logi o powodzeniu
                $klienci = mysqli_query($link, "INSERT INTO `logi`(`user`, `datagodzina`, `liczba_prob`) VALUES ('$user','$czas2','$licznik')");
            } else{ // Gdy hasło błędne
                $licznik++;
                $data = date ("Y-m-d", time());
                $czas = date ("H:i", time());
                $p = ',';
                $czas2 = $data . $p . $czas;
                echo "Błędny login lub hasło! Numer próby: '.$licznik.'"; // Powiadom o próbie

                // Zapisz log o niepowodzeniu
                $klienci2 = mysqli_query($link, "INSERT INTO `logi`(`user`, `datagodzina`, `liczba_prob`) VALUES ('$user','$czas2','$licznik')");
                mysqli_close($link);
            }
        }
            if($licznik==4){
                echo'<script type ="text/javascript">alert("Możliwość logowania została zablokowana")</script>';
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
<?php
 if(isset($_COOKIE['user'])){
    if($_COOKIE['zalogowany'] == 1) {
        echo 'Twój login: '.$_COOKIE['user'].'';
        echo '<br/>';
        echo 'Twoje hasło: '.$_COOKIE['pass'].'';
        echo '<br/>';    
        echo '<a href="logout.php">Wyloguj</a>';
    } else {   
        print "";
    }
}
?>
    <form action="logowanie.php" method="post">
       <input type='hidden' name='licznik' value="<?php $licznik ?>">
        Login: <br /><input type="text" name="user" /> <br />
        Hasło: <br /><input type="password" name="pass" /> <br /><br />
        <input type="submit" value="Zaloguj się" />
    </form>
</body>
</html>
