<?php
    $website = require_once __DIR__.'/../app/app.php';
    $website->run();

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <body>
        <ul>
            <?php foreach ($cars_matching_search as $car) {
                $make = $car->getModel();
                $price =  $car->getPrice();
                $miles = $car->getMiles();
                echo "<li> Car: $make |Price :$price |Miles: $miles </li>";
                echo "<li><img src='$car->image'></li>";
            }
            if(empty($cars_matching_search)){
                echo "No cars matching your search. Lower your expectations :(";
            }
             ?>
        </ul>

    </body>
</html>
