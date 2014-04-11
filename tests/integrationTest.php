<?php

require_once '../AppRegistry.php';
require_once '../FileFinder.php';
require_once '../ArchiverFactory.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of integrationTest
 *
 * @author serj0987
 */
abstract class IntegrationTest extends PHPUnit_Framework_TestCase {
    
    protected $app;


    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->app = new AppRegistry($this->getScanDir(),  $this->getFormat());
    }
    
    public function testCreateBackup() {
        $arc = ArchiverFactory::getArchiverFromFormat($this->app->getFormat());
        $arc->open($this->app->getOutputFilename());
        $finder = new FileFinder($arc,$this->app->getScanDir());
        $finder->createBackup();
        $arc->close();
        if (!file_exists($this->app->getOutputFilename()))
            $this->fail('Not created backup');
    } 


    protected abstract function getScanDir();
    protected abstract function getFormat();

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        @unlink($this->app->getOutputFilename());
        
    }

}

