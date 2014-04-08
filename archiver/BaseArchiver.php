<?php
/**
 * @package Archiver
 * @author serj0987
 * @copyright (c) 2014, Serj0987
 */
require_once 'Archiver.php';

/**
 * Base class for archives, implements exception handling, 
 * and describes the template methods that must be 
 * implemented in descendant classes.
 * @author serj0987
 */
abstract class BaseArchiver implements Archiver {
    protected $arc;
    protected $init = FALSE;
    
    public final function __construct() {
        if (class_exists($this->getCompressClassName()) == FALSE)
            ErrorBox::getInstance()->getException(7);
    }
    
    /**
     * Returns name of class used for compressing
     * @return string classname
     */
    protected abstract function getCompressClassName();
    
    /**
     * Open archive file for writing
     * @param string $filename
     */
    public final function open($filename) {
        try {
            $result = $this->doOpen($filename);
            $this->init = TRUE;
        } catch (Exception $exception) {
            $this->genError(FALSE, 8, $exception->getMessage());
        }
        $this->genError($result, 8);
        
    }
    
    /**
     * @return boolean Returns TRUE if succcess
     */
    protected abstract function doOpen($filename);
    
    /**
     * Add file in archive
     * @param string $realfile
     * @param string $localpath
     */
    public final function addFile($realfile,$localpath) {
        try {
            $this->checkInit();
            $result = $this->doAddFile($realfile,$localpath);
        } catch (Exception $exception) {
            $this->genError(FALSE, 9, $exception->getMessage());
        }
        $this->genError($result, 9);
        
    }
    
    /**
     * @return boolean Returns TRUE if success
     */
    protected abstract function doAddFile($realfile,$localpath);
       
    public final function close() {
        try {
            $this->checkInit();
            $result = $this->doClose();
        } catch (Exception $exception) {
            $this->genError(FALSE, 10, $exception->getMessage());
        }
        $this->genError($result, 10);
        
    }
    
    /**
     * If archive not opened generate ArchiverException
     */
    protected function checkInit() {
        if ($this->init != TRUE)
           ErrorBox::getInstance()->getException(11);
    }
    
    /**
     * Generate ArchiverException If result != TRUE or archive not opened
     * @param boolean $result
     * @param int $code
     * @param string $message
     */
    protected function genError($result, $code, $message = NULL) {
         if ($result != TRUE)
            ErrorBox::getInstance()->getException($code,$message);
         if (!$this->init)
             ErrorBox::getInstance()->getException(11);    
    } 
    
}
