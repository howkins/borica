<?php

namespace Howkins\Borica;

use Howkins\Borica\Constants\Mac;
use Howkins\Borica\Constants\Url;

class Borica
{
    private $privateKey, $privateKeyPassword, $certificate, $isSandbox = false;

    public function setPrivateKey(string $privateKey)
    {
        $this->privateKey = $privateKey;
        return $this;
    }

    public function setPrivateKeyPassword(string $privateKeyPassword)
    {
        $this->privateKeyPassword = $privateKeyPassword;
        return $this;
    }

    public function setCertificate(string $certificate)
    {
        $this->certificate = $certificate;
        return $this;
    }

    public function setSandbox(bool $sandbox)
    {
        $this->isSandbox = $sandbox;
    }

    public static function generateMac(array $data, bool $isResponse, bool $is_mac_extended = true)
    {
        if ($is_mac_extended == true) {
            return self::generateMacExtended($data, $isResponse);
        }

        return self::generateMacCommon($data, $isResponse);
    }

    public static function generateMacExtended(array $data, bool $isResponse)
    {
        $macFields = $isResponse ? Mac::EXTENDED_RESPONSE_FIELDS : MAC::EXTENDED_REQUEST_FIELDS;

        $message = '';

        foreach ($macFields[$data['TRTYPE']] as $field) {
            $value = isset($data[$field]) ? $data[$field] : null;

            if ($isResponse && mb_strlen($value) == 0) {
                $message .= '-';
            } else {
                $message .= mb_strlen($value) . $value;
            }
        }

        return $message;
    }

    public static function generateMacCommon(array $data, bool $isResponse)
    {
        $message = '';
        if(!isset($data['TRTYPE'])){
            return $message;
        }
        $macFields = $isResponse ? Mac::COMMON_RESPONSE_FIELDS : Mac::COMMON_REQUEST_FIELDS;
        
        foreach ($macFields[$data['TRTYPE']] as $field) {
            $message .= mb_strlen($data[$field]) . $data[$field];
        }

        return $message;
    }

    public function getUrl()
    {
        if ($this->isSandbox) {
            return Url::DEVELOPMENT;
        }
        return Url::PRODUCTION;
    }

    public function sign(string $data)
    {
        $privateKey = openssl_pkey_get_private($this->privateKey, $this->privateKeyPassword);

        if (!$privateKey) {
            throw new \Exception(openssl_error_string());
        }

        if (!openssl_sign($data, $signature, $privateKey, OPENSSL_ALGO_SHA256)) {
            throw new \Exception(openssl_error_string());
        }

        openssl_free_key($privateKey);

        return strtoupper(bin2hex($signature));
    }

    public function verifySignature(string $data, string $signature)
    {
        $publicKey = openssl_pkey_get_public($this->certificate);
        if (!$publicKey) {
            throw new \Exception(openssl_error_string());
        }

        $result = openssl_verify($data, hex2bin($signature), $publicKey, OPENSSL_ALGO_SHA256);

        openssl_free_key($publicKey);

        if ($result == 0) {
            return false;
        }

        return true;
    }
}
