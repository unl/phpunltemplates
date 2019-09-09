<?php

namespace UNL\Templates\Custom1;


class Fixed extends \UNL\Templates\Custom1
{

    const VERSION = '1';

    const LOCAL_NAME = 'Custom1';

    const SOURCE_ROOT = '';

    const INCLUDE_ROOT = '';

    const VERSION_DEFAULT = '1';

    const TEMPLATE_CACHE_DIR = 'tpl_cache';

    const DEPENDENTS_CACHE_DIR = 'dep_cache';

    const INCLUDE_ERROR = '[an error occurred while processing this directive]';

    const TOKEN_DEP_VERSION = false;

    protected $template = 'Custom.tpl';

    protected $regions = array(
        'doctitle' => '<title>Use a descriptive page title</title>',
        'head' => '<!-- Place optional header elements here -->',
        'affiliation' => '<a href="#">My site affiliation</a>',
        'titlegraphic' => '<a href="#">Title of my site</a',
        'navlinks' => '',
        'breadcrumbs' => '',
        'pagetitle' => '<h1>Please Title Your Page Here</h1>',
        'maincontentarea' => '<p>Impress your audience with awesome content!</p>',
        'optionalfooter' => '',
        'contactinfo' => '',
        'jsbody' => '<!-- put your custom javascript here -->',
    );

    protected $params = array(
        'class' => array(
            'name' => 'class',
            'value' => '',
            'type' => 'text',
        ),
    );

}

