<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/car.php";

    session_start();
    if (empty($_SESSION['cars'])) {
        $_SESSION['cars'] = array();
        $porsche = new Car("2014 Porsche 911", 114991, 7864,"../img/porsche-model.png");
        $ford = new Car("2011 Ford F450", 55995,55995, "../img/ford.png");
        $lexus = new Car("2013 Lexus RX 350",  20000, 8990809, "../img/lexus.png");
        $mercedes = new Car("Mercedes Benz CLS550",8980, 2, "../img/mercedes.png");
        $porsche->save();
        $ford->save();
        $lexus->save();
        $mercedes->save();
    }

    $app = new Silex\Application();

    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'));

    $app->get("/", function() use ($app) {
        return $app['twig']->render('landing-page.html.twig');
    });

    $app->get("/search", function() use ($app) {
        return $app['twig']->render('search.html.twig');
    });

    $app->get("/view-cars", function() use ($app) {
        $cars_matching_search = array();
        foreach ($_SESSION['cars'] as $car) {
            $price =  $car->getPrice();
            $miles = $car->getMiles();
            if($miles < $_GET['input_miles'] && $price < $_GET['input_price']){
                array_push($cars_matching_search, $car);
            }
        }
        return $app['twig']->render('view-cars.html.twig', array('cars' => $cars_matching_search));
    });

    $app->post('/view-cars', function() use ($app) {
        $newCar = new Car($_POST['make_model'], $_POST['price'], $_POST['miles'], $_POST['image']);
        $newCar->save();

        return $app['twig']->render('view-cars.html.twig', array('cars' => Car::getAll()));
    });

    $app->get('/post-car', function() use ($app) {
        return $app['twig']->render('post-car.html.twig');
    });

    return $app;
?>
