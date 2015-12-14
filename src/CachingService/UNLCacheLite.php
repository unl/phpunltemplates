<?php
/**
 * A Cache Service using UNL_Cache_Lite
 *
 * PHP version 5
 *
 * @category  Templates
 * @package   UNL_Templates
 * @author    Brett Bieber <brett.bieber@gmail.com>
 * @author    Ned Hummel <nhummel2@unl.edu>
 * @copyright 2015Regents of the University of Nebraska
 * @license   http://wdn.unl.edu/software-license BSD License
 */

namespace UNL\Templates\CachingService;

use UNL_Cache_Lite;

class UNLCacheLite extends CacheLite
{
    public function __construct($options = array())
    {
        $options = array_merge(['lifeTime' => 3600], $options);
        $this->cache = new UNL_Cache_Lite($options);
    }
}
