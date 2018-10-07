<?php
namespace jmluang\ssr\Traits;

trait Util
{
    /**
     * replace str and return base64 decode
     * 
     * @param string $str
     * 
     * @return string
     */
    public function base64Decode($str)
    {
        // if has "_" and "-", replace it first
        $str = str_replace("-", "+", $str);
        $str = str_replace("_", "/", $str);

        // base64 decode
        return base64_decode($str, true);
    }
}