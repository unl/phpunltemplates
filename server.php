<?php

if (file_exists(dirname(__FILE__).'/data/tpl_cache')) {
    $tpl_dir = dirname(__FILE__).'/data/tpl_cache';
} else {
    $tpl_dir = '/usr/share/pear/data/UNL_Templates/Templates/tpl_cache';
}


$version = 2;
$default_template = 'Fixed.tpl';

if (isset($_GET['version'])) {
    $version = intval($_GET['version']);
}

if (isset($_GET['template'])
	&& strpos($_GET['template'],'/') === false) {
	if (isset($_GET['full'])) {
	    require_once 'UNL/Templates.php';
	    UNL_Templates::$options['version'] = $version;
		$p = UNL_Templates::factory(str_replace('.tpl', '', $_GET['template']));
		$p->maincontentarea		= '';
		$p->leftRandomPromo		= '';
		$p->footercontent		= '';
		$p->navlinks			= '';
		$p->breadcrumbs			= '';
		$p->titlegraphic		= '';
		$p->doctitle			= '<title></title>';
		echo $p->toHtml();
	} else {
	    
		$dwt = $tpl_dir.'/Version'.$version.'/'.$_GET['template'];
		if (file_exists($dwt)) {
			echo file_get_contents($dwt);
		} elseif (file_exists($tpl_dir.'/Version'.$version.'/'.$default_template)) {
			echo file_get_contents($tpl_dir.'/Version'.$version.'/'.$default_template);
		} else {
		    header('HTTP/1.0 404 Not Found');
		    echo 'Sorry could not load the template files!';
		}
	}
}
