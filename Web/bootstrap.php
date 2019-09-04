<?php

require ('../Application/Vendor/SplClassLoader.php');
$OCFramLoader = new SplClassLoader('Application', '../');
$OCFramLoader->register();

use Application\Controller\IndexController;

$index = new IndexController();
$index->executeIndex();
