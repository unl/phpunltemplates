<?php
/**
 * AUTO-GENERATED FILE
 */


namespace UNL\Templates\Version5;

/**
 * Template Definition for app_debug.dwt
 *
 * This class is an auto-generated class. Do not manually edit.
 */
class AppDebug extends \UNL\Templates\Version5
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

    protected $template = 'App_debug.tpl';

    protected $regions = array(
        'doctitle' => '
  <title>App Sub-Theme</title>
',
        'head' => '
  <!-- Place optional header elements here -->
',
        'visitlocal' => '
        <!--#include virtual="/wdn/templates_5.0/includes/local/visit-local.html" -->
        ',
        'applylocal' => '
        <!--#include virtual="/wdn/templates_5.0/includes/local/apply-local.html" -->
        ',
        'givelocal' => '
        <!--#include virtual="/wdn/templates_5.0/includes/local/give-local.html" -->
        ',
        'affiliation' => '
          ',
        'titlegraphic' => '
          <a class="unl-site-title-short" href="https://www.unl.edu/">
            Web Application
          </a>
          ',
        'appcontrols' => '
        <!--#include virtual="/wdn/templates_5.0/includes/local/app-controls.html" -->
        ',
        'appsearch' => '
      <!--#include virtual="/wdn/templates_5.0/includes/local/app-search.html" -->
      ',
        'maincontentarea' => '
    <p>Impress your audience with awesome content!</p>
    ',
        'optionalfooter' => '
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

