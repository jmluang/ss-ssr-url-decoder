<?php
namespace jmluang\ssr;

use jmluang\ssr\Interfaces\canDecode;
use jmluang\ssr\Traits\Util;

class Ssr implements canDecode
{
    use Util;

    /**
     * Decode the SSR uri
     * 
     * @param string $uri
     * 
     * @return Ss 
     */
    public function decode($uri)
    {
        // ssr://server:port:protocol:method:obfs:password_base64/?params_base64
        $pattern = '#(?<host>.*):(?<port>.*):(?<protocol>.*):(?<method>.*):(?<obfs>.*):(?<password_base64>.*)/\?(?<params_base64>.*)#';
        
        preg_match($pattern, $uri, $params);
        if (empty($params)) {
            return $this;
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
