<?php
/**
 * AUTO-GENERATED FILE
 */


namespace UNL\Templates\Version4;

/**
 * Template Definition for unlaffiliate_debug.dwt
 *
 * This class is an auto-generated class. Do not manually edit.
 */
class UnlaffiliateDebug extends \UNL\Templates\Version4
{

    protected $template = 'Unlaffiliate_debug.tpl';

    protected $regions = array(
        'doctitle' => '
<title>Use a descriptive page title | Optional Site Title (use for context) | UNL Affiliate</title>
',
        'head' => '
<!-- Place optional header elements here -->
<link rel="stylesheet" type="text/css" media="screen" href="../sharedcode/affiliate.css" />
<link href="../sharedcode/affiliate_imgs/favicon.ico" rel="shortcut icon" />
',
        'sitebranding_logo' => '
                <div id="logo">
                    <a href="http://www.throughtheeyes.org/" title="Through the Eyes of the Child Initiative" id="wdn_logo_link">Through the Eyes of the Child Initiative</a>
                </div>
                ',
        'sitebranding_affiliate' => '<a href="http://www.unl.edu" title="University of Nebraska&ndash;Lincoln">An affiliate of the University of Nebraska&ndash;Lincoln</a>',
        'titlegraphic' => 'The Title of My Site',
        'breadcrumbs' => '
                <ul>
                    <li><a href="http://www.throughtheeyes.org/" title="Through the Eyes of the Child Initiative">Home</a></li>
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
        'leftcollinks' => '
                    <!--#include virtual="../sharedcode/relatedLinks.html" -->
                    ',
        'contactinfo' => '
                            <!--#include virtual="../sharedcode/footerContactInfo.html" -->
                            ',
        'footercontent' => '
                            <!--#include virtual="../sharedcode/footer.html" -->
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

