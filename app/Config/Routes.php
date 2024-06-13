<?php

use CodeIgniter\Router\RouteCollection;

//use App\Controllers\FuelTanks;

/**
 * @var RouteCollection $routes
 */
//$routes->get('/', 'Home::index');
$routes->get('/', 'GenSets::index');
$routes->post('GenSets/create', 'GenSets::create');
$routes->post('GenSets/edit', 'GenSets::edit');

$routes->get('GenSets/view/(:segment)', 'GenSets::view/$1');

$routes->get('FuelTanks', 'FuelTanks::index');
$routes->post('FuelTanks/create', 'FuelTanks::create');
$routes->post('FuelTanks/edit', 'FuelTanks::edit');

$routes->get('GenTypes', 'GenTypes::index');
$routes->post('GenTypes/create', 'GenTypes::create');
$routes->post('GenTypes/edit', 'GenTypes::edit');

$routes->get('ServiceTypes', 'ServiceTypes::index');
$routes->post('ServiceTypes/create', 'ServiceTypes::create');
$routes->post('ServiceTypes/edit', 'ServiceTypes::edit');

$routes->get('api/genTypes', 'Api::genTypes');
$routes->get('api/fuelTanks', 'Api::fuelTanks');
$routes->get('api/serviceTypes', 'Api::serviceTypes');
$routes->get('api/genSets', 'Api::genSets');
$routes->get('api/genRunning/(:num)', 'Api::genRunning/$1');

$routes->get('Refuels', 'Refuels::index');
$routes->post('Refuels/create', 'Refuels::create');

$routes->get('Runs', 'Runs::index');
$routes->post('Runs/start', 'Runs::start');
$routes->post('Runs/stop', 'Runs::stop');

$routes->get('Services', 'Services::index');
$routes->post('Services/create', 'Services::create');

$routes->cli('MyCli/reportRunsDay', 'MyCli::reportRunsDay');
$routes->cli('MyCli/reportRunsDayMail', 'MyCli::reportRunsDayMail');

service('auth')->routes($routes);
