<?php

require_once 'BaseArchiver.php';

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
class GzArchiver extends BaseArchiver {
    

    protected function getCompressClassName() {
        return 'PharData';
    }

    public function doOpen($filename) {
            if (file_exists($filename))
                unlink ($filename);
            if (file_exists($filename.'.gz'))
                unlink ($filename.'.gz');
            
            $classname = $this->getCompressClassName();                   
            $this->arc = new $classname($filename);
            
            return TRUE;

    }
    
    public function doAddFile($realfile, $localpath) {
            $this->arc->addFile($realfile, $localpath);
            return TRUE;
    }
    
    public function doClose() {
      $this->arc->compress(Phar::GZ);
      return TRUE;
    }
 
    
}
