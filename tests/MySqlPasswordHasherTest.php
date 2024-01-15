<?php

namespace Dan142\LaravelHashingMySql\Test;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;

class MySqlPasswordHasherTest extends TestCase
{
    /** @test */
    public function testMySqlPasswordDriver()
    {
        $this->assertEquals(Hash::driver('mysqlpassword')->make("12345"), "*00A51F3F48415C7D4E8908980D443C29C69B60C9");
        $this->assertEquals(Hash::driver('mysqlpassword')->make("test"), "*94BDCEBE19083CE2A1F959FD02F964C7AF4CFC29");
    }

    public function testDefaultDriver()
    {
        Config::set('hashing.driver', 'mysqlpassword');
        $this->assertEquals(Hash::make("12345"), "*00A51F3F48415C7D4E8908980D443C29C69B60C9");
        $this->assertEquals(Hash::make("test"), "*94BDCEBE19083CE2A1F959FD02F964C7AF4CFC29");
    }
}