<?php

require_once 'BaseArchiver.php';

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
class ZipArchiver extends BaseArchiver {
    
    protected function getCompressClassName() {
        return 'ZipArchive';
    }

    protected function doOpen($filename) {
        $classname = $this->getCompressClassName();
        $this->arc = new $classname();
        $result = $this->arc->open($filename, ZIPARCHIVE::CREATE); 
        return $result;
    }
    
    protected function doAddFile($realfile, $localpath) {
        $result = $this->arc->addFile($realfile,$localpath);
        return $result;
    }
    
    protected function doClose() {
        $result = $this->arc->close();
        return $result;      
    }

}
