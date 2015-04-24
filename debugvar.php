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

    if($show) {
        $open = '<pre>';
        $close = '</pre>';
        $br = '<br />';
    } else {
        $open = '<!--';
        $close = '-->';
        $br = "\r\n";
    }

    echo $open;

    $bt = debug_backtrace();
    $bt_string = 'DebugVar called from <b>'.$bt[0]['file'].'</b> line <b>'.$bt[0]['line'].'</b>'.$br;

    $i = 1;
    foreach($vars as $var) {
        echo $bt_string;
        echo 'Variable ' . $i . $br;
        print_r($var);
        echo $br.$br;
        $i++;
    }

    echo $close;

    if ($die) die();

}
