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
    const OUTPUT_FILENAME_PREFFIX = 'wallets_backup';
    private $scan_dir, $output_file;
    
    public function __construct($scan_dir = null) {
        
        $options = getopt(self::SCAN_DIR_PARAM);
        if ($scan_dir !== null)
            $options[self::SCAN_DIR_PARAM] = $scan_dir;
            
        $this->init($options);
    }
    
    private function init($a) {
        if (isset($a[self::SCAN_DIR_PARAM]))
            $scan_dir =   $a[self::SCAN_DIR_PARAM];
        else 
            throw new Exception("Not set scan directory");
        
       // $scan_dir = realpath($scan_dir);
        $scan_dir = rtrim($scan_dir, "/\\");
        
        if ($scan_dir == "~") 
           $scan_dir = $this->getHomeDir();
            
           
        if (!is_dir($scan_dir))
             throw new Exception("$scan_dir - is not directory");
        $this->scan_dir = $scan_dir;
        $this->output_file = $this->generateOutputFilename($scan_dir);
    }
    
    private function getHomeDir() {
         if (isset($_SERVER['HOMEDRIVE'])) 
            return $_SERVER['HOMEDRIVE'].$_SERVER['HOMEPATH'];
        else 
            return $_SERVER['HOME'];    
    }
    
    private function generateOutputFilename($path)
    {
        if (!is_dir($path))
             throw new Exception("$path - is not directory");
        
        date_default_timezone_set("UTC");
        $date = new DateTime("now");
        
        $filename = $path . DIRECTORY_SEPARATOR . self::OUTPUT_FILENAME_PREFFIX .
                "_" . $date->format('Y_m_d_H_i_sP');
               
        if (file_exists($filename))
            throw new Exception("Output file already exists");      
        
        return $filename;
    }
    
    public function getScanDir() {
        return $this->scan_dir;
    }
    
    public function getOutputFilename() {
        return $this->output_file;
    }
}
