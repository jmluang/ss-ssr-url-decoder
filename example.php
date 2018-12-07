<?php
require 'vendor/autoload.php';

use jmluang\ssr\Decoder;

$ssr = (new Decoder('ssr://MTI3LjAuMC4xOjEyMzQ6YXV0aF9hZXMxMjhfbWQ1OmFlcy0xMjgtY2ZiOnRsczEuMl90aWNrZXRfYXV0aDpZV0ZoWW1KaS8_b2Jmc3BhcmFtPVluSmxZV3QzWVRFeExtMXZaUSZyZW1hcmtzPTVyV0w2Sy1WNUxpdDVwYUg'))->decode();
print_r((array)$ssr);

$ss = (new Decoder('ss://YmYtY2ZiOnRlc3RAMTkyLjE2OC4xMDAuMTo4ODg4Cg'))->decode();
print_r((array)$ss);