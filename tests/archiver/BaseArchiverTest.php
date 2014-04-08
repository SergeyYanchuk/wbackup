<?php

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2014-04-02 at 12:11:12.
 */
require_once '../../Exceptions.php';
require_once '../../ErrorBox.php';

abstract class BaseArchiverTest extends PHPUnit_Framework_TestCase {

    /**
     * @var ZipArchiver
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new ZipArchiver;
    }
    
    public function testOpenGood()
    {
        try {
        $this->object->open($this->getGoodOutputName());
        } catch (ArchiveException $ex) {
            $this->fail('Not open file');
        }   
    }
    
    
    public function testAddFileNotInitWrongFilename() {       
        try {
           $this->object->AddFile($this->getWrongFilename(),
                   basename($this->getWrongFilename()));
        } catch (ArchiverException $ex) {
            return;
        }   
        $this->fail('Not initialized archive');
    }
    
     public function testAddFileInit() {       
        try {
            $this->object->open($this->getGoodOutputName());
            $this->object->AddFile($this->getWrongFilename(),
                    basename($this->getWrongFilename()));
        } catch (ArchiverException $ex) {
            return;
        }   
        $this->fail('Adding not exists file but error not detected');
    }
    
     public function testAddFileExistsFile() {  
        file_put_contents($this->getAddFile(), 'test file');
        try {
            $this->object->open($this->getGoodOutputName());
            $this->object->AddFile($this->getAddFile(),
                    basename($this->getAddFile()));
        } catch (ArchiverException $ex) {
            $this->fail('File not added');
        }   
        
    }
    
    public function testClose() {
        file_put_contents($this->getAddFile(), 'test file');
        try {
            $this->object->open($this->getGoodOutputName());
            $this->object->AddFile($this->getAddFile(),
                    basename($this->getAddFile()));
            $this->object->close();
            
        } catch (ArchiverException $ex) {
            $this->fail('File saving error');
        }   
        
        
    }
    
    protected abstract function getGoodOutputName();
    protected abstract function getWrongFilename();
    protected abstract function getAddFile();




    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        @unlink($this->getGoodOutputName());
        @unlink($this->getAddFile());
        
    }

}