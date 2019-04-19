<?php
declare(strict_types=1);

namespace App\Auth;

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Hashing\Hasher as HasherContract;
use Illuminate\Contracts\Cache\Repository as CacheRepository;

/**
 * キャッシュ併用認証ドライバ
 *
 * \Illuminate\Auth\EloquentUserProvider はユーザ情報アクセス時に都度RDBアクセスが発生する。
 * パフォーマンス改善のためにキャッシュを併用したもの。
 * @package App\Auth
 */
class CacheUserProvider extends EloquentUserProvider
{
    protected $cache;
    protected $cacheKey = 'authentication:user:%s';
    protected $lifetime;

    public function __construct(
        HasherContract $hasher,
        string $model,
        CacheRepository $cache,
        int $lifetime = 120
    ) {
        parent::__construct($hasher, $model);
        $this->cache = $cache;
        $this->lifetime = $lifetime;
    }

    /**
     * キャッシュを挟んだIDからの検索
     * @param mixed $identifier
     * @return bool|\Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveById($identifier)
    {
        $cacheKey = sprintf($this->cacheKey, $identifier);
        if ($this->cache->has($cacheKey)) {
            return $this->cache->get($cacheKey);
        }
        $result = parent::retrieveById($identifier);
        if ($result === null) {
            return null;
        }
        $this->cache->add($cacheKey, $result, $this->lifetime);
        return $result;
    }

    /**
     * キャッシュを挟んだtokenからの検索
     * @param mixed $identifier
     * @param string $token
     * @return bool|\Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByToken($identifier, $token)
    {
        $model = $this->retrieveById($identifier);
        if ($model === null) {
            return null;
        }
        $rememberToken = $model->getRememberToken();
        return $rememberToken && hash_equals($rememberToken, $token) ? $model : null;
    }
}
