<?php

// PHPUnit master complains here
// require_once 'PHPUnit/Framework.php';

abstract class qaXmlTestCase extends PHPUnit_Framework_TestCase
{
    protected abstract function getDomDocument();

    protected function assertXpathMatch( $expected, $xpath, $message = null, DOMNode $context = null )
    {
        $xpathObj = new DOMXPath( $this->getDomDocument() );

        $res = null;
        if ( null === $context )
        {
            $res = $xpathObj->evaluate( $xpath );
        }
        else
        {
            $res = $xpathObj->evaluate( $xpath, $context );
        }

        $this->assertEquals(
            $expected,
            $res,
            $message
        );
    }
}

?>
