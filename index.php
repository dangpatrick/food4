<?php
/*
 * Name Patrick Dang
 * Date: 1/28/2021
 * Filename: index.php
 * Description: Controller page for food4 practice
 */

//This is my CONTROLLER page

// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Start a session
session_start();

//Require the auto autoload file
require_once('vendor/autoload.php');
require_once('model/data-layer.php');

//Create an instance of the Base class
$f3 = Base::instance();
$f3->set('Debug',3);

//Define a default route (home page)
$f3->route('GET /', function(){
    $view = new Template();
    echo $view->render('views/home.html');
});

//Define an order1 route
$f3->route('GET /order', function($f3){

//    $meals = getMeals();
//    var_dump($meals);
    $f3->set('meals', getMeals());

    //Display a view
    $view = new Template();
    echo $view->render('views/form1.html');
});

//Define an order2 route
$f3->route('POST /order2', function($f3){

    $f3->set('condiments', getCondiments());

    //add data from form1 to session array
    //var_dump($_POST);
    if(isset($_POST['food'])) {
        $_SESSION['food'] = $_POST['food'];
    }

   // var_dump($_POST);
    if(isset($_POST['meal'])) {
        $_SESSION['meal'] = $_POST['meal'];
    }

    //Display a view
    $view = new Template();
    echo $view->render('views/form2.html');
});

//Define an summary route
$f3->route('POST /summary', function(){

//    echo "POST:<br>";
//    var_dump($_POST);

    //echo"<p> SESSION: </p>";
    //var_dump($_SESSION);

    //add data from form2 to session array
    //var_dump($_POST);
    if(isset($_POST['conds'])) {
        $_SESSION['conds'] = implode(", ", $_POST['conds']);
    }


    //display a view
    $view = new Template();
    echo $view->render('views/summary.html');
});



//Run fat free
$f3->run();