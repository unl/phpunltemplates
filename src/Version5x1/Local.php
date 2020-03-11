<?php
/**
 * AUTO-GENERATED FILE
 */


namespace UNL\Templates\Version5x1;

/**
 * Template Definition for local.dwt
 *
 * This class is an auto-generated class. Do not manually edit.
 */
class Local extends \UNL\Templates\Version5x1
{

    const VERSION = '5.1';

    const LOCAL_NAME = 'Version5x1';

    const SOURCE_ROOT = 'https://raw.githubusercontent.com/unl/wdntemplates/5.1/';

    const INCLUDE_ROOT = '/wdn/templates_5.1/includes/';

    const VERSION_4 = '4';

    const VERSION_4_1 = '4.1';

    const VERSION_5 = '5';

    const VERSION_DEFAULT = '5';

    const TEMPLATE_CACHE_DIR = 'tpl_cache';

    const DEPENDENTS_CACHE_DIR = 'dep_cache';

    const INCLUDE_ERROR = '[an error occurred while processing this directive]';

    const TOKEN_DEP_VERSION = '$DEP_VERSION$';

    const VERSION_5_1 = '5.1';

    protected $template = 'Local.tpl';

    protected $regions = array(
        'doctitle' => '
  <title>Use a descriptive page title | Optional Site Title (use for context) | University of Nebraska&ndash;Lincoln</title>
  ',
        'head' => '
  <!-- Place optional header elements here -->
  ',
        'visitlocal' => '
      <!--#include virtual="/wdn/templates_5.1/includes/local/visit-local.html" -->
      ',
        'applylocal' => '
      <!--#include virtual="/wdn/templates_5.1/includes/local/apply-local.html" -->
      ',
        'givelocal' => '
      <!--#include virtual="/wdn/templates_5.1/includes/local/give-local.html" -->
      ',
        'affiliation' => '
  <a href="#">My site affiliation</a>
  ',
        'titlegraphic' => '
  <a class="unl-site-title-medium" href="#">Title of my site</a>
  ',
        'navlinks' => '
  <!--#include virtual="/wdn/templates_5.1/includes/local/nav-local.html" -->
  ',
        'hero' => '
  <div class="dcf-hero dcf-hero-default">
    ',
        'breadcrumbs' => '
          <ol>
            <li><a href="https://www.unl.edu/">Nebraska</a></li>
            <li><a href="/">Site Title</a></li>
            <li><span aria-current="page">Home</span></li>
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
        'optionalfooter' => '
  ',
        'contactinfo' => '
  <!--#include virtual="/wdn/templates_5.1/includes/local/footer-local.html" -->
  ',
        'jsbody' => '
<!-- put your custom javascript here -->
',
    );

    protected $params = array(
        'class' => array(
            'name' => 'class',
            'value' => '',
            'type' => 'text',
        ),
    );


}

