<?php

class qaBlogEntryCreator
{
    protected $entry;

    public function createEntry( ezcMail $mail )
    {
        $this->entry = new qaBlogEntry();
        $this->entry->setSubject( $mail->subject );

        $walkContext = new ezcMailPartWalkContext(
            array( $this, 'walkPart' )
        );
        $walkContext->filter = array( 'ezcMailText', 'ezcMailFile' );
        $mail->walkParts( $walkContext, $mail );

        return $this->entry;
    }

    public function walkPart( ezcMailPartWalkContext $context, ezcMailPart $part )
    {
        switch ( true )
        {
            case ( $part instanceof ezcMailFile ):
                $this->entry->addImage( $part->contentId, $part->fileName );
                break;

            case ( $part instanceof ezcMailText ):
                if ( $part->subType === 'html' )
                {
                    $this->entry->setContent( $part->text );
                }
                break;
        }
    }
}

?>
