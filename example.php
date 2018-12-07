<?php
require 'vendor/autoload.php';

use jmluang\ssr\Decoder;
use jmluang\ssr\Exception\DecodeException;

$ssr = (new Decoder('ssr://MTI3LjAuMC4xOjEyMzQ6YXV0aF9hZXMxMjhfbWQ1OmFlcy0xMjgtY2ZiOnRsczEuMl90aWNrZXRfYXV0aDpZV0ZoWW1KaS8_b2Jmc3BhcmFtPVluSmxZV3QzWVRFeExtMXZaUSZyZW1hcmtzPTVyV0w2Sy1WNUxpdDVwYUg'))->decode();
print_r((array)$ssr);

try {
    $ss = (new Decoder('ss://'))->decode();
} catch (DecodeException $e) {
    echo $e->getMessage() . PHP_EOL;
}