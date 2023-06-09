

<?php

// 1. Global parameter settings
$appRsaPrivateKeyPem = "MIIEowIBAAKCAQEAlDy3zuoa/f6X7GnmxzHAuEn2zNAqCX0sAwyOzVtPlooHO3csG0yaOt5MAzOgZirgWZpnxnHvyq2Y9VIjTqAj3t/ZEafePQTwuaTP3+oyDNRxzn4FoRwwai+6q8AnanESdZyR+ZwMgNVRLAACChQlzIfi9G4/MnnofUEOg7kFGevK9K+svIqS6EUQ2ePpXXBsnp/YMBYAG4hCD/lEbZhRTlCoU2b6qauq+CDjTDtMBK26Y+pro/RezIcS9d2UCUzf7EBeFaiirYoz2jQjkDYg8E/qz7seTqeTHgJC1ih0ffhHfUKKpk6S04dIYWYMWVqDkaRAkR+HbxL6AkmY1JhEMwIDAQABAoIBAGclgLjHiRSnrMriPaTpZ7JUNRj61+VWZeORP2SBXvXfAX1NRTGRsde4iqfHqpqsxwNSP1eEPFiJRt+c0diJ8avJkt+IMUnAQEjM96BU85Kd2LrYUc5zMPUSVQ/hWwvjtfaEhcZr4P9cb2jwcHrW3h5dh3yRogPbc/yD4jeh7HzF1j/Oyt5WdBL2VSgTzz3aT+aES5KIo4eWsKiGwEksfUDpy87WTvzKu19lPpsrpVnS24XfxufchrXylMhW4SGzbP1rMJ7jZbHX5PG40bJsolaCfLHbpGBVGLA7Ly2QHbETFBJ5UmC+lPubHbKw3IyfGRK4GQh0sZy18OaglWySmVECgYEA3fLnwYalT9xecJ4NhRYFIb8Anf+Pxm3psqRHsTye9siozhmdWvGgKDnfVNDxHPnKtUHWEg+at0DeaGMoSI6qR5gOzYz7XOV3DK5HOKl6v/7XsP5CR+VUcyGbd2W4SBhhzk5RjShVM3iEM+xxYSlJbcI0auDSQVY6ghSU4/i+eC0CgYEAqvrE4jA9nAGAegvj6d3ZRJqX/wm7WpW/kWPQsXj1/oEUhSacOHbE94gf3NNHZXoPpGGHzHkr4z1q93cw+DZKLIoVwO9/uBJB+pPqpyLJUa204baonuzE1+W+uJ4azZiAIqHqSFWyBdNkwKTiFIFeG6wQO7jHu41Vjp3Et3rECd8CgYBK25p/E0K+ZL0VjrlQodSpRRqYL5H2gyvHLNFhXejfo14L5WfFPKmf56UDnlU0SKut5r6k6M5t8FsTKh50GmokK40SlvJQqrQ0erNa0Q6tou5sq9T/GsIY8sTUyGIXLuIOCyxGR8w0x/kO6jhzZNF3S4ESazF/B+5D4V02ZrcXIQKBgA1wPk9E2WLMn2t4ScaU4EHLIM0z15zsDi2AOePpDPSe8pzwhvDNLPgDo/V4SbFJIbeaztCcaX2n0yN2I8wugC/1/nW2nUQ7cyIdxCC01DvuOjxPXft3wpTxgscB7jtglBmkvkRHMAHTNqUJkJdp/5qPMItxH4m3NxVJgy+kn4njAoGBAMiW5KEYwMsEgo9cu2n8jOuyaiqxve0K19akG4PHywZTJNj0IN7M5RHiA6ZJCRh+PO9TPCpYw1VwZcEQ7tAvwCqkSfJ4ZoeuXOSuw0+sGkYr11eJpGS813KFb10xtIeWCLD/GYhDptNJohjH7qiv0vFL3hGs7TkJ9mj472qOAcrn";
$gatewayRsaPublicKeyPem = "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA2m4nkQKyQAxJc8VVsz/L6qVbtDWRTBolUK8Dwhi9wH6aygA6363PVNEPM8eRI5W19ssCyfdtNFy6DRAureoYV053ETPUefEA5bHDOQnjbb9PuNEfT651v8cqwEaTptaxj2zujsWI8Ad3R50EyQHsskQWms/gv2aB36XUM4vyOIk4P1f3dxtqigH0YROEYiuwFFqsyJuNSjJzNbCmfgqlQv/+pE/pOV9MIQe0CAdD26JF10QpSssEwKgvKvnXPUynVu09cjSEipev5cLJSApKSDZxrRjSFBXrh6nzg8JK05ehkI8wdsryRUneh0PGN0PgYLP/wjKiqlgTJaItxnb/JQIDAQAB";
$gatewayUrl = "https://gw.paycloud.world/api/entry";
$appId = "wz715fc0d10ee9d156";

