<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

spl_autoload_register(function ($class_name) {
    $class_name = str_replace('\\', '/', $class_name);
    require_once  'src/' . $class_name . '.php';
});

use Surveys\DataLoader\JsonDataLoader;
use Surveys\Survey;
use Surveys\Examination;

$survey = new Survey(new JsonDataLoader('survey.json'));
$examination = new Examination();
$examination->setSurvey($survey);
$examination->setView(new View('./views'));
$examination->perform();