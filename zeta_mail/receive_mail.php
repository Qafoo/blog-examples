<?php

require_once '/home/dotxp/dev/PHP/zetacomponents/trunk/Base/src/ezc_bootstrap.php';

require_once 'blog_entry.php';
require_once 'blog_entry_creator.php';

$imapOptions = new ezcMailImapTransportOptions();
$imapOptions->ssl = true;

$imap = new ezcMailImapTransport(
    'example.com',
    993,
    $imapOptions
);

$imap->authenticate( 'somebody@example.com', 'foo23bar' );

$imap->selectMailbox( 'Inbox' );

$messageSet = $imap->fetchAll();

$parser = new ezcMailParser();

$mails = $parser->parseMail( $messageSet );

$blogEntryCreator = new qaBlogEntryCreator();

foreach ( $mails as $mail )
{
    $entry = $blogEntryCreator->createEntry( $mail );
    $entry->save();
}

?>
