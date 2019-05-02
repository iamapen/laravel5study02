<?php
declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Auth\AuthManager;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Http\Response;

final class EditAction extends Controller
{
    private $authManager;
    private $gate;

    public function __construct(
        AuthManager $authManager,
        Gate $gate
    ) {
        $this->authManager = $authManager;
        $this->gate = $gate;
    }

    public function __invoke(string $id)
    {
        $class = new \stdClass();
        $class->id = $id;

        // Illuminate\Foundation\Auth\Access\AuthorizesRequests trait を使う例
        $this->authorizeForUser(
            $this->authManager->guard()->user(),
            'edit',
            $class
        );
        return new Response('認可OK。編集可能な表示画面。');
    }
}
