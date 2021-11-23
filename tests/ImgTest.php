<?php

namespace Lys\Until\Test;

use Lys\Until\Img\ImgQuality;

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
class ImgTest extends TestCase
{


    /**
     * php vendor/bin/phpunit tests/DemoTest.php --filter testResize
     * @throws
     */
    public function testResize()
    {
        $quality = new ImgQuality('./5.39M.png','./'.uniqid(date('YmdHis')).'.jpg');
        $res = $quality->toJpg(90,1024*1024);
        var_dump($res,$quality->getErrorMsg());
    }

    /**
     * php vendor/bin/phpunit tests/DemoTest.php --filter testResize1
     * @throws
     */
    public function testResize1()
    {
        $quality = new ImgQuality('./5.39M.png','./'.uniqid(date('YmdHis')).'.jpg',10);
        $res = $quality->toJpg(90,1024*1024);
        var_dump($res,$quality->getErrorMsg());
    }

    /**
     * php vendor/bin/phpunit tests/DemoTest.php --filter testResize3
     * @throws
     */
    public function testResize3()
    {

        var_dump(filesize('./20211123190206619cca2e54d2c.jpg')/1024/1024);
    }

}
