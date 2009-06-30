<?php
require_once 'UNL/Templates/CachingService.php';
class UNL_Templates_CachingService_CacheLite implements UNL_Templates_CachingService
{
    protected $cache;
    
    function __construct($options = array())
    {
        include_once 'Cache/Lite.php';
        $options = array_merge(array('lifeTime'=>3600), $options);
        $this->cache = new Cache_Lite($options);
    }
    
    function get($key)
    {
        return $this->cache->get($key, 'UNL_Templates');
    }
    
    function save($data, $key)
    {
        return $this->cache->save($data, $key, 'UNL_Templates');
    }
    
    function clean($object = null)
    {
        if (isset($object)) {
            if (is_object($object)
                && $object instanceof UNL_UCBCN_Cacheable) {
                $key = $object->getCacheKey();
                if ($key === false) {
                    // This is a non-cacheable object.
                    return true;
                }
            } else {
                $key = (string) $object;
            }
            if ($this->cache->get($key) !== false) {
                // Remove the cache for this individual object.
                return $this->cache->remove($key, 'UNL_Templates');
            }
        } else {
            return $this->cache->clean('UNL_Templates');
        }
        return false;
    }
    function __call($method, $params)
    {
        return $this->cache->$method($params);
    }

}
