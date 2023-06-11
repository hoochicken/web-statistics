<?php

use Hoochicken\ParameterBag\ParameterBag;
use Hoochicken\WebStatistics\WebStatistics;

$autoload = ['../../../autoload.php', '../../dbtable/src/Database.php',  '../../parameter-bag/src/ParameterBag.php', '../src/WebStatistics.php', '../src/WebStatisticsTable.php'];
foreach ($autoload as $filename) {
    if (file_exists($filename)) {
        require_once $filename;
    }
}

$host = 'localhost';
$database = 'users';
$user = 'root';
$password = 'root';

$statisticsTable = 'webstats3';

$webstatistics = new WebStatistics();
$webstatistics->initDb($host, $database, $user, $password);
$webstatistics->setServer(new ParameterBag($_SERVER));
$webstatistics->setTable($statisticsTable);
if (!$webstatistics->tableExists()) {
    $webstatistics->createTable();
}
$webstatistics->addEntry();

print_r($webstatistics->getData());

