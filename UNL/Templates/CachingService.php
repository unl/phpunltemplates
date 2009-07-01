<?php
interface UNL_Templates_CachingService
{
    public function get($key);
    public function save($data, $key);
    public function clean($object = null);
}