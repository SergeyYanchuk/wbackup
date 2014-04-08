<?php


require_once '../../archiver/BzArchiver.php';
require_once 'BaseArchiverTest.php';

class BzArchiverTest extends BaseArchiverTest {


    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new BzArchiver;
    }
    
    protected function getGoodOutputName() {
        return '/home/serj0987/test.tar.bz2';
    }
    
    protected function getWrongFilename() {
        return '/home/$%^&*serj07/test.tar.bz2';
    }
    
    protected function getAddFile() {
        return '/home/serj0987/addfile1.txt';
    }
    
}
