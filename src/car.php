<?php
//Object
class Car
{
    private $make_model;
    private $price;
    private $miles;
    private $image;
//Constructor
    function __construct($make_model,  $price = 0, $miles=4, $image )
    {
        $this->make_model = $make_model;
        $this->price = $price;
        $this->miles = $miles;
        $this->image = $image;
    }

//Getters and Setters
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
    function setImage ($new_image)
    {
        if($new_image){
            $this->image = $new_image;
        }
    }
    function getImage ()
    {
        return $this->image;

    }
//Methods
    function save()
    {
        array_push($_SESSION['cars'], $this);
    }
//Static Methods
    static function getAll()
    {
        return $_SESSION['cars'];
    }
}

?>
