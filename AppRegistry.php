<?php
/**
 * @package AppRegistry
 * @author serj0987
 * @copyright (c) 2014, Serj0987
 */

require_once 'Exceptions.php';
require_once 'ErrorBox.php';

/**
 * This class receives, processes and stores the command line arguments
 */
class AppRegistry {
    const SCAN_DIR_PARAM = 'scan';
    const FORMAT_PARAM = 'format';
    const OUTPUT_FILENAME_PREFFIX = 'wallets_backup';
    /**
     * Associative array format parameter value => output file extension
     * @var array of string 
     */
    private $supported_formats = array('zip'=>'.zip','gz'=>'.tar.gz', 
        'bz' => '.tar.bz2');
    /**
     * Store path to direcrory for scanning 
     * @var string
     */
    private $scan_dir;
    /**
     * Store output filename
     * @var string 
     */
    private $output_file;
    /**
     * Store format output file, default = 'zip'
     * @var type string
     */
    private $format = 'zip';
    
    /**
     * If parameter not set using command line arguments
     * @param string $scan_dir
     * @param string $format
     * @return void
     */
    public function __construct($scan_dir = NULL, $format = NULL) {
        
        $opt_names = array(
            self::SCAN_DIR_PARAM.":",
            self::FORMAT_PARAM.":"
        );
        $options = getopt(null,$opt_names);
        //var_dump($options);
        if ($scan_dir !== NULL)
            $options[self::SCAN_DIR_PARAM] = $scan_dir;
        
        if ($format !== NULL)
            $options[self::FORMAT_PARAM] = $format;
            
        $this->init($options);
    }
    
    /**
     * Processes array of option. Validate options and write values to fields
     * @param array of string
     * @return void
     */
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
    
    /**
     * Return this user home directory
     * @return string
     */
    private function getHomeDir() {
         if (isset($_SERVER['HOMEDRIVE'])) 
            return $_SERVER['HOMEDRIVE'].$_SERVER['HOMEPATH'];
        else 
            return $_SERVER['HOME'];    
    }
    
    /**
     * Generate full filename for output file. Used path to output dir, called 
     * AppRegistry::getExtension(); 
     * @param string $path
     * @return string
     */
    private function generateOutputFilename($path)
    {
        if (!is_dir($path))
             ErrorBox::getInstance ()->getException(4);
        
        date_default_timezone_set("UTC");
        $date = new DateTime("now");
        
        $filename = $path . DIRECTORY_SEPARATOR . self::OUTPUT_FILENAME_PREFFIX .
                "_" . $date->format('Y_m_d_H_i_s').$this->getExtension();
               
        if (file_exists($filename))
            ErrorBox::getInstance ()->getException(5);      
        
        return $filename;
    }
    
    /**
     * Return extension for output file
     * @return string 
     */
    private function getExtension() {
    
        return $this->supported_formats[$this->format];
    }
    
    /**
     * Return valid format or generate exception
     * @param string $format
     * @return string
     */
    private function validateFormat($format) {
        if (array_key_exists($format, $this->supported_formats)) {
            return $format;
        }
        else 
            ErrorBox::getInstance()->getException(6); 
    }
    
    /**
     * Return directory for scanning
     * @return string
     */

    public function getScanDir() {
        return $this->scan_dir;
    }
    
    
    /**
     * Return output filename
     * @return string
     */
    public function getOutputFilename() {
        return $this->output_file;
    }
    
    /**
     * Return format output file
     * @return string
     */
     public function getFormat() {
        return $this->format;
    }
}
