/*
 * fis-optimizer-php-compactor
 *
 * Copyright (c) 2015 Sobird
 * Licensed under the MIT license.
 * https://github.com/crossyou/fis-optimizer-php-compactor/blob/master/LICENSE
 */

'use strict';

var cp = require('child_process'); 
var path = require('path');
var exec_file = __dirname + path.sep + 'lib' + path.sep + 'compactor.php'

module.exports = function(content, file, conf){
    //console.log('php -r "token_get_all(' + content + ')";');
    var result = cp.spawnSync('php', ['-f', exec_file, file.realpath]);
    var stdout = result.stdout;
    return stdout.toString();
};
