# PHP WDN Templates

[![Build Status](https://travis-ci.org/unl/phpunltemplates.svg)](https://travis-ci.org/unl/phpunltemplates)
[![Coverage Status](https://coveralls.io/repos/unl/phpunltemplates/badge.svg?branch=master&service=github)](https://coveralls.io/github/unl/phpunltemplates?branch=master)

The UNL HTML Templates as a PHP library

This package allows you to render UNL Template styled pages using PHP Objects.

## Requirements

* PHP >= 5.5

## Example

*  Navigate to your web root
* Create a `composer.json` file with:

```
{
  "require": {
    "unl/php-wdn-templates": "5.0.*"
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

$page = Templates::factory('Fixed', Templates::VERSION_5);

$page->doctitle = '<title>My Sample UNL Site | University of Nebraska&ndash;Lincoln</title>';
$page->head = '<!-- Place optional header elements here -->';
$page->affiliation = '<a href="#">My site affiliation</a>';
$page->titlegraphic = '<a class="unl-site-title-medium" href="#">Title of my site</a>';
$page->navlinks = '<ul>
                   <li><a href="./">Home</a>
                       <ul>
                       <li><a href="./">Sub-link 1</a></li>
                       <li><a href="./">Sub-link 2</a></li>
                       </ul>
                   </li>
                   </ul>';
$page->hero = '<div class="dcf-hero dcf-hero-default"></div>';
$page->breadcrumbs = '<ul>
                      <li><a href="http://www.unl.edu/">UNL</a></li>
                      <li><a href="./">My Sample UNL Site</a></li>
                      </ul>';
$page->pagetitle = '<h1>Welcome</h1>';
$page->herogroup1 = '';
$page->herogroup2 = '<div class="dcf-hero-group-2"></div>';
$page->maincontentarea = '<p>Content</p>';
$page->contactinfo = '<p><strong>University of Nebraska-Lincoln</strong><br />
                      1400 R Street<br />
                      Lincoln, NE 68588<br />
                     402-472-7211</p>';
$page->jsbody = '<!-- put your custom javascript here -->';

echo $page;
```

* Load index.php in a web browser.
* Attend WDN meetings the second Tuesday of every month in the Nebraska Union at 2:00 pm.
* Learn about keeping your web server syncronized at http://wdn.unl.edu/synchronizing-unledu-web-framework
