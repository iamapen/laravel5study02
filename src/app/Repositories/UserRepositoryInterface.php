<?php
declare(strict_types=1);

namespace App\Repositories;

interface UserRepositoryInterface
{
    public function find(int $id): array;
}