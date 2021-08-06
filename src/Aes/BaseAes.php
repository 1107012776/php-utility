<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019/8/13
 * Time: 16:19
 */

namespace Lys\Until\Aes;


abstract class BaseAes
{
    protected $key = '';
    protected $hex_iv = '';

    abstract public function encrypt($encrypt);
    abstract public function decrypt($decrypt);
}