<?php

namespace UNL\Templates;

use UNL\DWT\AbstractDwt;

/**
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 */
abstract class Templates extends AbstractDwt
{
    const VERSION_4 = '4';
    const VERSION_4_1 = '4.1';
    const VERSION_5 = '5';

    const VERSION_DEFAULT = self::VERSION_5;

    const TEMPLATE_CACHE_DIR = 'tpl_cache';
    const DEPENDENTS_CACHE_DIR = 'dep_cache';
    const INCLUDE_ERROR = '[an error occurred while processing this directive]';
    const TOKEN_DEP_VERSION = '$DEP_VERSION$';

    // these constants should be replaced in version subclasses
    const VERSION = 'test';
    const LOCAL_NAME = 'VersionTest';
    const SOURCE_ROOT = './';
    const INCLUDE_ROOT = '/includes/';

    /**
     * Cache object for output caching
     *
     * @var UNL_Templates_CachingService
     */
    protected static $cache;

    protected static $patchVersion;

    public static $options = [
        'debug' => 0,
        'templatedependentspath' => '',
        'cache' => [],
        'version' => self::VERSION_DEFAULT,
        'timeout' => 5
    ];

    protected $localIncludePath;

    public static function getCachingService()
    {
        if (!isset(static::$cache)) {
            $class = 'CachingService\\NullService';

            if (class_exists('UNL_Cache_Lite')) {
                $class = 'CachingService\\UNLCacheLite';
            } elseif (class_exists('Cache_Lite')) {
                $class = 'CachingService\\CacheLite';
            }

            $class = __NAMESPACE__ . '\\' . $class;
            static::$cache = new $class(static::$options['cache']);
        }

        return static::$cache;
    }

    public static function setCachingService(CachingService\CachingServiceInterface $cache = null)
    {
        static::$cache = $cache;
    }

    protected static function generateElement($tagName, array $attributes = array(), $content = '')
    {
        $renderedPairs = [];

        foreach ($attributes as $name => $value) {
            $renderedPairs[] = $name . '="' . htmlspecialchars($value) . '"';
        }

        $renderedPairs = implode(' ', $renderedPairs);
        if ($renderedPairs) {
            $renderedPairs = ' ' . $renderedPairs;
        }

        if ($content === false) {
            return sprintf('<%1$s%2$s/>', $tagName, $renderedPairs);
        }


        return sprintf('<%1$s%2$s>%3$s</%1$s>', $tagName, $renderedPairs, $content);
    }

    protected static function getPatchVersion()
    {
        if (!static::$patchVersion) {
            static::$patchVersion = trim(file_get_contents(static::SOURCE_ROOT . 'VERSION_DEP'));
        }

        return static::$patchVersion;
    }

    protected static function replaceTokens($content)
    {
        if (strpos($content, self::TOKEN_DEP_VERSION)) {
            $content = str_replace(self::TOKEN_DEP_VERSION, static::getPatchVersion(), $content);
        }

        return $content;
    }

    protected static function makeIncludeReplacements($html, $localPath)
    {
        return preg_replace_callback(
            '/<!--#include virtual="(' . preg_quote(static::INCLUDE_ROOT, '/') . '[^"]+)" -->/',
            function ($matches) use ($localPath) {
                $include = $matches[1];
                $depPath = rtrim($localPath, '\\/');
                $isDepPathAUrl = preg_match('/^https?:\/\//', $depPath);

                if ($isDepPathAUrl) {
                    return static::fetchFileAndReplaceTokens($depPath . $include);
                }

                // If the dependents path isn't set, use the local cache (should work even with bad config options)
                if (empty($depPath) || !file_exists($depPath)) {
                    $depPath = static::getDataDir() . DIRECTORY_SEPARATOR . self::DEPENDENTS_CACHE_DIR .
                        DIRECTORY_SEPARATOR . static::LOCAL_NAME;
                }

                if (!file_exists($depPath . $include)) {
                    return self::INCLUDE_ERROR;
                }

                return static::fetchFileAndReplaceTokens($depPath . $include);
            },
            $html
        );
    }

    protected static function fetchFileAndReplaceTokens($includeFile)
    {
        $content = @file_get_contents($includeFile);

        if (false === $content) {
            return self::INCLUDE_ERROR;
        }

        return static::replaceTokens($content);
    }

    protected static function getDataDir()
    {
        return __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'data';
    }

    /**
     * Cleans the cache.
     *
     * @param mixed $o Pass a cached object to clean it's cache, or a string id.
     *
     * @return bool true if cache was successfully cleared.
     */
    public static function cleanCache($object = null)
    {
        return static::getCachingService()->clean($object);
    }

    public static function factory($type, $version = '')
    {
        if (!$version && !empty(static::$options['version'])) {
            $version = static::$options['version'];
        } elseif (!$version) {
            $version = self::VERSION_DEFAULT;
        }

        $version = str_replace('.', 'x', $version);


        $class = __NAMESPACE__ . '\\Version' . $version . '\\' . $type;

        if (!class_exists($class)) {
            throw new Exception\UnexpectedValueException('Requested template does not exist');
        }

        $instance = new $class;

        if (!$instance instanceof self) {
            throw new Exception\UnexpectedValueException('Template version must be an instance of Templates class');
        }

        return $instance;
    }

