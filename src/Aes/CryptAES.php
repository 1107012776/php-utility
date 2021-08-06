<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019/8/13
 * Time: 16:19
 */

namespace Lys\Until\Aes;


class CryptAES extends BaseAes
{
    public function __construct($key, $iv)
    {
        $this->hex_iv = $this->makeIv($iv);
        $this->key = $this->makeIv($key);//因为openssl会截取16位
    }

    public function encrypt($input)
    {
        $data = openssl_encrypt($input, 'AES-128-CBC', $this->key, OPENSSL_RAW_DATA, $this->hex_iv);
        $data = base64_encode($data);
        return $data;
    }

    public function decrypt($input)
    {
        $decrypted = openssl_decrypt(base64_decode($input), 'AES-128-CBC', $this->key, OPENSSL_RAW_DATA, $this->hex_iv);
        return $decrypted;
    }

    /**把MD5的转成16位的数字
     * @param string $str
     * @return string
     */
    public function makeIv($str = '')
    {
        $length = strlen($str);
        if ($length < 16) {
            return false;
        } elseif ($length >= 16 && $length < 32) {
            $res = substr($str, 0, 16);
        } else {
            $res = substr($str, 0, 4) . substr($str, 8, 4) . substr($str, 16, 4) . substr($str, 24, 4);
        }
        return $res;
    }
}