<?php

class qaXmlVisitor
{
    protected $document;

    protected $root;

    protected $currentElement;

    public function __construct( DOMElement $root )
    {
        $this->root           = $root;
        $this->currentElement = $root;
        $this->document       = $root->ownerDocument;
    }

    public function visitPerson( qaPerson $person )
    {
        $this->currentElement = $this->currentElement->appendChild(
            $this->document->createElement( 'Person' )
        );

        $this->currentElement->appendChild(
            $this->document->createElement(
                'LastName',
                $person->getLastName()
            )
        );
        $this->currentElement->appendChild(
            $this->document->createElement(
                'FirstName',
                $person->getFirstName()
            )
        );

        if ( null !== ( $iGender = $person->getGender() ) )
        {
            $this->currentElement->appendChild(
                $this->document->createElement(
                    'Gender', $iGender
                )
            );
        }
        if ( null !== ( $oDateOfBirth = $person->getDateOfBirth() ) )
        {
            $this->currentElement->appendChild(
                $this->document->createElement(
                    'DateOfBirth', $oDateOfBirth->format( 'Y-m-d' )
                )
            );
        }
    }
}

?>
