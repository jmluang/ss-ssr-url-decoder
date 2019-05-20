<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use jmluang\ssr\Ss;
use jmluang\ssr\Ssr;

final class Chekc extends TestCase
{
    public function testSsCheck() : void
    {
        $this->assertEquals(false, Ss::check(""));
        $this->assertEquals(false, Ss::check("ss:/123"));
        $this->assertEquals(true,  Ss::check("ss://123"));
    }

    public function testSsrCheck() : void
    {
        $this->assertEquals(false, Ssr::check(""));
        $this->assertEquals(false, Ssr::check("ssr:/123"));
        $this->assertEquals(true,  Ssr::check("ssr://123"));
    }
}