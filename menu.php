<?php   
$user = $_COOKIE['user'];

echo "<p><div style='text-align: left;'>Scieżka plików na dysku:/".$user."/</div></p>";?></p>
<!DOCTYPE HTML>
<html lang="pl">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<title>Malicki</title>
</HEAD>
<BODY>
      <h2><b>Upload plików</b></h2>
      <form action="odbierz.php" method="POST" ENCTYPE="multipart/form-data">              
            <input type="file" name="plik"/>             
            <input type="submit" value="Wyślij plik"/> 
      </form>
<?php
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
      $user = $_COOKIE['user'];
      mysqli_close($link); // zamknięcie połączenia z BD
?>
      <h2><b>Tworzenie folderów</b></h2>
      Nazwa nowego folderu:
      <form method="post" action="folder.php">
            <input type="text" name="podkatalog" size="10" maxlength="10">
      <input type="submit" value="Zatwierdź!">
      </form><br>
      <h2><b>Pobieranie plików</b></h2>
      <?php       
      $pliki = array_diff(scandir($user), array('.', '..'));
      foreach($pliki as $file) {
            if(is_dir($user . DIRECTORY_SEPARATOR . $file)){
                  echo "<li><a href='podkatalog.php?podkatalog=$file'>$file</a></li>";
            } else{
                  echo "<li><a href='$user/$file' download='$file'>$file</a>";
            }
      }
 
      ?>
 

</BODY>
</HTML>