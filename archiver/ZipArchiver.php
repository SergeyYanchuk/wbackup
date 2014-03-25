<?php

require_once 'Archiver.php';
require_once '../ErrorBox.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ZipArchiver
 *
 * @author serj0987
 */
class ZipArchiver implements Archiver{
    private $arc;
    private $init = FALSE;
    
    public function __construct() {
        if (!class_exists('ZipArchive'))
            ErrorBox::getInstance()->getException(7);
        $this->arc = new ZipArchive();
    }
    
    public function open($filename) {
        $result = $this->arc->open($filename, ZIPARCHIVE::CREATE); 
        $this->init = TRUE;
        $this->genError($result, 8);         
    }
    
    public function addFile($realfile, $localpath) {
        $result = $this->arc->addFile($realfile,$localpath);
        $this->genError($result, 9);
    }
    
    public function close() {
        $result = $this->arc->close();
        $this->genError($result, 10);      
    }

        private function genError($result, $code) {
         if ($result != TRUE)
            ErrorBox::getInstance()->getException($code);
         if (!$this->init)
             ErrorBox::getInstance()->getException(11);
        
    }
}
