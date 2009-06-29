<?php
/**
 * Object oriented interface to create UNL Template based HTML pages.
 * 
 * PHP version 5
 *  
 * @category  Templates
 * @package   UNL_Templates
 * @author    Brett Bieber <brett.bieber@gmail.com>
 * @author    Ned Hummel <nhummel2@unl.edu>
 * @copyright 2007 Regents of the University of Nebraska
 * @license   http://www1.unl.edu/wdn/wiki/Software_License BSD License
 * @link      http://pear.unl.edu/
 */

/**
 * Utilizes the UNL_DWT Dreamweaver template class.
 */
require_once 'UNL/DWT.php';

/**
 * Cache lite is used to cache the raw template files, and can also be used to 
 * cached the rendered HTML output.
 */
require_once 'Cache/Lite.php';

/**
 * Allows you to create UNL Template based HTML pages through an object 
 * oriented interface.
 * 
 * Install on your PHP server with:
 * pear channel-discover pear.unl.edu
 * pear install unl/UNL_Templates
 * 
 * <code>
 * <?php
 * require_once 'UNL/Templates.php';
 * $page                  = UNL_Templates::factory('Fixed');
 * $page->titlegraphic    = '<h1>UNL Templates</h1>';
 * $page->maincontentarea = 'Hello world!';
 * $page->loadSharedcodeFiles();
 * echo $page;
 * </code>
 * 
 * @category  Templates
 * @package   UNL_Templates
 * @author    Brett Bieber <brett.bieber@gmail.com>
 * @author    Ned Hummel <nhummel2@unl.edu>
 * @copyright 2007 Regents of the University of Nebraska
 * @license   http://www1.unl.edu/wdn/wiki/Software_License BSD License
 * @link      http://pear.unl.edu/
 */
class UNL_Templates extends UNL_DWT
{
    const VERSION2 = 2;
    const VERSION3 = 3;
    
    static public $options = array(
        'debug'                  => 0,
        'sharedcodepath'         => 'sharedcode',
        'templatedependentspath' => '',
        'dwtini'                 => '@DATA_DIR@/UNL_Templates/DWT.ini',
        'tpl_location'           => '/tmp/',
        'templateserver'         => 'pear.unl.edu',
        'cache'                  => array(),
        'version'                => UNL_Templates::VERSION2
    );
    
    /**
     * Construct a UNL_Templates object
     */
    public function __construct()
    {
        date_default_timezone_set(date_default_timezone_get());
        UNL_DWT::$options['tpl_location'] = self::$options['tpl_location'];
        
        self::$options['cache'] = array('cacheDir'=>&self::$options['tpl_location'],
                                        'lifeTime'=>3600);
        self::$options['templatedependentspath'] = $_SERVER['DOCUMENT_ROOT'];
    }
    
    /**
     * Initialize the configuration for the UNL_DWT class
     * 
     * @return void
     */
    public static function loadDefaultConfig()
    {
        $config = array('UNL_DWT'=>array(
                        'class_location' => 'UNL/Templates/Version2/',
                        'tpl_location'   => '/tmp/',
                        'class_prefix'   => 'UNL_Templates_Version2_'));
        foreach ($config as $class=>$values) {
            if ($class == 'UNL_DWT') {
                UNL_DWT::$options = array_merge(UNL_DWT::$options, $values);
            }
        }
    }
    
    /**
     * The factory returns a template object for any UNL Template style requested:
     *  * Fixed
     *  * Liquid
     *  * Popup
     *  * Document
     *  * Secure
     *  * Unlaffiliate
     * 
     * <code>
     * $page = UNL_Templates::factory('Fixed');
     * </code>
     *
     * @param string $type     Type of template to get, Fixed, Liquid, Doc, Popup
     * @param mixed  $coptions Options for the constructor
     * 
     * @return UNL_Templates
     */
    static function &factory($type, $coptions = false)
    {
        UNL_Templates::loadDefaultConfig();
        return parent::factory($type, $coptions);
    }
    
    /**
     * Attempts to connect to the template server and grabs the latest cache of the
     * template (.tpl) file. Set options for Cache_Lite in self::$options['cache']
     * 
     * @return string
     */
    function getCache()
    {
        $Cache_Lite = new Cache_Lite(self::$options['cache']);
        // Test if there is a valid cache for this template
        if ($data = $Cache_Lite->get($this->__template)) {
            // Content is in $data
            $this->debug('Using cached version from '.
                         date('Y-m-d H:i:s', $Cache_Lite->lastModified()), 'getCache', 3);
        } else { // No valid cache found
            $file = 'http://'.self::$options['templateserver'].
                    '/UNL/Templates/server.php?template='.$this->__template;
            if ($data = file_get_contents($file)) {
                $this->debug('Updating cache.', 'getCache', 3);
                $data = $this->makeIncludeReplacements($data);
                $Cache_Lite->save($data);
            } else {
                // Error getting updated version of the templates.
                $this->debug('Could not connect to template server. ' . PHP_EOL .
                             'Extending life of template cache.', 'getCache', 3);
                $Cache_Lite->extendLife();
                $data = $Cache_Lite->get($this->__template);
            }
        }
        return $data;
    }
    
