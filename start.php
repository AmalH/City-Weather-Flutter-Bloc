<?php
require 'vendor/autoload.php';

use App\Helpers\DbConnection;
use Dotenv\Dotenv;


$dotenv = new DotEnv(__DIR__);
$dotenv->load();

$dbConnection = (new DbConnection())->connet();