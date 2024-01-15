# laravel-hashing-mysql
Laravel MySQL Hasher

Adds support for the password hashing algorithms used by MySQL's now-deprecated PASSWORD() and OLD_PASSWORD() functions to the Laravel Hasher. This is intended to assist in migration from these to more modern and secure algorithms.

## Installation
Add the package with composer.
```
composer require dan142/laravel-hashing-mysql
```

### Using as the default driver
Edit config/hashing.php and change the driver to either `mysqlpassword` or `mysqloldpassword`, depending on which you need.
```
'driver' => 'mysqlpassword',
```

### Using independently of the default driver
You can specify the driver you'd like to use when using the Hash facade like so:
`Hash::driver('mysqlpassword')->make("hash")`
`Hash::driver('mysqloldpassword')->make("hash")`