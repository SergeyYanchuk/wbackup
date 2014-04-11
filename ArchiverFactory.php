<?php
/**
 * @package ArchiverFactory
 * @author serj0987
 * @copyright (c) 2014, Serj0987
 */

/**
 * Generating Archiver objects
 * @author serj0987
 */
class ArchiverFactory {
   const POSTFIX = 'Archiver';
   const ARHIVER_DIR = 'archiver';
   
   /**
    * Generating Archiver object from format string
    * @param string $format
    * @return Archive returns realization of Archiver interface
    */ 
   static public function getArchiverFromFormat($format) {
      if (strlen($format) < 2)
          ErrorBox::getInstance()->getException(12, $format);
      $format[0] = strtoupper($format[0]);
      $classname = $format . self::POSTFIX;
      
      $path = __DIR__ . DIRECTORY_SEPARATOR . 
              self::ARHIVER_DIR . DIRECTORY_SEPARATOR 
              . $classname . '.php';
      if (!file_exists($path)) 
          ErrorBox::getInstance()->getException(13, $path);
      
      require_once $path;
      
      if (!class_exists($classname)) 
          ErrorBox::getInstance()->getException(14, $classname);
      
      return new $classname();
}
}
