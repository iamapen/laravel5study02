<?php
declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Auth\AuthManager;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Http\Response;

final class RetrieveAction extends Controller
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
        if ($this->gate->allows('user-access', $id)) {
            // または \Gate::allows('user-access', $id)
            return new Response('認可OK。編集可能な表示画面。');
        } else {
            return new Response('認可NG。制限された表示画面。');
        }
    }
}
