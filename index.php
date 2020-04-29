<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

use App\Tools\DevTools;

require_once ('Tools/DatabaseTools.php');
require_once ('Tools/DevTools.php');
require ('Classes/Driver.php');
require ('Classes/DriverTools.php');

$dbTools = new DatabaseTools('localhost', 'coca1negg_wf3', 'coca1negg_wf3', '%i1bm9pL');
$dbTools->initDatabase();

$dump = new DevTools();
//$dump->prettyVarDump($dbTools->executeQuery('SELECT * FROM Drivers'));







//$car = $dbTools->executeQuery("select * from Drivers");
//$dump->prettyVarDump($car);


$uriRequest = $_SERVER['REQUEST_URI'];
$uri = parse_url($uriRequest,PHP_URL_PATH);
require('Components/htmlHeader.php');
switch ($uri){
    case '/':
        echo '<h1>Welcome</h1>';
        break;
    case '/driver':
        require(__DIR__.'/Pages/driver.php');
        break;
    case '/car':
        require(__DIR__.'/Pages/car.php');
        break;
    case '/association':
        require(__DIR__.'/Pages/association.php');
        break;
    default:
        require (__DIR__.'/Pages/404.php');
        break;
}
require('Components/htmlFooter.php');