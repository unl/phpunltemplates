<?php

require_once 'UNL/Templates/Version.php';

class UNL_Templates_Version3 implements UNL_Templates_Version
{ 
    function getConfig()
    {
        return array('class_location' => 'UNL/Templates/Version3/',
                     'class_prefix'   => 'UNL_Templates_Version3_');
    }
    
    function getTemplate($template)
    {
        return file_get_contents('http://pear.unl.edu/UNL/Templates/server.php?version=3&template='.$template);
    }
    
    function makeIncludeReplacements($html)
    {
        UNL_Templates::debug('Now making template include replacements.',
                     'makeIncludeReplacements', 3);
        $includes = array();
        preg_match_all('<!--#include virtual="(/wdn/templates_3.0/[A-Za-z0-9\.\/]+)" -->',
                        $html, $includes);
        UNL_Templates::debug(print_r($includes, true), 'makeIncludeReplacements', 3);
        foreach ($includes[1] as $include) {
            UNL_Templates::debug('Replacing '.$include, 'makeIncludeReplacements', 3);
            $file = UNL_Templates::$options['templatedependentspath'].$include;
            if (file_exists($file)) {
                $html = str_replace('<!--#include virtual="'.$include.'" -->',
                                 file_get_contents($file), $html);
            } else {
                UNL_Templates::debug('File does not exist:'.$file,
                             'makeIncludeReplacements', 3);
            }
        }
        return $html;
    }
}
