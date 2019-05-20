<?php
namespace jmluang\ssr;

use jmluang\ssr\Exception\DecodeFailureException;
use jmluang\ssr\Interfaces\canDecode;
use jmluang\ssr\Traits\Util;

class Ssr implements canDecode
{
    use Util;

    /**
     * Check if the url can decode by the use class
     * 
     * @param string $url
     * 
     * @return boolean
     */
    public static function check(string $url): bool
    {
        preg_match("#^ssr://(?<uri>.*)#", $url, $params);
        if (isset($params['uri'])) {
            return true;
        }
        return false;
    }

    /**
     * Decode the SSR uri
     * 
     * @param string $uri
     * 
     * @throws jmluang\ssr\Exception\DecodeFailureException
     * @return Ss 
     */
    public function decode(string $url)
    {
        $uri = $this->base64Decode(substr($url, strlen('ssr://')));

        // ssr://server:port:protocol:method:obfs:password_base64/?params_base64
        $pattern = '#(?<host>.*):(?<port>.*):(?<protocol>.*):(?<method>.*):(?<obfs>.*):(?<password_base64>.*)/\?(?<params_base64>.*)#';
        
        preg_match($pattern, $uri, $params);
        if (empty($params)) {
            throw new DecodeFailureException('can not decode this url');
        }
        
        // set object param
        $keys = ["method", "host", "port", "protocol", "obfs"]; 
        foreach ($keys as $key) {
            $this->$key = $params[$key]; 
        }

        // base64 decode password
        $this->password = $this->base64Decode($params['password_base64']);
        
        // base64 decode params
        $params = explode("&", $params['params_base64']);
        foreach($params as $value) {
            $tmp = explode("=", $value);
            $this->params[$tmp[0]] = $this->base64Decode($tmp[1], true);
        }

        return $this;
    }

}
