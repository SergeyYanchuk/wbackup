<?php
/**
 * @package Archiver
 * @author serj0987
 * @copyright (c) 2014, Serj0987
 */

require_once 'BaseArchiver.php';

/**
 * Packing files in Zip archive
 * @author serj0987
 */
class ZipArchiver extends BaseArchiver {
    
     /**
     * Returns name of class used for compressing
     * @return string classname
     */
    protected function getCompressClassName() {
        return 'ZipArchive';
    }
    
    /**
     * Open archive for writing
     * @param string $filename
     * @return boolean
     */
    protected function doOpen($filename) {
        $classname = $this->getCompressClassName();
        $this->arc = new $classname();
        $result = $this->arc->open($filename, ZIPARCHIVE::CREATE); 
        return $result;
    }
    
     /**
     * Add file to archive
     * @param string $realfile
     * @param string $localpath
     * @return boolean
     */
    protected function doAddFile($realfile, $localpath) {
  
            $result = $this->arc->addFile($realfile,$localpath);
        
        return $result;
    }
    
     /**
     * Compress files and save archive
     * @return boolean
     */
    protected function doClose() {
        $result = $this->arc->close();
        return $result;      
    }

}
