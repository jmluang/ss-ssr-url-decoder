<?php
namespace jmluang\ssr;

use jmluang\ssr\Exception\DecodeException;
use jmluang\ssr\Interfaces\canDecode;

class Decoder 
{
    /**
     * The url
     */
    public $origin;

    public function __construct($url)
    {
        $this->origin = $url;
    }

    /**
     * return the decode result
     * 
     * @return Object jmluang\Ss|jmluang\Ssr
     * @throws jmluang\ssr\Exception\DecodeException
     */
    public function decode()
    {
        $handler = $this->getHandler($this->origin);
        if (!($handler instanceof canDecode)) {
            throw new DecodeException('not support type');
        }

        return $handler->decode($this->origin);
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
     * Get class by url type
     * 
     * @param string $url
     * 
     * @return null|jmluang\ssr\Interfaces\canDecode
     */
    private function getHandler(string $url)
    {
        if (Ss::check($url)) {
            return new Ss;
        }

        if (Ssr::check($url)) {
            return new Ssr;
        }

        return null;
    }
}
