<?php

require ('SplClassLoader.php');
$OCFramLoader = new SplClassLoader('ProjetDeCache');
$OCFramLoader->register();

use ProjetDeCache\IndexController;

$index = new IndexController();
$index->executeIndex();
/*
function my_autoload ($pClassName) {
        include(__DIR__ . "/" . $pClassName . ".php");
    }
    spl_autoload_register("my_autoload");
*/