<?php
/**
 * @package Archiver
 * @author serj0987
 * @copyright (c) 2014, Serj0987
 */

require_once 'BaseArchiver.php';

/**
 * Packing files in GnuZip archive
 * @author serj0987
 */
class GzArchiver extends BaseArchiver {
    
    /**
     * Returns name of class used for compressing
     * @return string classname
     */
    protected function getCompressClassName() {
        return 'PharData';
    }

    /**
     * Open archive for writing
     * @param string $filename
     * @return boolean
     */
    public function doOpen($filename) {
            $tar_filename = substr($filename, 0,strrpos($filename,'.'));
            
            if (file_exists($tar_filename))
                unlink ($tar_filename);
            
            if (file_exists($filename))
                unlink ($filename);
            
            $classname = $this->getCompressClassName();                   
            $this->arc = new $classname($tar_filename);
            
            return TRUE;

    }
    
    /**
     * Add file to archive
     * @param string $realfile
     * @param string $localpath
     * @return boolean
     */
    public function doAddFile($realfile, $localpath) {
            $this->arc->addFile($realfile, $localpath);
            return TRUE;
    }
    
     /**
      * Compress files and save archive
      * @return boolean
      */
     public function doClose() {
        $this->arc->compress(Phar::GZ);
        return TRUE;
    }
 
    
}
