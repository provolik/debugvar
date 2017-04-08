<?php
require('debugvar.php');
debugmode();
$a = 1;
$b = 'ciao';
$c = true;
$d = array($a * 2, '23', $c);

debugvar_die();
debugvar($d);
debugvar_hide($d);
debugvar_die($a, $b, $c);

