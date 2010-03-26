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
$pfm->setReleaseVersion('1.0.0RC9');
$pfm->setReleaseStability('beta');
$pfm->setAPIStability('beta');
$notes = '
Feature Release!
Added support for specifying the template version, 2 or 3.
* UNL_Templates::$options[\'version\'] = 3; to use the new templates.
* Added the secure template.
* Add debug template.
* Updated Version 3 templates to reflect footer changes.

Additional work to prevent broken pages.
* If local files are not present for the <!--#include statements, it will grab them remotely.
* If wdn/templates_3.0 does not exist locally it will use a template with absolute references to prevent broken pages.

New methods:
* addHeadLink($href, $relation, $relType = \'rel\', array $attributes = array())
* addScript($url, $type = \'text/javascript\')
* addScriptDeclaration($content, $type = \'text/javascript\')
* addStyleDeclaration($content, $type = \'text/css\')
* addStyleSheet($url, $media = \'all\')
* __toString()  Now you can just use echo $page;

Auto loading of files - now supporting:
* optionalfooter=>optionalFooter.html
* collegenavigationlist=>unitNavigation.html
* contactinfo=>footerContactInfo.html

New Remote Template Scanner UNL_Templates_Scanner
* Scans a rendered UNL Template page for the editable content areas.

Other fixes:
* Use static vars instead of PEAR::getStaticProperty() - fixes E_STRICT warnings
* Remove debug code causing cache to never be used.
* Fix debugging.
* Merge UNL_DWT::$options with options from ini file instead of overwriting.
* Set default timezone to use before we use date functions.
* Add newlines after header additions.
* Fix addScriptDeclaration method to comment out CDATA to prevent syntax errors.

Add example of a custom class with auto-breadcrumb generation and body content loading.

';
$pfm->setNotes($notes);
$pfm->addRelease(); // Set up a release section.

$pfm->clearDeps();
$pfm->setPhpDep('5.0.0');
$pfm->setPearinstallerDep('1.4.3');
$pfm->addPackageDepWithChannel('optional', 'Cache_Lite', 'pear.php.net', '1.0');
$pfm->addPackageDepWithChannel('required', 'UNL_Cache_Lite', 'pear.unl.edu', '0.1.0');
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
