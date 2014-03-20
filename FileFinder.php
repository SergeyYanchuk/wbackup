<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FileFinder
 *
 * @author serj0987
 */
class FileFinder {
    
    private $iterator;
    private $arc;
    private $searchfile;


    public function __construct($arc, $scan_dir, $searchfile = 'wallet.dat') {
        $this->arc = $arc;
        $this->iterator = new DirectoryIterator($scan_dir);
        //$this->iterator = new RegexIterator($this->iterator,'/(\w)*('.$searchfile.')+/');
        $this->searchfile = $searchfile;
    }
    
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
    }
    
    private function getLocalArcFilename($dir) {
        if ($dir[0] == '.') {
            $dir = substr($dir, 1);
            $dir .= DIRECTORY_SEPARATOR . $this->searchfile;
            return $dir;
        }
        return FALSE;
    }
    
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
    
