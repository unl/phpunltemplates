<?php
/**
* Extra package.xml settings such as dependencies.
* More information: http://pear.php.net/manual/en/pyrus.commands.make.php#pyrus.commands.make.packagexmlsetup
*/
$package->dependencies['required']->package['pear.unl.edu/UNL_DWT']->save();
$package->dependencies['optional']->package['pear.unl.edu/UNL_Cache_Lite']->save();
$package->dependencies['optional']->package['pear.php.net/Cache_Lite']->save();

?>
