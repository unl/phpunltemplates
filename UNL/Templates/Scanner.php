<?php
/**
 * This class will scan a template file for the regions, which you can use to 
 * analyze and use a rendered template file.
 */
require_once 'UNL/DWT/Scanner.php';


class UNL_Templates_Scanner extends UNL_DWT_Scanner
{
    /**
     * Construct a remote file.
     *
     * @param string $html Contents of the page
     */
    function __construct($html)
    {
        parent::__construct($html);
    }
}

?>