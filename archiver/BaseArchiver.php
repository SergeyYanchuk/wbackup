<?php
require_once 'Archiver.php';
require_once '../ErrorBox.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BaseArchiver
 *
 * @author serj0987
 */
abstract class BaseArchiver implements Archiver {
    protected $arc;
    protected $init = FALSE;
    
    public final function __construct() {
        if (class_exists($this->getCompressClassName()) == FALSE)
            ErrorBox::getInstance()->getException(7);
    }
    
    protected abstract function getCompressClassName();

    public final function open($filename) {
        try {
            $result = $this->doOpen($filename);
            $this->init = TRUE;
        } catch (Exception $exception) {
            $this->genError(FALSE, 8, $exception->getMessage());
        }
        $this->genError($result, 8);
        
    }
    
    protected abstract function doOpen($filename);
    
    public final function addFile($realfile,$localpath) {
        try {
            $result = $this->doAddFile($realfile,$localpath);
        } catch (Exception $exception) {
            $this->genError(FALSE, 9, $exception->getMessage());
        }
        $this->genError($result, 9);
        
    }
    
    protected abstract function doAddFile($realfile,$localpath);
       
    public final function close() {
        try {
            $result = $this->doClose();
        } catch (Exception $exception) {
            $this->genError(FALSE, 10, $exception->getMessage());
        }
        $this->genError($result, 10);
        
    }

    protected function genError($result, $code, $message = NULL) {
         if ($result != TRUE)
            ErrorBox::getInstance()->getException($code,$message);
         if (!$this->init)
             ErrorBox::getInstance()->getException(11);    
    } 
    
    
    
    
}
