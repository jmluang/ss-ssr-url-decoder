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
        // method : password @ host : port
        $pattern = '/(?<method>.*):(?<password>.*)@(?<host>.*):(?<port>.*)/';
        preg_match($pattern, $uri, $param);

        // set object param
        $var = ["method", "password", "host", "port"]; 
        foreach ($var as $v) {
            $this->$v = $param[$v]; 
        }
        return $this;
    }

}