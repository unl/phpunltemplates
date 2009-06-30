<?php

require_once 'UNL/Templates/Version.php';

class UNL_Templates_Version3 implements UNL_Templates_Version
{ 
    function getConfig()
    {
        return array('class_location' => 'UNL/Templates/Version3/',
                     'class_prefix'   => 'UNL_Templates_Version3_');
    }
}
