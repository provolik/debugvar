<?php

function debugvar()
{
    $vars = func_get_args();

    $d = debugvar_get_delimiters();

    $backtrace = debug_backtrace();
    if (defined('DEBUGVAR_INDIRECT_CALL')) {
        $backtrace = $backtrace[2];
    } else {
        $backtrace = $backtrace[0];
    }

    debugvar_print_open($d);
    debugvar_print_backtrace_string($backtrace, $d);
    debugvar_print_variables($vars, $d);
    debugvar_print_close($d);
}

function debugvar_die()
{
    // tell debugvar() to use the original backtrace
    define('DEBUGVAR_INDIRECT_CALL', true);

    $vars = func_get_args();

    call_user_func_array('debugvar', $vars);
    die();
}

function debugvar_hide()
{
    // tell debugvar() to use the original backtrace
    define('DEBUGVAR_INDIRECT_CALL', true);

    // tell debugvar_get_delimiters() we want comments
    define('DEBUGVAR_USE_COMMENT_DELIMITERS', true);

    $vars = func_get_args();

    call_user_func_array('debugvar', $vars);
    die();
}

function debugvar_get_delimiters()
{
    if (php_sapi_name() === 'cli') {
        // we don't mind about comments if we are in the CLI SAPI
        return array(
            'open'          => '',
            'close'         => '',
            'br'            => "\r\n",
            'strong_start'  => '',
            'strong_end'    => '',
        );
    }

    $show_as_comment = false;
    if (defined('DEBUGVAR_USE_COMMENT_DELIMITERS')) {
        $show_as_comment = true;
    }

    $delimiters = array(
        'open'          => '<pre>',
        'close'         => '</pre>',
        'br'            => '<br />',
        'strong_start'  => '<strong>',
        'strong_end'    => '</strong>',
    );

    if ($show_as_comment) {
        // we want to show the
        $delimiters = array(
            'open'          => '<!--',
            'close'         => '-->',
            'br'            => "\r\n",
            'strong_start'  => '',
            'strong_end'    => '',
        );
    }

    return $delimiters;
}

function debugvar_print_open($delimiters)
{
    echo $delimiters['open'];
}

function debugvar_print_close($delimiters)
{
    echo $delimiters['close'];
}

function debugvar_print_variables($vars, $delimiters)
{
    $i = 1;
    foreach ($vars as $k => $var) {
        if (count($vars) > 1) {
            echo "Variable {$i}:" . $delimiters['br'];
        }

        print_r($var);

        echo $delimiters['br'] . $delimiters['br'];
        $i++;
    }
}

function debugvar_print_backtrace_string($backtrace, $d)
{
    $b = sprintf(
        'debugvar() called from %s line %s %s',
        $d['strong_start'] . $backtrace['file'] . $d['strong_end'],
        $d['strong_start'] . $backtrace['line'] . $d['strong_end'],
        $d['br'] . $d['br']
    );
    echo $b;
}
