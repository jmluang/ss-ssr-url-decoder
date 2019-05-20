<?php
namespace jmluang\ssr\Interfaces;

interface canDecode 
{
    /**
     * Decode the url
     * 
     * @param string $uri
     * 
     * @return Object
     */
    public function decode(string $url);

    /**
     * Check if the url can decode by the use class
     * 
     * @param string $url
     * 
     * @return boolean
     */
    public static function check(string $url) : bool;
}