<?php


require_once '../../archiver/GzArchiver.php';
require_once 'BaseArchiverTest.php';

class GzArchiverTest extends BaseArchiverTest {


    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new GzArchiver;
    }
    
    protected function getGoodOutputName() {
        return '/home/serj0987/test.tar.gz';
    }
    
    protected function getWrongFilename() {
        return '/home/$%^&*serj07/test.tar.gz';
    }
    
    protected function getAddFile() {
        return '/home/serj0987/addfile1.txt';
    }
    
}
