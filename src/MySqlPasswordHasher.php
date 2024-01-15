<?php

namespace Dan142\LaravelHashingMySql;

use Illuminate\Contracts\Hashing\Hasher as HasherContract;

class MySqlPasswordHasher implements HasherContract
{
    public function info($hashedValue)
    {
        return password_get_info($hashedValue);
    }

    public function make($value, array $options = [])
    {
        $hash = strtoupper(
            sha1(
                sha1($value, true)
            )
        );
        $hash = '*' . $hash;
        return $hash;
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
