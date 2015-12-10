<?php
/**
 * AUTO-GENERATED FILE
 */


namespace UNL\Templates\Version4x1;

/**
 * Template Definition for fixed.dwt
 *
 * This class is an auto-generated class. Do not manually edit.
 */
class Fixed extends \UNL\Templates\Version4x1
{

    protected $template = 'Fixed.tpl';

    protected $regions = array(
        'doctitle' => '
<title>Use a descriptive page title | Optional Site Title (use for context) | University of Nebraska&ndash;Lincoln</title>
',
        'head' => '
',
        'affiliation' => 'My site affiliation',
        'titlegraphic' => 'Title of my site',
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
        'contactinfo' => '
                    <!--#include virtual="../sharedcode/localFooter.html" -->
                    ',
        'leftcollinks' => '
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

