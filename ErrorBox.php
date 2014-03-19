<?php
/**
 * @package ErrorBox
 * @author serj0987
 * @copyright (c) 2014, Serj0987
 */

/**
 * Class for error processing and generating exceptions. Singleton
 * @author serj0987
 */
class ErrorBox {
    
    /**
     * @var ErrorBox
     */
    static private $inst;
    /**
     * Associative array [errorcode][message] or [exception_class]
     * @var array of strings
     */
    static private $errors = array(
        0 => array(
            'message' => 'Unknown error', 
            'exception_class' => 'Exception'),
        1 => array(
            'message' => 'Not valid error code', 
            'exception_class' => 'Exception'),
        2 => array(
            'message' => 'Not set scan directory',
            'exception_class' => 'AppRegistryException'),
        3 => array(
            'message' => 'Wrong scan dir path',
            'exception_class' => 'AppRegistryException'),
        4 => array(
            'message' => 'Wrong dir path(generating output filename)', 
            'exception_class' => 'AppRegistryException'),
        5 => array(
            'message' => 'Output file already exists', 
            'exception_class' => 'AppRegistryException'),
        6 => array(
            'message' => 'Unknown output format', 
            'exception_class' => 'AppRegistryException'),
        
        );
    
    /**
     * Private constructor for singleton realization
     * @return void
     */
    private function __construct() {
        ;
    }
    
    /**
     * Static function return this instance
     * @return ErrorBox
     */
    static public function getInstance() {
        if (empty(self::$inst))
            self::$inst = new ErrorBox();
        return self::$inst;
            
    }
    
    
    /**
     * 
     * @param int $code
     * @throws type from self::$errors
     */
    public function getException($code) {
        
        if (!isset(self::$errors[$code])) 
            $code = 1;

            $exception = self::$errors[$code]['exception_class'];
            $message = self::$errors[$code]['message'];
                    
            throw new $exception($message,$code);
        
    }
}

