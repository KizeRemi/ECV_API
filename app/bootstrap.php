<?php
use Silex\Application;
use Silex\Provider;

$app->register(new Provider\DoctrineServiceProvider(), 
    array('db.options' => [
              'driver'  => 'pdo_mysql',
              'charset' => 'utf8',
              'driverOptions' => array(1002 => 'SET NAMES utf8'),
              'host'    => '127.0.0.1',
              'port' 	=> '8889',
              'dbname'  => 'cinema',
              'user'    => 'root',
              'password'=> 'root'
        ]));