<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/car.php";

    $app = new Silex\Application();

    $app->get("/", function() {
        return "
        <!DOCTYPE html>
        <html>
            <head>
                <meta charset='utf-8'>
                <title>Buy a Car</title>
            </head>
            <body>
                <h1>Lets buy a car</h1>
                <form class='' action='/view-cars'>
                    <label for=''>Max Miles Desired:</label>
                    <input type='text' name='input_miles' value=''>
                    <label for=''>Max Price Desired:</label>
                    <input type='text' name='input_price' value=''>
                    <button type='submit' name='button'></button>
                </form>
            </body>
        </html>"
        ;
    });

    $app->get("/view-cars", function() {
        $porsche = new Car("2014 Porsche 911", 114991, 7864,"../img/porsche-model.png");
        $ford = new Car("2011 Ford F450", 55995,55995, "../img/ford.png");
        $lexus = new Car("2013 Lexus RX 350",  20000, 8990809, "../img/lexus.png");
        $mercedes = new Car("Mercedes Benz CLS550",8980, 2, "../img/mercedes.png");
        $cars = array($porsche, $ford, $lexus, $mercedes);
        $cars_matching_search = array();
        foreach ($cars as $car) {
            $price =  $car->getPrice();
            $miles = $car->getMiles();
            if($miles < $_GET['input_miles'] && $price < $_GET['input_price']){
                array_push($cars_matching_search, $car);
            }
        }
        $output = "";
        foreach ($cars_matching_search as $car) {
            $output = $output .  '<li> Car: ' .$car->getModel() . '|Price : ' . $car->getPrice() . '|Miles: ' . $car->getMiles() . '</li><li><img src=' . $car->image . '></li>';
        }
        if(empty($cars_matching_search)){
            echo 'No cars matching your search. Lower your expectations';
        }

        return "
        <!DOCTYPE html>
        <html>
            <head>
                <meta charset='utf-8'>
                <title></title>
            </head>
            <body>
                <ul> $output </ul>
            </body>
        </html>"
        ;
    });

    return $app;
?>
