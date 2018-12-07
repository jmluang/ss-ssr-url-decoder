<?php
namespace jmluang\ssr;
use jmluang\ssr\Interfaces\canDecode;

class Ss implements canDecode
{
    /**
     * Decode the SS uri
     * 
     * @param string $uri
     * 
     * @return Ss 
     */
    public function decode($uri)
    {
        //ss://method:password@host:port
        $pattern = '/(?<method>.*):(?<password>.*)@(?<host>.*):(?<port>.*)/';
        preg_match($pattern, $uri, $params);
        if (empty($params)) {
            return $this;
        }

        // set object param
        $var = ["method", "password", "host", "port"]; 
        foreach ($var as $v) {
            $this->$v = $params[$v]; 
        }
        return $this;
    }

}