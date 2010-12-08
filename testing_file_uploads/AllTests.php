<?php

require_once __DIR__ . '/UploadExampleTest.php';
require_once __DIR__ . '/UploadExampleTestSuite.php';

class AllTests extends PHPUnit_Framework_TestSuite
{
    public function __construct()
    {
        $this->addTest(new UploadExampleTest());
        $this->addTest(new UploadExampleTestSuite());
    }

    public static function suite()
    {
        return new AllTests();
    }
}
