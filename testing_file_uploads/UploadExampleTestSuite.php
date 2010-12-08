<?php
require_once 'PHPUnit/Extensions/PhptTestSuite.php';

class UploadExampleTestSuite extends PHPUnit_Extensions_PhptTestSuite
{
    public function __construct()
    {
        parent::__construct(__DIR__);
    }
}
