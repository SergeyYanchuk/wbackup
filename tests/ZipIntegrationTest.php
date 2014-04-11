<?php

require_once 'integrationTest.php';

/**
 * Description of ZipIntegrationTest
 *
 * @author serj0987
 */
class ZipIntegrationTest extends IntegrationTest {
   
    protected function getScanDir() {
        return '/home/serj0987';
    }
    
    protected function getFormat() {
        return 'zip';
    }
}
