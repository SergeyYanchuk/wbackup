<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'Exceptions.php';
require_once 'ErrorBox.php';

/**
 * Description of AppRegistry
 *
 * @author serj0987
 */
class AppRegistry {
    const SCAN_DIR_PARAM = 'scan';
    const FORMAT_PARAM = 'format';
    const OUTPUT_FILENAME_PREFFIX = 'wallets_backup';
    private $supported_formats = array('gz'=>'tar.gz');
    private $scan_dir, $output_file, $format = 'gz';
    
    public function __construct($scan_dir = null, $format = null) {
        
        $options = getopt(self::SCAN_DIR_PARAM.":".self::FORMAT_PARAM);
        if ($scan_dir !== null)
            $options[self::SCAN_DIR_PARAM] = $scan_dir;
        
        if ($format !== null)
            $options[self::FORMAT_PARAM] = $format;
            
        $this->init($options);
    }
    
    private function init($a) {
        if (isset($a[self::SCAN_DIR_PARAM]))
            $scan_dir =   $a[self::SCAN_DIR_PARAM];
        else
            ErrorBox::getInstance ()->getException(2);
        
       
        $scan_dir = rtrim($scan_dir, "/\\");
        
        if (strlen($scan_dir)>0)
            if ($scan_dir[0] == '~') {
              $part = substr($scan_dir,1);
              $scan_dir = $this->getHomeDir();
                if (strlen($part)>1)
                    $scan_dir .= $part;
        }
           
        if (!is_dir($scan_dir))
             ErrorBox::getInstance ()->getException(3);
        $this->scan_dir = realpath($scan_dir);
        $this->format = $this->validateFormat($a[self::FORMAT_PARAM]);
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
             ErrorBox::getInstance ()->getException(4);
        
        date_default_timezone_set("UTC");
        $date = new DateTime("now");
        
        $filename = $path . DIRECTORY_SEPARATOR . self::OUTPUT_FILENAME_PREFFIX .
                "_" . $date->format('Y_m_d_H_i_s').'.'.$this->getExtension();
               
        if (file_exists($filename))
            ErrorBox::getInstance ()->getException(5);      
        
        return $filename;
    }
    
    private function getExtension() {
    
        return $this->supported_formats[$this->format];
    }
    
    private function validateFormat($format) {
        if (array_key_exists($format, $this->supported_formats)) {
            return $format;
        }
        else 
            ErrorBox::getInstance()->getException(6); 
    }

    public function getScanDir() {
        return $this->scan_dir;
    }
    
    public function getOutputFilename() {
        return $this->output_file;
    }
    
     public function getFormat() {
        return $this->output_file;
    }
}
