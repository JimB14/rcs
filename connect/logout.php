<?php
session_start();

session_destroy();

?>


<!DOCTYPE html>
<html lang="en">
    <head>
      <meta charset="utf-8">
      <title></title>  
    </head>
    <body>
        <div id="php">

            <?php
                echo "You have been logged out.<br><br>";
                echo "<a href='../private/login.php'>Log in</a><br><br>";
                echo "<a href='../index.php'>Go to home page</a>";
            ?>
        </div>	

    </body>
</html>	