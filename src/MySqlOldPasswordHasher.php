<?php

namespace Dan142\LaravelHashingMySql;

use Illuminate\Contracts\Hashing\Hasher as HasherContract;

class MySqlOldPasswordHasher implements HasherContract
{
    public function info($hashedValue)
    {
        return password_get_info($hashedValue);
    }

    public function make($value, array $options = [])
    {
        $hex   = true;
        $nr    = 1345345333;
        $add   = 7;
        $nr2   = 0x12345671;
        $tmp   = null;
        $inlen = strlen($value);
        for ($i = 0; $i < $inlen; $i++) {
            $byte = substr($value, $i, 1);
            if ($byte == ' ' || $byte == "\t") {
                continue;
            }
            $tmp = ord($byte);
            $nr ^= ((($nr & 63) + $add) * $tmp) + (($nr << 8) & 0xFFFFFFFF);
            $nr2 += (($nr2 << 8) & 0xFFFFFFFF) ^ $nr;
            $add += $tmp;
        }
        $out_a  = $nr & ((1 << 31) - 1);
        $out_b  = $nr2 & ((1 << 31) - 1);
        $output = sprintf("%08x%08x", $out_a, $out_b);
        if ($hex) {
            return $output;
        } else {
            $bin = "";
            $len = strlen($hex);
            for ($i = 0; $i < $len; $i += 2) {
                $byte_hex  = substr($hex, $i, 2);
                $byte_dec  = hexdec($byte_hex);
                $byte_char = chr($byte_dec);
                $bin .= $byte_char;
            }
            return $bin;
        }
    }

    public function check($value, $hashedValue, array $options = [])
    {
        if (strlen($hashedValue) === 0) {
            return false;
        }
        return $this->make($value) === $hashedValue;
    }

    public function needsRehash($hashedValue, array $options = [])
    {
        return false;
    }
}
