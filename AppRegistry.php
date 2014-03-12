<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AppRegistry
 *
 * @author serj0987
 */
class AppRegistry {
    const SCAN_DIR_PARAM = 'scan';
    private $scan_dir, $output_file;
    
    public function __construct() {
        init($argv);
    }
    
    private function init($a) {
        foreach ($a as $value) {
            $pair = explode($value);
            if ($pair[0]==SCAN_DIR_PARAM) {
                if (isset($pair[1]) && (!empty($pair[1])))
                    $scan_dir = $pair[1];
                else 
                    throw new Exception("Empty scan directory param");
                
            }
            
         }
         if (!is_dir($scan_dir))
             throw new Exception("$scan_dir - is not directory");
         $this->scan_dir = $scan_dir;
    }
    
    private function generateOutputFilename($path)
    {
        if (!is_dir($path))
             throw new Exception("$path - is not directory");
        
        $filename = 
        
        if (!file_exists($path))
        {
            
        } else {
            throw new Exception("output file");
        }
    }
}
