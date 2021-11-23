<?php

namespace Lys\Until\Test;

use Lys\Until\Aes\CryptAES;
use Lys\Until\SnowFlake\SnowFlake;
use PHPUnit\Framework\TestCase;

$file_load_path = __DIR__.'/../../../autoload.php';
if (file_exists($file_load_path)) {
    include $file_load_path;
} else {
    $vendor = __DIR__.'/../vendor/autoload.php';
    include $vendor;
}
ini_set('date.timezone', 'Asia/Shanghai');

/**
 * @method assertEquals($a, $b)
 */
class DemoTest extends TestCase
{

    /**
     * php vendor/bin/phpunit tests/DemoTest.php --filter testEncryptDecrypt
     * @throws
     */
    public function testEncryptDecrypt()
    {
        $key = md5('123456');
        $iv = md5('123');
        $aes = new CryptAES($key,$iv);
        $d = $aes->encrypt('12cssadasdsad');
        $d = $aes->decrypt($d);
        var_dump($d);
    }

    /**
     * php vendor/bin/phpunit tests/DemoTest.php --filter testSnowFlake
     * @throws
     */
    public function testSnowFlake()
    {
        var_dump(SnowFlake::make(1,1));//分布式id
    }


}
