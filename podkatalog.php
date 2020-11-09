<!DOCTYPE html>
<html>
    <head>
        <title>Malicki</title>
        <link rel="stylesheet" href="style1111.css" type="text/css" />
    </head>
    <body>
 
    <?php
        $user = $_COOKIE['user'];
        $podkatalog = $_GET['podkatalog'];
        echo "<p><div style='text-align: left;'>Scieżka plików na dysku:/".$user."/".$podkatalog."</div></p>";?></p><br>
       
        Prześlij plik:
        <form action="odbierz_podkatalog.php" method="POST" ENCTYPE="multipart/form-data">
        <input type="file" name="plik"/>
        <input type="hidden" name="podkatalog" value="<?php echo $_GET['podkatalog']; ?>" />
        <input type="submit" value="Wyślij plik"/></form>
 
       Twoje pliki:<br>

    <?php       
        $pliki = array_diff(scandir($user . DIRECTORY_SEPARATOR . $podkatalog), array('.', '..'));

        foreach($pliki as $file) {
            if(is_dir($user . DIRECTORY_SEPARATOR . $podkatalog . DIRECTORY_SEPARATOR . $file)){
                  echo "<li><a href='podkatalog.php?podkatalog=$file'>$file</a></li>";
            } else{
                echo "<li><a href='$user/$podkatalog/$file' download='$file'>$file</a></li>";
            }
      }
 
    ?>
           
    </body>
</html>
