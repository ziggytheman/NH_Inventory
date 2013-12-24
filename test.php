<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        include("includes\dbConfig.php");
        $dbSuccess = false;
        $dbSelected = mysqli_connect($db['hostname'], $db['username'], $db['password'], $db['database']);


        if ($dbSelected) {
            $dbSuccess = true;
        } else {
            echo "DB Selection FAILed <br/>";
            echo mysqli_error($dbSelected) . "<br/>";
            $returnMsg = mysqli_error($dbSelected);
        }
        ?>
        <h1><?php echo $returnMsg;?><h1>
    </body>
</html>
