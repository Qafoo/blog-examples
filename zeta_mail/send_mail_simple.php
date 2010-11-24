<?php

if ( !isset( $argv[1] ) )
{
    die( "Missing image file to send.\n" );
}

if ( ( $imagePath = realpath( $argv[1] ) ) === false )
{
    die( "Image file '{$argv[1]}' not found.\n" );
}

require_once '/home/dotxp/dev/ez/ezcomponents//trunk/Base/src/ezc_bootstrap.php';

$mail = new ezcMail();

$mail->from = new ezcMailAddress(
    'somebody@example.com',
    'Some Body'
);
$mail->addTo(
    new ezcMailAddress(
        'anybody@example.com',
        'Any Body'
    )
);
$mail->subject = 'A pic from Some Body';

$textPart = new ezcMailText(
    'This email contains HTML content. Please enable viewing HTML to fully enjoy it.'
);


$htmlPart = new ezcMailText(
    '<html><h1>Some Body wants you to see this image</h1><img src="cid:included_image"/></html>'
);
$htmlPart->subType = 'html';

$imagePart = new ezcMailFile( $imagePath );
$imagePart->contentId = 'included_image';

$mail->body = new ezcMailMultipartAlternative(
    $textPart,
    new ezcMailMultipartRelated(
        $htmlPart,
        $imagePart
    )
);

$transport = new ezcMailMtaTransport();

$transport->send( $mail );

?>
