<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use jmluang\ssr\Decoder;
use jmluang\ssr\Exception\DecodeException;
use phpDocumentor\Reflection\Types\Void_;

final class DecoderTest extends TestCase
{
    public function testCanNotDecodeEmptyUrl() : void
    {
        $this->expectException(DecodeException::class);
        (new Decoder(''))->decode();
    }

    public function testCanNotDecodeIllegalUrl() : Void
    {
        $this->expectException(DecodeException::class);
        (new Decoder('select * from users'))->decode(); 
    }

    public function testCanNotDecodeIllegalSsUrl() : void
    {
        $this->expectException(DecodeException::class);
        (new Decoder('ss://;test'))->decode(); 
    }

    public function testCanNotDecodeIllegalEmptySsUrl() : void
    {
        $this->expectException(DecodeException::class);
        (new Decoder('ss://'))->decode(); 
    }

    public function testCanNotDecodeIllegalSsrUrl() : void
    {
        $this->expectException(DecodeException::class);
        (new Decoder('ssr://;test'))->decode(); 
    }

    public function testCanNotDecodeIllegalEmptySsrUrl() : void
    {
        $this->expectException(DecodeException::class);
        (new Decoder('ssr://'))->decode(); 
    }

    public function testCanDecodeSs() : void
    {
        $ss_uri =  "ss://YmYtY2ZiOnRlc3RAMTkyLjE2OC4xMDAuMTo4ODg4Cg";
        $ss = (new Decoder($ss_uri))->decode();
        $this->assertEquals(
            'bf-cfb',
            $ss->method
        );
        $this->assertEquals(
            'test',
            $ss->password
        );
        $this->assertEquals(
            '192.168.100.1',
            $ss->host
        );
        $this->assertEquals(
            '8888',
            $ss->port
        );
    }

    public function testCanDecodeSsr() : void
    {
        $ssr_uri = "ssr://MTI3LjAuMC4xOjEyMzQ6YXV0aF9hZXMxMjhfbWQ1OmFlcy0xMjgtY2ZiOnRsczEuMl90aWNrZXRfYXV0aDpZV0ZoWW1KaS8_b2Jmc3BhcmFtPVluSmxZV3QzWVRFeExtMXZaUSZyZW1hcmtzPTVyV0w2Sy1WNUxpdDVwYUg";
        $ssr = (new Decoder($ssr_uri))->decode();
        $this->assertEquals(
            '127.0.0.1',
            $ssr->host
        );
        $this->assertEquals(
            'aaabbb',
            $ssr->password
        );
        $this->assertEquals(
            '1234',
            $ssr->port
        );
        $this->assertEquals(
            'aes-128-cfb',
            $ssr->method
        );
        $this->assertEquals(
            'auth_aes128_md5',
            $ssr->protocol
        );
        $this->assertEquals(
            'tls1.2_ticket_auth',
            $ssr->obfs
        );
    }
}