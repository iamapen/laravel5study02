<?php
namespace App;

use phpseclib\Crypt\Blowfish;
use Illuminate\Contracts\Encryption\Encrypter as EncrypterContract;

/**
 * phpseclib による Blowfish のencrypter
 * @package App
 */
class BlowfishEncrypter implements EncrypterContract {
    /** @var Blowfish */
    protected $encrypter;

    public function __construct(string $key)
    {
        $this->encrypter = new Blowfish();
        $this->encrypter->setKey($key);
    }

    /**
     * @param string $value
     * @param bool $serialize
     * @return string
     */
    public function encrypt($value, $serialize = true)
    {
        return $this->encrypter->encrypt($value);
    }

    /**
     * @param string $payload
     * @param bool $unserialize
     * @return string
     */
    public function decrypt($payload, $unserialize = true)
    {
        return $this->encrypter->decrypt($payload);
    }
}
