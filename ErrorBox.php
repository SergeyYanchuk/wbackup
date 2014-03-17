<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ErrorBox
 *
 * @author serj0987
 */
class ErrorBox {
    
    static private $inst;
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
    
    private function __construct() {
        ;
    }
    
    static public function getInstance() {
        if (empty(self::$inst))
            self::$inst = new ErrorBox();
        return self::$inst;
            
    }

    public function getException($code) {
        
        if (!isset(self::$errors[$code])) 
            $code = 1;

            $exception = self::$errors[$code]['exception_class'];
            $message = self::$errors[$code]['message'];
                    
            throw new $exception($message,$code);
        
    }


    
    
    


}

