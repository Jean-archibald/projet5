<?php
session_start();
require __DIR__.'/../MyFram/SplClassLoader.php';

$MyFramLoader = new SplClassLoader('MyFram', __DIR__.'/../');
$MyFramLoader->register();

$modelLoader = new SplClassLoader('Model', __DIR__.'/../vendor');
$modelLoader->register();

$entityLoader = new SplClassLoader('Entity', __DIR__.'/../vendor');
$entityLoader->register();