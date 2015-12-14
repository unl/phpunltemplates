<?php
/**
 * AUTO-GENERATED FILE
 */


namespace UNL\Templates\Version4x1;

/**
 * Template Definition for unlaffiliate_debug.dwt
 *
 * This class is an auto-generated class. Do not manually edit.
 */
class UnlaffiliateDebug extends \UNL\Templates\Version4x1
{

    protected $template = 'Unlaffiliate_debug.tpl';

    protected $regions = array(
        'doctitle' => '
<title>Use a descriptive page title | Optional Site Title (use for context) | UNL Affiliate</title>
',
        'head' => '
<link rel="stylesheet" type="text/css" media="screen" href="../sharedcode/affiliate.css" />
<link href="../sharedcode/affiliate_imgs/favicon.ico" rel="shortcut icon" />
',
        'sitebranding_affiliate' => '<a href="http://www.unl.edu" title="University of Nebraska&ndash;Lincoln">An affiliate of the University of Nebraska&ndash;Lincoln</a>',
        'sitebranding_logo' => '
                    <!--#include virtual="/wdn/templates_4.1/includes/logo.html" -->
                    ',
        'affiliation' => 'My site affiliation',
        'titlegraphic' => 'Title of my site',
        'breadcrumbs' => '
                <ul>
                    <li><a href="#">Affiliate Home</a></li>
                </ul>
                ',
        'navlinks' => '
                    <!--#include virtual="../sharedcode/navigation.html" -->
                    ',
        'pagetitle' => '
                    <h1>Please Title Your Page Here</h1>
                    ',
        'maincontentarea' => '
                <div class="wdn-band">
                    <div class="wdn-inner-wrapper">
                        <p>Impress your audience with awesome content!</p>
                    </div>
                </div>
                ',
        'optionalfooter' => '
                    ',
        'contactinfo' => '
                    <!--#include virtual="../sharedcode/localFooter.html" -->
                    ',
        'leftcollinks' => '
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

