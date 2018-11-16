<?php
/**
 * AUTO-GENERATED FILE
 */


namespace UNL\Templates\Version5;

/**
 * Template Definition for debug.dwt
 *
 * This class is an auto-generated class. Do not manually edit.
 */
class Debug extends \UNL\Templates\Version5
{

    const VERSION = '5';

    const LOCAL_NAME = 'Version5';

    const SOURCE_ROOT = 'https://raw.githubusercontent.com/unl/wdntemplates/5.0/';

    const INCLUDE_ROOT = '/wdn/templates_5.0/includes/';

    const VERSION_4 = '4';

    const VERSION_4_1 = '4.1';

    const VERSION_5 = '5';

    const VERSION_DEFAULT = '5';

    const TEMPLATE_CACHE_DIR = 'tpl_cache';

    const DEPENDENTS_CACHE_DIR = 'dep_cache';

    const INCLUDE_ERROR = '[an error occurred while processing this directive]';

    const TOKEN_DEP_VERSION = '$DEP_VERSION$';

    protected $template = 'Debug.tpl';

    protected $regions = array(
        'doctitle' => '
  <title>Use a descriptive page title | Optional Site Title (use for context) | University of Nebraska&ndash;Lincoln</title>
  ',
        'head' => '
  <!-- Place optional header elements here -->
  ',
        'affiliation' => '
  <a href="#">My site affiliation</a>
  ',
        'titlegraphic' => '
  <a class="unl-site-title-medium" href="#">Title of my site</a>
  ',
        'navlinks' => '
  <!--#include virtual="/wdn/templates_5.0/includes/local/nav-local.html" -->
  ',
        'hero' => '
  <div class="dcf-hero dcf-hero-default">
    ',
        'breadcrumbs' => '
        <ol>
          <li><a href="http://www.unl.edu/" title="University of Nebraska&ndash;Lincoln" class="wdn-icon-home">UNL</a></li>
          <li><a href="#" title="Site Title">Site Title</a></li>
          <li>Home</li>
        </ol>
        ',
        'pagetitle' => '
        <h1>Please Title Your Page Here</h1>
        ',
        'herogroup1' => '
      ',
        'herogroup2' => '
    <div class="dcf-hero-group-2">
    </div>
    ',
        'maincontentarea' => '
    <p>Impress your audience with awesome content!</p>
    ',
        'contactinfo' => '
  <!--#include virtual="/wdn/templates_5.0/includes/local/footer-local.html" -->
  ',
        'jsbody' => '
<!-- put your custom javascript here -->
',
    );

    protected $params = array(
        'class' => array(
            'name' => 'class',
            'value' => 'debug',
            'type' => 'text',
        ),
    );


}