// 2. Set parameters
    // Common parameters
$parameters["app_id"] = $appId;
$parameters["charset"] = "UTF-8";
$parameters["format"] = "JSON";
$parameters["sign_type"] = "RSA2";
$parameters["version"] = "1.0";
$parameters["timestamp"] = getMillisecond();
$parameters["method"] = "order.query";
    // API owned parameters
$parameters["merchant_no"] = "312100000164";
$parameters["merchant_order_no"] = "TEST_1685946062143";

// 3. Build a string to be signed
$stringToBeSigned = buildToBeSignString($parameters);
echo "StringToBeSigned : " . $stringToBeSigned;
echo "</br></br>";

// 4. Calculate signature
$sign = generateSign($stringToBeSigned, $appRsaPrivateKeyPem);
$parameters["sign"] = $sign;
echo "Sign : " . $sign;
echo "</br></br>";

// 5. Send HTTP request
$jsonString = json_encode($parameters);
echo "Request to gateway[" . $gatewayUrl . "] send data  -->> " . $jsonString;
echo "</br></br>";
$responseStr = json_post($gatewayUrl, $jsonString);
echo "Response from gateway[" . $gatewayUrl . "] receive data <<-- " . $responseStr;
echo "</br></br>";

// 6. Verify the signature of the response message
$respObject = json_decode($responseStr, true);
$respStringToBeSigned  = buildToBeSignString($respObject);
echo "RespStringToBeSigned  : " . $respStringToBeSigned;
echo "</br></br>";
$respSignature = $respObject["sign"];
$verified = verify($respStringToBeSigned, $respSignature, $gatewayRsaPublicKeyPem);

echo "SignVerifyResult  : " . $verified;
echo "</br></br>";

/**
 * Build a string to be signed
 * @param $params
 * @return string
 */
 function buildToBeSignString($params)
    {
        ksort($params);
        unset($params['sign']);

        $stringToBeSigned = "";
        $i = 0;
        foreach ($params as $k => $v) {
            if ("@" != substr($v, 0, 1)) {

                // Convert to target character set
                $v = characet($v, "UTF-8");

                if ($i == 0) {
                    $stringToBeSigned .= "$k" . "=" . "$v";
                } else {
                    $stringToBeSigned .= "&" . "$k" . "=" . "$v";
                }
                $i++;
            }
        }

        unset ($k, $v);
        return $stringToBeSigned;
    }

/**
 * Convert Character Set Encoding
 * @param $data
 * @param $targetCharset
 * @return string
 */
function characet($data, $targetCharset)
{
    if (!empty($data)) {
        $fileType = "UTF-8";
        if (strcasecmp($fileType, $targetCharset) != 0) {
            $data = mb_convert_encoding($data, $targetCharset, $fileType);
        }
    }
    return $data;
}

function generateSign($data, $priKey)
{
    $res = "-----BEGIN RSA PRIVATE KEY-----\n" .
        wordwrap($priKey, 64, "\n", true) .
        "\n-----END RSA PRIVATE KEY-----";

    ($res) or die('The private key format you are using is incorrect. Please check the RSA private key configuration');

    openssl_sign($data, $sign, $res, OPENSSL_ALGO_SHA256);

    $sign = base64_encode($sign);
    return $sign;
}

/**
 * PHP Post Json
 * @param $url request url
 * @param $data JSON string/array sent
 * @return array
 */
function json_post($url, $data = NULL)
{
    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    if(!$data){
        return 'data is null';
    }
    if(is_array($data))
    {
        $data = json_encode($data);
    }
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_HEADER, 0);
    curl_setopt($curl, CURLOPT_HTTPHEADER,array(
            'Content-Type: application/json; charset=utf-8',
            'Content-Length:' . strlen($data),
            'Cache-Control: no-cache',
            'Pragma: no-cache'
    ));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $res = curl_exec($curl);
    $errorno = curl_errno($curl);
    if ($errorno) {
        return $errorno;
    }
    curl_close($curl);
    return $res;
}

function getMillisecond() {
  list($t1, $t2) = explode(' ', microtime());
  return (float)sprintf('%.0f',(floatval($t1)+floatval($t2))*1000);
}

function verify($data, $sign, $pubKey)
{
    $res = "-----BEGIN PUBLIC KEY-----\n" .
        wordwrap($pubKey, 64, "\n", true) .
        "\n-----END PUBLIC KEY-----";

    ($res) or die('RSA public key error. Please check if the public key file format is correct');

    // Call the openssl built-in method for signature verification and return the bool value
    return (openssl_verify($data, base64_decode($sign), $res, OPENSSL_ALGO_SHA256) === 1) ? 'true' : 'false';
}

?>

