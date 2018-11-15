#!/usr/bin/env php
<?php
if (!isset($_SERVER['argv'],$_SERVER['argv'][1]) || $_SERVER['argv'][1] == '--help' || $_SERVER['argc'] != 2) {
    echo "This program requires 1 argument.\n";
    echo "convert.php oldfile.shtml newfile.shtml\n\n";
    exit();
}

if (!file_exists($_SERVER['argv'][1])) {
    echo "Filename does not exist!\n";
    exit();
}

require_once __DIR__ . '/../../tests/bootstrap.php';

use UNL\Templates\Templates;

$scannedPage = new UNL\Templates\Scanner(file_get_contents($_SERVER['argv'][1]));
$new = Templates::factory('Fixed', Templates::VERSION_5);

foreach ($scannedPage->getRegions() as $region) {
    if (count($region)) {
        $new->{$region->getName()} = $region->getValue();
    }
}

echo $new;
