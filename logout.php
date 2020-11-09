<?php 
    setcookie("user", "", time() - 3600); 
    setcookie("pass", "", time() - 3600); 
    setcookie("zalogowany", 0, time() - 3600); 
?>
<html>  
<body> 
    <?php 
    echo "Poprawnie wylogowano!";
    echo "<br>";
    echo "<br>";
    echo "<A href ='index.php'>Przejdź do strony głównej</A>"
    ?> 
  
</body> 
</html> 