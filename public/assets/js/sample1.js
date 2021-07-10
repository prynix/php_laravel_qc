/*!
 * jQuery FormHelp Plugin Sample
 * https://github.com/invetek/jquery-formhelp
 *
 * Copyright 2013 Loran Kloeze - Invetek
 * Released under the MIT license
 */

$(document).ready(function() {
    //Normal operation
    $.formHelp({pushpinEnabled: true});

    //Operation with a class prefix
    $.formHelp(
            {classPrefix: 'myprefix', pushpinEnabled: false}
    );
});