    public function getLocalIncludePath()
    {
        return $this->localIncludePath;
    }

    public function setLocalIncludePath($localIncludePath)
    {
        $this->localIncludePath = $localIncludePath;
        return $this;
    }

    public function getTemplateFile()
    {
        return $this->getCache();
    }

    /**
     * Attempts to connect to the template server and grabs the latest cache of the
     * template (.tpl) file. Set options for Cache_Lite in self::$options['cache']
     *
     * @return string
     */
    protected function getCache()
    {
        $localIncludePath = $this->getLocalIncludePath();

        if (!$localIncludePath && !empty(static::$options['templatedependentspath'])) {
            $localIncludePath = static::$options['templatedependentspath'];
        }

        $cache = static::getCachingService();
        $cacheKey = static::VERSION . $localIncludePath . $this->template;

        // Test if there is a valid cache for this template
        if ($data = $cache->get($cacheKey)) {
            return $data;
        }

        $templateFile = $this->getTemplatePath();

        if (!file_exists($templateFile)) {
            return '';
        }

        if ($data = file_get_contents($templateFile)) {
            $data = static::makeIncludeReplacements($data, $localIncludePath);
            $cache->save($data, $cacheKey);
        }

        return $data;
    }

    protected function getTemplatePath()
    {
        return static::getDataDir() . DIRECTORY_SEPARATOR . self::TEMPLATE_CACHE_DIR . DIRECTORY_SEPARATOR .
            static::LOCAL_NAME . DIRECTORY_SEPARATOR . $this->template;
    }

    protected function appendToHead($value)
    {
        $head = $this->getRegion('head');

        if (!$head) {
            return $this;
        }

        $head->setValue($head->getValue() . $value);
        return $this;
    }

    protected function appendToJSBody($value)
    {
        $jsbody = $this->getRegion('jsbody');

        if (!$jsbody) {
            return $this;
        }

        $jsbody->setValue($jsbody->getValue() . $value);
        return $this;
    }

    /**
     * Add a link within the head of the page.
     *
     * @param string $href       URI to the resource
     * @param string $relation   Relation of this link element (alternate)
     * @param string $relType    The type of relation (rel)
     * @param array  $attributes Any additional attribute=>value combinations
     * @return self
     */
    public function addHeadLink($href, $relation, $relType = 'rel', array $attributes = array())
    {
        $attributes[$relType] = $relation;
        $attributes['href'] = $href;
        $element = static::generateElement('link', $attributes, false) . PHP_EOL;
        return $this->appendToHead($element);
    }

    /**
     * Add a (java)script to the page.
     *
     * @param string $url  URL to the script
     * @param string $type Type of script text/javascript
     * @return self
     */
    public function addScript($url, $type = '', $appendToHead = FALSE)
    {
        $attributes = [
            'src' => $url
        ];

        if ($type && $type !== 'text/javascript') {
            $attributes['type'] = $type;
        }

        $element = static::generateElement('script', $attributes) . PHP_EOL;

        if ($appendToHead === TRUE || static::VERSION == 4 || static::VERSION == 4.1) {
            return $this->appendToHead($element);
        }

        return $this->appendToJSBody($element);
    }

    /**
     * Adds a script declaration to the page.
     *
     * @param string $content The javascript you wish to add.
     * @param string $type    Type of script tag.
     * @return self
     */
    public function addScriptDeclaration($content, $type = '', $appendToHead = FALSE)
    {
        $attributes = [];

        if ($type && $type !== 'text/javascript') {
            $attributes['type'] = $type;
        }

        $element = static::generateElement('script', $attributes, $content) . PHP_EOL;

        if ($appendToHead === TRUE || static::VERSION == 4 || static::VERSION == 4.1) {
            return $this->appendToHead($element);
        }

        return $this->appendToJSBody($element);
    }

    /**
     * Add a style declaration to the head of the document.
     * <code>
     * $page->addStyleDeclaration('.course {font-size:1.5em}');
     * </code>
     *
     * @param string $content CSS content to add
     * @param string $type    type attribute for the style element
     * @return self
     */
    public function addStyleDeclaration($content, $type = '')
    {
        $attributes = [];

        if ($type && $type !== 'text/css') {
            $attributes['type'] = $type;
        }

        $element = static::generateElement('style', $attributes, $content) . PHP_EOL;
        return $this->appendToHead($element);
    }

    /**
     * Add a link to a stylesheet.
     *
     * @param string $url   Address of the stylesheet, absolute or relative
     * @param string $media Media target (screen/print/projector etc)
     * @return self
     */
    public function addStyleSheet($url, $media = '')
    {
        $attributes = [];

        if ($media && $media !== 'all') {
            $attributes['media'] = $media;
        }

        return $this->addHeadLink($url, 'stylesheet', 'rel', $attributes);
    }
}
