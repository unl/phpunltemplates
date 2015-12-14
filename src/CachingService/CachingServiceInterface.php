<?php
/**
 * An interface for a caching service.
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

interface CachingServiceInterface
{
    public function get($key);
    public function save($data, $key);
    public function clean($object = null);
}
