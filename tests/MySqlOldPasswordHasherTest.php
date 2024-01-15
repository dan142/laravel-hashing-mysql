<?php

namespace Dan142\LaravelHashingMySql\Test;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;

class MySqlOldPasswordHasherTest extends TestCase
{
    /** @test */
    public function testMySqlOldPasswordDriver()
    {
        $this->assertEquals(Hash::driver('mysqloldpassword')->make("12345"), "2e782c85379a326e");
        $this->assertEquals(Hash::driver('mysqloldpassword')->make("test"), "378b243e220ca493");
    }

    public function testDefaultDriver()
    {
        Config::set('hashing.driver', 'mysqloldpassword');
        $this->assertEquals(Hash::make("12345"), "2e782c85379a326e");
        $this->assertEquals(Hash::make("test"), "378b243e220ca493");
    }
}