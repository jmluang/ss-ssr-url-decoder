# ss-ssr-url-decoder
Ss url or Ssr url decode and generate QR code.

# Install
`composer require jmluang/ssr`

# Useage
see [example.php](https://github.com/jmluang/ss-ssr-url-decoder/blob/master/example.php) file for more details

If you want to generate Qrcode for the url, use `qrcode()` function.

```
$obj = new Decoder('ssr://...');
echo $obj->qrcode();
```

Qrcode Generate By [QR Code Generator](http://goqr.me/api/doc/create-qr-code/)

# LICENSE
MIT
