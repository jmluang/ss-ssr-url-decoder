<?php
namespace jmluang\ssr;

use jmluang\ssr\Traits\Util;
use jmluang\ssr\Exception\DecodeException;

class Decoder 
{
    use Util;

    /**
     * The origin Url
     */
    public $origin;

    /**
     * The base64 decode string
     */
    public $uri;

    /**
     * The Decode Object, must implement of jmluang\canDecode 
     */
    public $sock;

    public function __construct($url)
    {
        $this->origin = $url;
        $this->uri = $this->init($url); 
    }

    /**
     * return the decode result
     * 
     * @return Object jmluang\Ss|jmluang\Ssr
     */
    public function decode()
    {
        return $this->sock->decode($this->uri);
    }

    /**
     * qrcode generate by google api, return the url
     * 
     * @param int size
     * 
     * @return string
     */
    public function qrcode($size = 300)
    {
        $size = $size . "x" . $size;
        return "http://api.qrserver.com/v1/create-qr-code/?data=" . $this->origin . "&size=" . $size;
    }

    /**
     * replace spec char
     * 
     * @param string $uri
     * 
     * @return string
     */
    private function init($url)
    {
        // Check the url is ss or ssr
        if (!$this->isSs($url) && !$this->isSsr($url)) {
            throw new DecodeException("Unsupport type");
        }

        return $this->base64Decode($this->uri);
    }

    /**
     * check is ss
     * 
     * @param string $uri
     * 
     * @return int
     */
    private function isSs($url)
    {
        $result = preg_match("#^ss://(?<uri>.*)#", $url, $params);
        $this->uri = $params['uri'];
        $this->sock = new Ss;
        return $result;
    }

    /**
     * check is ssr
     * 
     * @param string $uri
     * 
     * @return int;
     */
    private function isSsr($url)
    {
        $result = preg_match("#^ssr://(?<uri>.*)#", $url, $params);
        $this->uri = $params['uri'];
        $this->sock = new Ssr;
        return $result;
    }

}
