<?php

namespace Lys\Until\Test;

use Lys\Until\Aes\CryptAES;
use PHPUnit\Framework\TestCase;

$file_load_path = __DIR__.'/../../../autoload.php';
if (file_exists($file_load_path)) {
    include $file_load_path;
} else {
    $vendor = __DIR__.'/../vendor/autoload.php';
    include $vendor;
}


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


}
