<?php
/**
 * Base class for Version 4 (2013) template files.
 *
 * PHP version 5
 *
 * @category  Templates
 * @package   UNL_Templates
 * @author    Brett Bieber <brett.bieber@gmail.com>
 * @author    Ned Hummel <nhummel2@unl.edu>
 * @copyright 2009 Regents of the University of Nebraska
 * @license   http://www1.unl.edu/wdn/wiki/Software_License BSD License
 * @link      http://pear.unl.edu/
 */
require_once 'UNL/Templates/Version.php';

/**
 * Base class for Version 4 (2013) template files.
 *
 * @category  Templates
 * @package   UNL_Templates
 * @author    Brett Bieber <brett.bieber@gmail.com>
 * @copyright 2009 Regents of the University of Nebraska
 * @license   http://www1.unl.edu/wdn/wiki/Software_License BSD License
 * @link      http://pear.unl.edu/
 */
class UNL_Templates_Version4 implements UNL_Templates_Version
{
    function getConfig()
    {
        return array('class_location' => 'UNL/Templates/Version4/',
                     'class_prefix'   => 'UNL_Templates_Version4_');
    }

    function getTemplate($template)
    {

        // Set a timeout for the HTTP download of the template file
        $http_context = stream_context_create(array('http' => array('timeout' => UNL_Templates::$options['timeout'])));

        // Always try and retrieve the latest
        if (!(UNL_Templates::getCachingService() instanceof UNL_Templates_CachingService_Null)
            && $tpl = file_get_contents('https://raw.github.com/unl/wdntemplates/master/Templates/'.$template, false, $http_context)) {
            return $tpl;
        }

        if ($tpl = file_get_contents('https://raw.github.com/unl/wdntemplates/master/Templates/'.$template)) {
            return $tpl;
        }


        throw new Exception('Could not get the template file!');
    }

    function makeIncludeReplacements($html)
    {
        UNL_Templates::debug('Now making template include replacements.',
                     'makeIncludeReplacements', 3);
        $includes = array();
        preg_match_all('<!--#include virtual="(/wdn/templates_4.0/[A-Za-z0-9\.\/_]+)" -->',
                        $html, $includes);
        UNL_Templates::debug(print_r($includes, true), 'makeIncludeReplacements', 3);
        foreach ($includes[1] as $include) {
            UNL_Templates::debug('Replacing '.$include, 'makeIncludeReplacements', 3);
            $file = UNL_Templates::$options['templatedependentspath'].$include;
            if (!file_exists($file)) {
                UNL_Templates::debug('File does not exist:'.$file,
                             'makeIncludeReplacements', 3);
                $file = 'https://raw.github.com/unl/wdntemplates/master'.$include;
            }
            $html = str_replace('<!--#include virtual="'.$include.'" -->',
                                 file_get_contents($file), $html);
        }
        return $html;
    }
}
