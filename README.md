The UNL HTML Templates as a PEAR Package.

This package allows you to render UNL Template styled pages using PHP Objects.

##Example

* Download (http://wdn.unl.edu/) the UNL template CSS and JS or checkout the project (http://github.com/unl/wdntemplates)
so that the 'wdn' directory is at the web root.

* Download pyrus (http://pear2.php.net/) into your home directory.

* Navigate to your web root.

* Run the following commands

````bash
$ mkdir mysampleunlsite
$ cd mysampleunlsite
$ mkdir vendor
$ php ~/pyrus.phar mypear ./vendor
$ php ~/pyrus.phar channel-discover pear.unl.edu unl

# Leave off '-beta' for the stable release
$ php ~/pyrus.phar install unl/UNL_DWT-beta
$ php ~/pyrus.phar install unl/UNL_Templates-beta

$ nano index.php
````

* Paste the following into the editor

````php
<?php

set_include_path(get_include_path() . PATH_SEPARATOR . dirname(__DIR__) . '/mysampleunlsite/vendor/php');

require_once 'UNL/Templates.php';

UNL_Templates::$options['version'] = UNL_Templates::VERSION3x1;
$page = UNL_Templates::factory('fixed');

$page->doctitle = '<title>My Sample UNL Site | University of Nebraska&ndash;Lincoln</title>';
$page->head = '<link rel="stylesheet" href="http://ucommxsrv1.unl.edu/hr/serviceawards/service.css" type="text/css" />';
$page->navlinks = '<ul>
                   <li><a href="./">Home</a>
                       <ul>
                       <li><a href="./">Sub-link 1</a></li>
                       <li><a href="./">Sub-link 2</a></li>
                       </ul>
                   </li>
                   </ul>';
$page->footercontent = '&copy; 2012 University of Nebraska–Lincoln | Lincoln, NE 68588 | 402-472-7211 |
                        <a href="http://www.unl.edu/ucomm/aboutunl/" title="Click here to know more about UNL">About UNL</a> |
                        <a href="http://www1.unl.edu/comments/" title="Click here to direct your comments and questions">comments?</a>
                        <br />UNL is an equal opportunity employer with a comprehensive plan for diversity.
                        Find out more: <a href="https://employment.unl.edu/" title="Employment at UNL">employment.unl.edu</a>';
$page->breadcrumbs = '<ul>
                      <li><a href="http://www.unl.edu/">UNL</a></li>
                      <li><a href="./">My Sample UNL Site</a></li>
                      </ul>';
$page->titlegraphic = 'My Sample UNL Site';
$page->pagetitle = '<h1>Welcome</h1>';
$page->leftcollinks = '<h3>Related Links</h3>
                       <ul>
                       <li><a href="http://ucomm.unl.edu/">University Communications</a></li>
                       </ul>';
$page->contactinfo = '<h3>Contact Us</h3>
                      <p><strong>University of Nebraska-Lincoln</strong><br />
                      1400 R Street<br />
                      Lincoln, NE 68588<br />
                      402-472-7211</p>';
$page->maincontentarea = '<p>Content</p>';

echo $page;
````

* Ctrl+x to save and exit.

* Load index.php in a web browser.

* Attend WDN meetings the second Tuesday of every month in the Nebraska Union at 2:00 pm.
