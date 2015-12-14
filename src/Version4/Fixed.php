<?php
/**
 * AUTO-GENERATED FILE
 */


namespace UNL\Templates\Version4;

/**
 * Template Definition for fixed.dwt
 *
 * This class is an auto-generated class. Do not manually edit.
 */
class Fixed extends \UNL\Templates\Version4
{

    protected $template = 'Fixed.tpl';

    protected $regions = array(
        'doctitle' => '
<title>Use a descriptive page title | Optional Site Title (use for context) | University of Nebraska&ndash;Lincoln</title>
',
        'head' => '
<!-- Place optional header elements here -->

',
        'titlegraphic' => 'The Title of My Site',
        'breadcrumbs' => '
                <ul>
                    <li><a href="http://www.unl.edu/" title="University of Nebraska&ndash;Lincoln" class="wdn-icon-home">UNL</a></li>
                    <li><a href="#" title="Site Title">Site Title</a></li>
                    <li>Home</li>
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
            'value' => '',
            'type' => 'text',
        ),
    );


}

