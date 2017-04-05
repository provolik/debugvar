<?php

define('COMMENT_DELIMITERS_COMMAND', 'DEBUGVAR_USE_COMMENT_DELIMITERS');

function debugmode($on = true, $mode = -1) {
    ini_set('display_errors', $on);

    if ($mode == -1) {
        $mode = E_ERROR | E_PARSE | E_WARNING;
    }

    error_reporting($mode);
}

function debugvar()
{
    $vars = func_get_args();
    $d = debugvar_get_delimiters($vars);

    if ($vars[0] == COMMENT_DELIMITERS_COMMAND) {
        unset($vars[0]);
    }

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

    $vars = func_get_args();

    // tell debugvar_get_delimiters() we want comments
    array_unshift($vars, COMMENT_DELIMITERS_COMMAND);

    call_user_func_array('debugvar', $vars);
}

function debugvar_get_delimiters($vars)
{
    if (php_sapi_name() == 'cli') {
        // we don't mind about comments if we are in the CLI SAPI
        return array(
            'open'          => '',
            'close'         => '',
            'br'            => "\r\n",
            'strong_start'  => '',
            'strong_end'    => '',
        );
    }

    $delimiters = array(
        'open'          => '<pre>',
        'close'         => '</pre>',
        'br'            => '<br />',
        'strong_start'  => '<strong>',
        'strong_end'    => '</strong>',
    );

    if ($vars[0] == COMMENT_DELIMITERS_COMMAND) {
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
            echo "Variable {$i}:", $delimiters['br'];
        }

        print_r($var);

        echo $delimiters['br'], $delimiters['br'];
        ++$i;
    }
}

function debugvar_print_backtrace_string($backtrace, $d)
{
    printf(
        debug_backtrace()[1]['function'] . '() called in %s at line %s%s',
        $d['strong_start'] . $backtrace['file'] . $d['strong_end'],
        $d['strong_start'] . $backtrace['line'] . $d['strong_end'],
        $d['br'] . $d['br']
    );
}
