<?php
/**
 * @package Archiver
 * @author serj0987
 * @copyright (c) 2014, Serj0987
 */

/**
 * Describes the public methods of any class of the archiver
 * @author serj0987
 */
interface Archiver {
public function open($filename);
public function addFile($realfile,$localpath);
public function close();
}
