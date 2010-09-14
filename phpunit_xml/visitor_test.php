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
    }


}

?>
