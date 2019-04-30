<?php
/**
 * User: may
 * Date: 2019/4/28
 * Time: 下午5:00
 * 非对称加密
 */
namespace app\common\common;

class Rsa {

    /**
     * 获取私钥
     * @return bool|resource
     */
    public function getPrivateKey()
    {
        $abs_path = dirname(__FILE__) . '/cert/rsa_private.pem';
        $content = file_get_contents($abs_path);
        return $content;
    }

    /**
     * 获取公钥
     * @return bool|resource
     */
    public function getPublicKey()
    {
        $abs_path = dirname(__FILE__) . '/cert/rsa_public_key.pem';
        $content = file_get_contents($abs_path);
        return $content;
    }

    /**
     * 私钥加密
     * @param string $data
     * @return null|string
     */
    public function privEncrypt($data = '')
    {
        if (!is_string($data)) {
            return null;
        }
        return openssl_private_encrypt($data,$encrypted,$this->getPrivateKey()) ? base64_encode($encrypted) : null;
    }

    /**
     * 公钥加密
     * @param string $data
     * @return null|string
     */
    public function publicEncrypt($data = '')
    {
        if (!is_string($data)) {
            return null;
        }
        return openssl_public_encrypt($data,$encrypted,$this->getPublicKey()) ? base64_encode($encrypted) : null;
    }

    /**
     * 私钥解密
     * @param string $encrypted
     * @return null
     */
    public  function privDecrypt($encrypted = '')
    {
        if (!is_string($encrypted)) {
            return null;
        }
        return (openssl_private_decrypt(base64_decode($encrypted), $decrypted, $this->getPrivateKey())) ? $decrypted : null;
    }

    /**
     * 公钥解密
     * @param string $encrypted
     * @return null
     */
    public  function publicDecrypt($encrypted = '')
    {
        if (!is_string($encrypted)) {
            return null;
        }
        return (openssl_public_decrypt(base64_decode($encrypted), $decrypted, $this->getPublicKey())) ? $decrypted : null;
    }

}