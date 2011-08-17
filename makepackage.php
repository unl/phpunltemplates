<?php
ini_set('display_errors', true);
require_once 'PEAR/PackageFileManager2.php';
require_once 'PEAR/PackageFileManager/File.php';
require_once 'PEAR/Task/Postinstallscript/rw.php';
require_once 'PEAR/Config.php';
require_once 'PEAR/Frontend.php';

/**
 * @var PEAR_PackageFileManager
 */
PEAR::setErrorHandling(PEAR_ERROR_DIE);
chdir(dirname(__FILE__));
$pfm = PEAR_PackageFileManager2::importOptions('package.xml', array(
//$pfm = new PEAR_PackageFileManager2();
//$pfm->setOptions(array(
	'packagedirectory' => dirname(__FILE__),
	'baseinstalldir' => '/',
	'filelistgenerator' => 'file',
	'ignore' => array(	'package.xml',
						'package2.xml',
						'.project',
                        'tests',
						'*.tgz',
                        '*.tar',
                        '*.zip',
                        '*/lib/*',
						'makepackage.php',
						'*CVS/*',
						'.cache',
						'cssUNLTemplates.ini',
						'*/_notes/*',
                        '*docs/examples/includes*',
                        'server.php'),
	'simpleoutput' => true,
	'roles'=>array('php'=>'php'	),
	'exceptions'=>array()
));
$pfm->setChannel('pear.unl.edu');
$pfm->setPackage('UNL_Templates');
$pfm->setPackageType('php'); // this is a PEAR-style php script package
$pfm->setSummary('The UNL HTML Templates as a PEAR Package.');
$pfm->setDescription('This package allows you to render UNL Template styled pages using PHP Objects.');
$pfm->setAPIVersion('1.0.0');
$pfm->setReleaseVersion('1.2.0');
$pfm->setReleaseStability('stable');
$pfm->setAPIStability('stable');
$notes = '
Update .tpl cache so template files are in sync with latest wdntemplates.
Allow underscores within Version3 template include files.

New templates!

 * Fixed_html5
 * Unlaffiliate

Template updates:

 * Meta lang fixes
 * Remove IDM region from the secure template
 * Mobile template now supports navigation and move to HTML5

';
$pfm->setNotes($notes);
$pfm->addRelease(); // Set up a release section.

$pfm->clearDeps();
$pfm->setPhpDep('5.0.0');
$pfm->setPearinstallerDep('1.4.3');
$pfm->addPackageDepWithChannel('optional', 'Cache_Lite', 'pear.php.net', '1.0');
$pfm->addPackageDepWithChannel('optional', 'UNL_Cache_Lite', 'pear.unl.edu', '0.1.0');
$pfm->addPackageDepWithChannel('required', 'UNL_DWT', 'pear.unl.edu', '0.7.1');

//$pfm->addMaintainer('lead','nhummel2','Ned Hummel','nhummel2@math.unl.edu');
$pfm->setLicense('BSD License', 'http://www1.unl.edu/wdn/wiki/Software_License');

// replace @PHP-BIN@ in this file with the path to php executable!  pretty neat
foreach (array('DWT.ini','Templates.php') as $file) {
	$pfm->addReplacement($file, 'pear-config', '@PHP_BIN@', 'php_bin');
	$pfm->addReplacement($file, 'pear-config', '@DATA_DIR@', 'data_dir');
	$pfm->addReplacement($file, 'pear-config', '@PHP_DIR@', 'php_dir');
}
// replace @PHP-BIN@ in this file with the path to php executable!  pretty neat
$pfm->addGlobalReplacement('pear-config', '@DATA_DIR@', 'data_dir');
$pfm->addGlobalReplacement('pear-config', '@PHP_DIR@', 'php_dir');

$pfm->generateContents(); // create the <contents> tag
if (isset($_SERVER['argv']) && $_SERVER['argv'][1] == 'make') {
    $pfm->writePackageFile();
} else {
    $pfm->debugPackageFile();
}
?>
