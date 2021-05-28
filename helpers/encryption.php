<?php

function encryption ($string)
{
    $key = config('app.key');
    $ciphering = config('app.cipher');
    $iv = config('app.iv');

    $encryption = openssl_encrypt($string, $ciphering, $key, 0, $iv);

    return $encryption;
}

function decryption ($hash)
{
    $key = config('app.key');
    $ciphering = config('app.cipher');
    $iv = config('app.iv');

    $decryption = openssl_decrypt($hash, $ciphering, $key, 0, $iv);

    return $decryption ?: $hash;
}
