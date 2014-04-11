#! /usr/bin/php
<?php
require_once 'AppRegistry.php';
require_once 'FileFinder.php';
require_once 'ArchiverFactory.php';

/**
 * Create app registry and for get params from console
 * @var AppRegistry
 */
$app = new AppRegistry();

/**
 * Get archiver for need format
 * @var Archiver 
 */
$arc = ArchiverFactory::getArchiverFromFormat($app->getFormat());

/**
 * Open archive
 */
$arc->open($app->getOutputFilename());

/**
 * Create new FileFinder and fill
 * @var FileFinder
 */
$finder = new FileFinder($arc,$app->getScanDir());

/**
 * Fill archive
 */
$finder->createBackup();

/**
 * close archive
 */
$arc->close();

?>
