<?php
require('debugvar.php');

$a = 1;
$b = 'ciao';
$c = true;
$d = array($a * 2, '23', $c);

debugvar($a, $b, $c);
debugvar_hide($d);
