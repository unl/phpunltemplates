<?php

require_once __DIR__ . '/../../tests/bootstrap.php';

highlight_file(__FILE__);

$html = file_get_contents('http://www.unl.edu/');

// Scan this rendered UNL template-based page for editable regions
$scanner = new UNL\Templates\Scanner($html);

// All editable regions are now member variables of the scanner object.
echo $scanner->maincontentarea;
