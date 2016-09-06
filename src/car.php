
<?php

class Car
{
    private $make_model;
    private $price;
    private $miles;
    public $image;
    function __construct($make_model,  $price = 0, $miles=4, $image )
    {
        $this->make_model = $make_model;
        $this->price = $price;
        $this->miles = $miles;
        $this->image = $image;
    }
    function setPrice ($new_price)
    {
        $float_price =(float) $new_price;
        if($float_price != 0){
            $formatted_price = number_format($float_price, 2);
            $this->price = $formatted_price;
        }

    }
    function getPrice ()
    {
        return $this->price;

    }
    function setModel ($new_model)
    {
        if($new_model){
            $this->make_model = $new_model;
        }

    }
    function getModel ()
    {
        return $this->make_model;

    }
    function setMiles ($new_miles)
    {
        if($new_miles){
            $this->miles = $new_miles;
        }
    }
    function getMiles ()
    {
        return $this->miles;

    }
}

$porsche = new Car("2014 Porsche 911", 114991, 7864,"../img/porsche-model.png");
$ford = new Car("2011 Ford F450", 55995,55995, "../img/ford.png");
$lexus = new Car("2013 Lexus RX 350",  20000, 8990809, "../img/lexus.png");
$mercedes = new Car("Mercedes Benz CLS550",8980, 2, "../img/mercedes.png");


$cars = array($porsche, $ford, $lexus, $mercedes);

$cars_matching_search = array();
foreach ($cars as $car) {
    $price =  $car->getPrice();
    $miles = $car->getMiles();
    if ($miles <  $_GET["input_miles"] && $price < $_GET["input_price"]) {
        array_push($cars_matching_search, $car);
    }
}
?>