    /**
     * Loads standard customized content (sharedcode) files from the filesystem.
     * 
     * @return void
     */
    function loadSharedcodeFiles()
    {    
        $includes = array(
                            'footercontent'=>'footer.html',
                            'navlinks'=>'navigation.html',
                            'leftcollinks'=>'relatedLinks.html',
                            'optionalfooter'=>'optionalFooter.html',
                            'collegenavigationlist'=>'unitNavigation.html',
                            );
        foreach ($includes as $element=>$filename) {
            if (file_exists(self::$options['sharedcodepath'].'/'.$filename)) {
                $this->{$element} = file_get_contents(self::$options['sharedcodepath'].'/'.$filename);
            }
        }
    }


    /**
     * Add a link within the head of the page.
     * 
     * @param string $href       URI to the resource
     * @param string $relation   Relation of this link element (alternate)
     * @param string $relType    The type of relation (rel)
     * @param array  $attributes Any additional attribute=>value combinations
     * 
     * @return void
     */
    function addHeadLink($href, $relation, $relType = 'rel', array $attributes = array())
    {
        $attributeString = '';
        foreach ($attributes as $name=>$value) {
            $attributeString .= $name.'="'.$value.'" ';
        }    
    
        $this->head .= '<link '.$relType.'="'.$relation.'" href="'.$href.'" '.$attributeString.' />'.PHP_EOL;
    
    }

    /**
     * Add a (java)script to the page.
     *
     * @param string $url  URL to the script
     * @param string $type Type of script text/javascript
     * 
     * @return void
     */
    function addScript($url, $type = 'text/javascript')
    {
        $this->head .= '<script type="'.$type.'" src="'.$url.'"></script>'.PHP_EOL;
    }

    /**
     * Adds a script declaration to the page.
     *
     * @param string $content The javascript you wish to add.
     * @param string $type    Type of script tag.
     * 
     * @return void
     */
    function addScriptDeclaration($content, $type = 'text/javascript')
    {
        $this->head .= '<script type="'.$type.'"><![CDATA['.$content.']]></script>'.PHP_EOL;
    }

    /**
     * Add a style declaration to the head of the document.
     * <code>
     * $page->addStyleDeclaration('.course {font-size:1.5em}');
     * </code>
     *
     * @param string $content CSS content to add
     * @param string $type    type attribute for the style element
     * 
     * @return void
     */
    function addStyleDeclaration($content, $type = 'text/css')
    {
        $this->head .= '<style type="'.$type.'">'.$content.'</style>'.PHP_EOL;
    }
    
    /**
     * Add a link to a stylesheet.
     *
     * @param string $url   Address of the stylesheet, absolute or relative
     * @param string $media Media target (screen/print/projector etc)
     * 
     * @return void
     */
    function addStyleSheet($url, $media = 'all')
    {
        $this->addHeadLink($url, 'stylesheet', 'rel', array('media'=>$media, 'type'=>'text/css'));
    }

    /**
     * Returns the page in HTML form.
     * 
     * @return string THe full HTML of the page.
     */
    function toHtml()
    {
        $p       = $this->getCache();
        $regions = get_object_vars($this);
        return $this->replaceRegions($p, $regions);
    }
    
    /**
     * returns this template as a string.
     *
     * @return string
     */
    function __toString()
    {
        return $this->toHtml();
    }
    
    
    /**
     * Populates templatedependents files
     * 
     * Replaces the template dependent include statements with the corresponding 
     * files from the /ucomm/templatedependents/ directory. To specify the location
     * of your templatedependents directory, use something like
     * $page->options['templatedependentspath'] = '/var/www/';
     * and set the path to the directory containing /ucomm/templatedependents/
     *
     * @param string $p Page to make replacements in
     * 
     * @return string
     */
    function makeIncludeReplacements($p)
    {
        $this->debug('Now making template include replacements.',
                     'makeIncludeReplacements', 3);
        $includes = array();
        preg_match_all('<!--#include virtual="(/ucomm/templatedependents/[A-Za-z0-9\.\/]+)" -->',
                        $p, $includes);
        $this->debug(print_r($includes, true), 'makeIncludeReplacements', 3);
        foreach ($includes[1] as $include) {
            $this->debug('Replacing '.$include, 'makeIncludeReplacements', 3);
            $file = self::$options['templatedependentspath'].$include;
            if (file_exists($file)) {
                $p = str_replace('<!--#include virtual="'.$include.'" -->',
                                 file_get_contents($file), $p);
            } else {
                $this->debug('File does not exist:'.$file,
                             'makeIncludeReplacements', 3);
            }
        }
        return $p;
    }
    
    /**
     * Debug handler for messages.
     *
     * @param string $message Message to send to debug output
     * @param int    $logtype Which log to send this to
     * @param int    $level   The threshold to send this message or not.
     * 
     * @return void
     */
    function debug($message, $logtype = 0, $level = 1)
    {
        UNL_DWT::$options['debug'] = self::$options['debug'];
        parent::debug($message, $logtype, $level);
    }
}
