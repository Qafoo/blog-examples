<?php
require_once 'PHPUnit/Extensions/PhptTestCase.php';

class UploadExampleTest extends PHPUnit_Extensions_PhptTestCase
{
    public function __construct()
    {
        parent::__construct(__DIR__ . '/upload-example.phpt');
    }
}
