<?php

class qaBlogEntry
{
    protected $subject;

    protected $content;

    protected $images = array();

    public function setSubject( $subject )
    {
        $this->subject = $subject;
    }

    public function setContent ( $content )
    {
        $this->content = $content;
    }

    public function addImage( $cid, $path )
    {
        $this->images[$cid] = $path;
    }

    public function save()
    {
        var_dump( $this );
        // ...
    }
}

?>
