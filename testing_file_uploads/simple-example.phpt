--TEST--
Example test case
--FILE--
<?php
var_dump(strpos('Manuel Pichler', 'P'));
var_dump(strpos('Manuel Pichler', 'Z'));
--EXPECT--
int(7)
bool(false)
