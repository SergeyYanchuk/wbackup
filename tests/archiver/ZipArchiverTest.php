<?php


require_once '../../archiver/ZipArchiver.php';
require_once 'BaseArchiverTest.php';

class ZipArchiverTest extends BaseArchiverTest {


    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new ZipArchiver;
    }
    
    protected function getGoodOutputName() {
        return '/home/serj0987/test.zip';
    }
    
    protected function getWrongFilename() {
        return '/home/$%^&*serj07/test.zip';
    }
    
    protected function getAddFile() {
        return '/home/serj0987/addfile1.txt';
    }
    
}
