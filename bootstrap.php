<?php
// bootstrap.php
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

require_once 'vendor/autoload.php';

// DB connection configuration
$dbParams = array(
    'host'     => '127.0.0.1',
    'port'     => '8889',
    'driver'   => 'pdo_mysql',
    'user'     => 'root',
    'password' => 'root',
    'dbname'   => 'ecv_api',
);

$config = Setup::createYAMLMetadataConfiguration([realpath(__DIR__."/mappings")], /* isDevMode */ true);

$entityManager = EntityManager::create($dbParams, $config);