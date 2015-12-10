# PHP UNL Templates

The UNL HTML Templates as a PHP library

This package allows you to render UNL Template styled pages using PHP Objects.

## Requirements

* PHP >= 5.5

## Example

*  Navigate to your web root
* Create a `composer.json` file with:

```
{
  "repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/unl/phpunltemplates.git"
    }
  ],
  "require": {
    "unl/php-unl-templates": "4.1.*"
  }
}
```

* Run the following commands

```sh
curl -sS https://getcomposer.org/installer | php
php composer.phar install
```

* Create an `index.php` file with

```php
<?php

require_once  'vendor/autoload.php';

use UNL\Templates\Templates;

$page = Templates::factory('Fixed', Templates::VERSION_4_1);

$page->doctitle = '<title>My Sample UNL Site | University of Nebraska&ndash;Lincoln</title>';
$page->navlinks = '<ul>
                   <li><a href="./">Home</a>
                       <ul>
                       <li><a href="./">Sub-link 1</a></li>
                       <li><a href="./">Sub-link 2</a></li>
                       </ul>
                   </li>
                   </ul>';
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
$page->contactinfo = '<p><strong>University of Nebraska-Lincoln</strong><br />
                      1400 R Street<br />
                      Lincoln, NE 68588<br />
                      402-472-7211</p>';
$page->maincontentarea = '<p>Content</p>';

echo $page;
```

* Load index.php in a web browser.
* Attend WDN meetings the second Tuesday of every month in the Nebraska Union at 2:00 pm.
* Learn about keeping your web server syncronized at http://wdn.unl.edu/synchronizing-unledu-web-framework
