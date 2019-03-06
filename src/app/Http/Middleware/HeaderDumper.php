<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Psr\Log\LoggerInterface;

/**
 * リクエスト/レスポンスヘッダをログに記録するミドルウェア
 * @package App\Http\Middleware
 */
class HeaderDumper
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request instanceof Request) {
            // loggerを触る場合
            $this->logger->info('request', [
                'header' => (string)$request->headers,
            ]);
            // ヘルパ関数を使う場合
            //info('request', ['header' => (string)$request->headers]);
        }

        $response = $next($request);
        if ($response instanceof Response) {
            $this->logger->info('response', [
                'header' => (string)$response->headers,
            ]);
        }

        return $response;
    }
}
