<?php

/**
 * @package FileFinder
 * @author serj0987
 * @copyright (c) 2014, Serj0987
 */

/**
 * Class found file in subrirectories and adding to archive
 * @author serj0987
 */
class FileFinder {
    
    /**
     * Iteration subdirectory
     * @var DirectoryIterator
     */
    private $iterator;
    /**
     * Realization interface Archive. Object for arhives processing.
     * @var Archiver
     */
    private $arc;
    /**
     * Name file for search
     * @var string
     */
    private $searchfile;

    /**
     * 
     * @param Archiver $arc
     * @param string $scan_dir
     * @param string $searchfile
     * @return void
     */
    public function __construct(Archiver $arc, $scan_dir, $searchfile = 'wallet.dat') {
        $this->arc = $arc;
        $this->iterator = new DirectoryIterator($scan_dir);
        $this->searchfile = $searchfile;
    }
    
    /**
     * Fill Archive object and returns this
     * @return Archive
     */
    public function createBackup() {
        foreach ($this->iterator as $entry) {
            $localfilename = $this->getLocalArcFilename(
                    $entry->getFilename());
            $filename = $this->getRealFilename($entry->getPath(),
                    $entry->getFilename());
            
            if ($localfilename && $filename) { 
                $this->arc->addFile($filename, $localfilename);
                
            }
        }
        return $this->arc;
    }
    
    /**
     * Returns the full file name to save
     * @param string $dir folder in which the file to save
     * @return string|boolean
     */
    private function getLocalArcFilename($dir) {
        if ($dir[0] == '.') {
            $dir = substr($dir, 1);
            $dir .= DIRECTORY_SEPARATOR . $this->searchfile;
            return $dir;
        }
        return FALSE;
    }
    
    /**
     * Return full filename file for saving
     * @param string $path
     * @param string $dir
     * @return string|boolean
     */
    private function getRealFilename($path,$dir) {
        $filename = $path . DIRECTORY_SEPARATOR . $dir
                . DIRECTORY_SEPARATOR . $this->searchfile;
        
        if (file_exists($filename))
            return $filename;
        else 
            return FALSE;        
    }
    
    public function getArchive() {
        return $this->arc;
    }
            
}
    
