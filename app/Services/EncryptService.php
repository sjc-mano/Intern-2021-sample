<?php

namespace App\Services;

class EncryptService
{
    private $encryptMethod;
    private $secretKey;
    private $secretIV;

    public function __construct()
    {
        $this->encryptMethod = config('encrypt.encrypt_method');
        $this->secretKey = hash('sha256', config('encrypt.secret_key'));
        $this->secretIV = substr(
            hash('sha256', config('encrypt.secret_iv')),
            0,
            16
        );
    }

    // 暗号化
    public function encrypt($string)
    {
        $output = openssl_encrypt(
            $string,
            $this->encryptMethod,
            $this->secretKey,
            0,
            $this->secretIV
        );

        return base64_encode($output);
    }

    // 複合
    public function decrypt($string)
    {
        return openssl_decrypt(
            base64_decode($string),
            $this->encryptMethod,
            $this->secretKey,
            0,
            $this->secretIV
        );
    }
}