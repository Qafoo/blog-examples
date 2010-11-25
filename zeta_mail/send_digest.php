<?php

require_once '/home/dotxp/dev/PHP/zetacomponents/trunk/Base/src/ezc_bootstrap.php';


$imapOptions = new ezcMailImapTransportOptions();
$imapOptions->ssl = true;

$imap = new ezcMailImapTransport(
    'example.com',
    993,
    $imapOptions
);

$imap->authenticate( 'somebody@example.com', 'foo23bar' );
$imap->selectMailbox( 'Inbox' );

$mailSet = $imap->fetchAll();

$parser = new ezcMailParser();
$retMails = $parser->parseMail( $mailSet );

$mail = new ezcMail();
$mail->from = new ezcMailAddress( 'somebody@example.com' );
$mail->addTo(
    new ezcMailAddress( 'anybody@example.com', 'Any Body' )
);
$mail->subject = 'Daily digest';

$digest = new ezcMailMultipartDigest();
foreach ( $retMails as $retMail )
{
    $digest->appendPart( new ezcMailRfc822Digest( $retMail ) );
}
$mail->body = $digest;

$transport = new ezcMailMtaTransport();
$transport->send( $mail );

?>
