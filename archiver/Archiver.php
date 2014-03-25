<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Archiver
 *
 * @author serj0987
 */
interface Archiver {
public function open($filename);
public function addFile($realfile,$localpath);
public function close();
}
