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
     * @throws jmluang\ssr\Exception\DecodeException
     */
    public function decode()
    {
        $object = $this->sock->decode($this->uri);
        if (!isset($object->host)) {
            throw new DecodeException();
        }
        return $object;
    }

    /**
     * qrcode generate by others api, return the image url
     * 
     * @param int size
     * 
     * @return string
     */
    public function qrcode($size = 300)
    {
        $size = $size . "x" . $size;
        return "https://api.qrserver.com/v1/create-qr-code/?data=" . $this->origin . "&size=" . $size;
    }

    /**
     * replace spec char
     * 
     * @param string $uri
     * 
     * @return string
     * @throws jmluang\ssr\Exception\DecodeException
     */
    private function init($url)
    {
        // Check the url is ss or ssr
        if (!$this->isSs($url) && !$this->isSsr($url)) {
            throw new DecodeException("Unsupport type");
        }

        // Check whether the url is empty or not
        if (empty($this->uri)) {
            throw new DecodeException("Illegal url");
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
        preg_match("#^ss://(?<uri>.*)#", $url, $params);
        if (isset($params['uri'])) {
            $this->uri = $params['uri'];
            $this->sock = new Ss;
            return true;
        }
        return false;
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
        preg_match("#^ssr://(?<uri>.*)#", $url, $params);
        if (isset($params['uri'])) {
            $this->uri = $params['uri'];
            $this->sock = new Ssr;
            return true;
        }
        return false;
    }

}
