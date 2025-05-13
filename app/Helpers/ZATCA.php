<?php

namespace App\Helpers;

class ZATCA
{
    public static function getLength($value)
    {
        return strlen($value);
    }

    public static function toHex($value)
    {
        return pack("H*", sprintf("%02X", $value));
    }

    public static function toString($tag, $value, $length)
    {
        $value = (string) $value;
        return self::toHex($tag) . self::toHex($length) . $value;
    }

    public static function getTLV($data)
    {
        $TLVS = '';
        for ($i = 0; $i < count($data); $i++) {
            $tag = $data[$i][0];
            $value = $data[$i][1];
            $length = self::getLength($value);
            $TLVS .= self::toString($tag, $value, $length);
        }
        return $TLVS;
    }

    public static function getCode($data = [])
    {
        $TLV = self::getTLV($data);
        $QR = base64_encode($TLV);
        return  $QR;
    }
}
