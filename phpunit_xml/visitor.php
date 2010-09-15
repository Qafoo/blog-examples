<?php

require_once dirname( __FILE__ ) . '/person.php';

class qaPersonVisitor
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

        if ( null !== ( $gender = $person->getGender() ) )
        {
            $this->currentElement->appendChild(
                $this->document->createElement(
                    'Gender', $gender
                )
            );
        }
        if ( null !== ( $dateOfBirth = $person->getDateOfBirth() ) )
        {
            $this->currentElement->appendChild(
                $this->document->createElement(
                    'DateOfBirth', $dateOfBirth->format( 'Y-m-d' )
                )
            );
        }
    }
}

?>
