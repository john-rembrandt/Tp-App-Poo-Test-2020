<?php

require ('../Vendor/SplClassLoader.php');
$OCFramLoader = new SplClassLoader('Application', '../');
$OCFramLoader->register();

$LibLoader = new SplClassLoader('Lib', '../');
$LibLoader->register();

use Application\Controller\IndexController;

$index = new IndexController();
$index->executeIndex();
