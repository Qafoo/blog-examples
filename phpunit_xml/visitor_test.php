<?php

class qaVisitorTest extends qaXmlTestCase
{
    protected $domDocument;

    protected $rootElement;

    protected function setUp()
    {
        $this->domDocument = new DOMDocument( '1.0', 'utf-8' );
        $this->rootElement = $this->domDocument->appendChild(
            $this->domDocument->createElement(
                'root'
            )
        );
    }

    protected function getDomDocument()
    {
        return $this->domDocument;
    }

    protected function getPersonFixture()
    {
        $person = new qaPerson(
            'My Last Name',
            'Some First Name'
        );
        $person->setGender( qaPerson::GENDER_FEMALE );
        $person->setDateOfBirth(
            new DateTime( '2000-01-01 00:00:00+00:00' )
        );

        return $person;
    }

    public function testVisitPersonNaive()
    {
        $person = $this->getPersonFixture();

        $expDom = new DOMDocument( '1.0', 'utf-8' );
        $expRoot = $expDom->appendChild(
            $expDom->createElement( 'root' )
        );
        $expPersonElem = $expRoot->appendChild(
            $expDom->createElement( 'Person' )
        );
        $expPersonElem->appendChild(
            $expDom->createElement(
                'LastName',
                $person->getLastName()
            )
        );
        $expPersonElem->appendChild(
            $expDom->createElement(
                'FirstName',
                $person->getFirstName()
            )
        );
        $expPersonElem->appendChild(
            $expDom->createElement(
                'Gender',
                $person->getGender()
            )
        );
        $expPersonElem->appendChild(
            $expDom->createElement(
                'DateOfBirth',
                $person->getDateOfBirth()->format( 'Y-m-d' )
            )
        );

        $visitor = new qaPersonVisitor( $this->rootElement );
        $visitor->visitPerson( $person );

        $this->assertEquals(
            $expDom,
            $this->getDomDocument()
        );
    }

    public function testVisitPersonSelectCSS()
    {
        $person = $this->getPersonFixture();

        $visitor = new qaPersonVisitor( $this->rootElement );
        $visitor->visitPerson( $person );

        $this->assertSelectCount(
            'Person',
            1,
            $this->getDomDocument(),
            'Invalid number of Person elements',
            false
        );

        // Broken CSS parser
        $this->assertSelectEquals(
            'FirstName',
            $person->getFirstName(),
            1,
            $this->getDomDocument(),
            'Invalid content of FirstName element',
            false
        );
        $this->assertSelectEquals(
            'LastName',
            $person->getLastName(),
            1,
            $this->getDomDocument(),
            'Invalid content of LastName element',
            false
        );
        $this->assertSelectEquals(
            'Gender',
            $person->getGender(),
            1,
            $this->getDomDocument(),
            'Invalid content of Gender element',
            false
        );
        $this->assertSelectEquals(
            'DateOfBirth',
            $person->getDateOfBirth()->format( 'Y-m-d' ),
            1,
            $this->getDomDocument(),
            'Invalid content of DateOfBirth element',
            false
        );
    }

    public function testVisitPersonTag()
    {
        $person = $this->getPersonFixture();

        $visitor = new qaPersonVisitor( $this->rootElement );
        $visitor->visitPerson( $person );
        
        $this->assertTag(
            array(
                'tag' => 'Person',
                'child' => array(
                    'tag'     => 'LastName',
                    'content' => $person->getLastName(),
                ),
            ),
            $this->getDomDocument(),
            'Incorrect LastName tag',
            false
        );
        
        $this->assertTag(
            array(
                'tag' => 'Person',
                'child' => array(
                    'tag'     => 'FirstName',
                    'content' => $person->getFirstName(),
                ),
            ),
            $this->getDomDocument(),
            'Incorrect FirstName tag',
            false
        );
        
        $this->assertTag(
            array(
                'tag' => 'Person',
                'child' => array(
                    'tag'     => 'Gender',
                    'content' => (string) $person->getGender(),
                ),
            ),
            $this->getDomDocument(),
            'Incorrect Gender tag',
            false
        );
        
        $this->assertTag(
            array(
                'tag' => 'Person',
                'child' => array(
                    'tag'     => 'DateOfBirth',
                    'content' => $person->getDateOfBirth()->format( 'Y-m-d' ),
                ),
            ),
            $this->getDomDocument(),
            'Incorrect DateOfBirth tag',
            false
        );
    }

}

?>
