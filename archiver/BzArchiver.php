<?php
/**
 * @package Archiver
 * @author serj0987
 * @copyright (c) 2014, Serj0987
 */

require_once 'GzArchiver.php';

/**
 * Packing files in Bzip2 archive
 * @author serj0987
 */
class BzArchiver extends GzArchiver {
    
    
    /**
     * Set compressing method Phar::BZ2
     * @return boolean
     */    
    public function doClose() {
      $this->arc->compress(Phar::BZ2);
      return TRUE;
    }
 
    
}
