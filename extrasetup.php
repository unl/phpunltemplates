<?php
/**
* This file generates the pyrus.phar file and PEAR2 package for Pyrus.
*/

$current = \Pyrus\Config::current();
$config = \Pyrus\Config::singleton(__DIR__ . '/vendor');

$extrafiles = array(
    $config->registry->toPackage('UNL_DWT', 'pear.unl.edu'),
);



\Pyrus\Config::setCurrent($current->path);


