<?php
declare(strict_types=1);

namespace App\Entity;

use Illuminate\Contracts\Auth\Authenticatable;

/**
 * DBから取得したレコードを認証ユーザとして扱うためのクラス
 * @package App\Entity
 */
class User implements Authenticatable
{
    private $id;
    private $apiToken;
    private $name;
    private $email;
    private $password;

    public function __construct(
        int $id,
        string $apiToken,
        string $name,
        string $email,
        string $password = ''
    ) {
        $this->id = $id;
        $this->apiToken = $apiToken;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getAuthIdentifierName()
    {
        return 'user_id';
    }

    public function getAuthIdentifier(): int
    {
        return $this->id;
    }

    public function getAuthPassword(): string
    {
        return $this->password;
    }

    public function getRememberToken(): string
    {
        // APIでは利用しない
        return '';
    }

    public function setRememberToken($value)
    {
        // do nothing
        // APIでは利用しない
    }

    public function getRememberTokenName(): string
    {
        // APIでは利用しない
        return '';
    }
}
