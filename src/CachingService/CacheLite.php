<?php
/**
 * A Cache Service using Cache_Lite
 *
 * PHP version 5
 *
 * @category  Templates
 * @package   UNL_Templates
 * @author    Brett Bieber <brett.bieber@gmail.com>
 * @author    Ned Hummel <nhummel2@unl.edu>
 * @copyright 2015 Regents of the University of Nebraska
 * @license   http://wdn.unl.edu/software-license BSD License
 */

namespace UNL\Templates\CachingService;

use Cache_Lite;

class CacheLite implements CachingServiceInterface
{
    const CACHE_NAMESPACE = 'UNL_Templates';

    protected $cache;

    public function __construct($options = array())
    {
        $options = array_merge(['lifeTime' => 3600], $options);
        $this->cache = new Cache_Lite($options);
    }

    public function get($key)
    {
        return $this->cache->get($key, static::CACHE_NAMESPACE);
    }

    public function save($data, $key)
    {
        return $this->cache->save($data, $key, static::CACHE_NAMESPACE);
    }

    public function clean($object = null)
    {
        if ($object) {
            $key = (string) $object;

            if ($this->cache->get($key) !== false) {
                // Remove the cache for this individual object.
                return $this->cache->remove($key, static::CACHE_NAMESPACE);
            }

            return false;
        }

        return $this->cache->clean(static::CACHE_NAMESPACE);
    }

    public function __call($method, $params)
    {
        return $this->cache->$method($params);
    }
}
