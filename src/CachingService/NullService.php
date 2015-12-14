<?php
/**
 * A Null cache service that can be used for testing
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

class NullService implements CachingServiceInterface
{

    public function clean($object = null)
    {
        return true;
    }

    public function save($data, $key)
    {
        return true;
    }

    public function get($key)
    {
        return false;
    }
}
