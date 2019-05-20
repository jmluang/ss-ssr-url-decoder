<?php
namespace jmluang\ssr;

use jmluang\ssr\Exception\DecodeFailureException;
use jmluang\ssr\Interfaces\canDecode;
use jmluang\ssr\Traits\Util;

class Ss implements canDecode
{
    use Util;

    /**
     * Check if the url can decode by the use class
     * 
     * @param string $url
     * 
     * @return boolean
     */
    public static function check(string $url) : bool
    {
        preg_match("#^ss://(?<uri>.*)#", $url, $params);
        if (isset($params['uri'])) {
            return true;
        }
        return false;
    }

    /**
     * Decode the SS url
     * 
     * @param string $url
     * 
     * @throws jmluang\ssr\Exception\DecodeFailureException
     * @return Ss
     */
    public function decode(string $url)
    {
        $uri = $this->base64Decode(substr($url, strlen('ss://')));

        //ss://method:password@host:port
        $pattern = '/(?<method>.*):(?<password>.*)@(?<host>.*):(?<port>.*)/';
        preg_match($pattern, $uri, $params);
        if (empty($params)) {
            throw new DecodeFailureException('can not decode this url');
        }

        // set object param
        $var = ["method", "password", "host", "port"]; 
        foreach ($var as $v) {
            $this->$v = $params[$v]; 
        }
        return $this;
    }

}