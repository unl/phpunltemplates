<?php

interface UNL_Templates_Version
{ 
    function getConfig();
    function getTemplate($template);
    function makeIncludeReplacements($html);
}
?>