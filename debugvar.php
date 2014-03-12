<?php

function debugvar() {
    $args = func_get_args();

    $die = false;
    $show = true;
    $bool = 0;

    $vars = array();

    foreach($args as $arg) {
        if(is_bool($arg)) {
            if($bool == 0) $die = $arg;
            else if($bool == 1) $show = $arg;
            else $vars[] = $arg;
            $bool++;
        } else {
            $vars[] = $arg;
        }
    }

    if ($show) echo '<pre>';
    else echo '<!--';

    $bt = debug_backtrace();
    echo 'Called from <b>'.$bt[0]['file'].'</b> line <b>'.$bt[0]['line'].'</b>'.'<br />';

    foreach($vars as $var) print_r($var);

    if ($show) echo '</pre>';
    else echo '-->';

    if ($die) die();
}

?>