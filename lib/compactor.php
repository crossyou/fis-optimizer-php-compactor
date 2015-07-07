#!/usr/bin/env php
<?php
/**
 * Compact PHP code.
 * Strip comments, combine entire library into one file.
 *
 * @example 
 * php compactor test.php test_min.php
 * 
 * Copyright (c) 2015 sobird
 * Licensed under the MIT license.
 * https://github.com/crossyou/php/blob/master/LICENSE
 * @author  Yang,junlong at 2015-07-02 11:45:15 build.
 * @version $Id$
 */

$source = $argv[1]; 

if (function_exists( 'date_default_timezone_set' )){
    date_default_timezone_set('Asia/Shanghai');
}

$out = array();
array_push($out, '<?php' . PHP_EOL);
array_push($out, '/**' . PHP_EOL);
array_push($out, ' * Compactor' . PHP_EOL);
array_push($out, ' * ' . PHP_EOL);
array_push($out, ' * Copyright (c) 2015 sobird' . PHP_EOL);
array_push($out, ' * Licensed under the MIT license.' . PHP_EOL);
array_push($out, ' * https://github.com/crossyou/php/blob/master/LICENSE' . PHP_EOL);
array_push($out, ' * @author  Compactor at '.date("Y-m-d H:i:s").' build.' . PHP_EOL);
array_push($out, ' */' . PHP_EOL);

$contents = file_get_contents($source);
foreach (token_get_all($contents) as $token) {
    if (is_string($token)) {
        array_push($out, $token);
    } else {
        switch ($token[0]) {
            case T_REQUIRE:
            case T_REQUIRE_ONCE:
            case T_INCLUDE_ONCE:
            // We leave T_INCLUDE since it is rarely used to include
            // libraries and often used to include HTML/template files.
            case T_COMMENT:
            case T_DOC_COMMENT:
            case T_OPEN_TAG:
            case T_CLOSE_TAG:
            break;
            case T_WHITESPACE:
                array_push($out, ' ');
                break;
            default:
                array_push($out, $token[1]);
        }
    } 
}

echo implode('', $out);
