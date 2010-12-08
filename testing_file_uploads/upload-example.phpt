--TEST--
Example test emulating a file upload
--POST_RAW--
Content-Type: multipart/form-data; boundary=----WebKitFormBoundaryfywL8UCjFtqUBTQn

------WebKitFormBoundaryfywL8UCjFtqUBTQn
Content-Disposition: form-data; name="file"; filename="example.txt"
Content-Type: text/plain

Qafoo provides quality assurance support and consulting

------WebKitFormBoundaryfywL8UCjFtqUBTQn
Content-Disposition: form-data; name="submit"

Upload
------WebKitFormBoundaryfywL8UCjFtqUBTQn--
--FILE--
<?php
require __DIR__ . '/UploadExample.php';

$upload = new UploadExample('/tmp');
$upload->handle('file');

var_dump(file_exists('/tmp/example.txt'));
?>
--EXPECT--
bool(true)
