<?php

require_once 'vendor/autoload.php';

use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Database\Capsule\Manager as Capsule;
use App\Models\FinancialAssistance;

// Create a service container
$container = new Container();

// Create a database capsule
$capsule = new Capsule($container);
$capsule->addConnection([
    'driver' => 'sqlite',
    'database' => database_path('database.sqlite'),
    'prefix' => '',
]);

$capsule->setEventDispatcher(new Dispatcher($container));
$capsule->setAsGlobal();
$capsule->bootEloquent();

// Try to get an application
$app = FinancialAssistance::first();

if ($app) {
    echo "Found application with ID: " . $app->id . "\n";
    echo "Submission ID: " . $app->submission_id . "\n";
} else {
    echo "No applications found\n";
}