<?php


require_once 'Archiver.php';
require_once '../ErrorBox.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GzArchiver
 *
 * @author serj0987
 */
class GzArchiver implements Archiver {
    
    private $arc;
    private $init = FALSE;


    public function __construct() {
        if (!class_exists('PharData'))
            ErrorBox::getInstance()->getException(7);
            
    }

    public function open($filename) {
        try {
            if (file_exists($filename))
                unlink ($filename);
            if (file_exists($filename.'.gz'))
                unlink ($filename.'.gz');
                    
            $this->arc = new PharData($filename);
        } catch (Exception $ex) {
          ErrorBox::getInstance()->getException(8);
        }
        $this->init = TRUE;
    }
    
    public function addFile($realfile, $localpath) {
        try {
            $this->arc->addFile($realfile, $localpath);
        } catch (Exception $ex) {
          ErrorBox::getInstance()->getException(9);
        }
    }
    
    public function close() {
      try {
      $this->arc->compress(Phar::GZ);
       } catch (Exception $ex) {
       ErrorBox::getInstance()->getException(10);
      }
    }
 
    
}
