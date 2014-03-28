<?php

require_once 'GzArchiver.php';

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
class BzArchiver extends GzArchiver {
    
    public function doOpen($filename) {
            if (file_exists($filename))
                unlink ($filename);
            if (file_exists($filename.'.bz'))
                unlink ($filename.'.bz');
            
            $classname = $this->getCompressClassName();                   
            $this->arc = new $classname($filename);
            
            return TRUE;

    }
     
    public function doClose() {
      $this->arc->compress(Phar::BZ2);
      return TRUE;
    }
 
    
}
