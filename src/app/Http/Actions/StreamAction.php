<?php
declare(strict_types=1);

namespace App\Http\Actions;

use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

final class StreamAction
{
    /**
     * SSE(Server-Sent Events) の例
     *
     * ncでレスポンスを確認できる
     * `echo -e "GET /sse HTTP/1.1\nHost: localhost\n\n" | nc localhost 80`
     * @return StreamedResponse
     */
    public function __invoke(): StreamedResponse
    {
        return response()->stream(
            function () {
                while (true) {
                    echo 'data: ' . rand(1, 100) . "\n\n";
                    ob_flush();
                    flush();
                    usleep(200000);
                }
            },
            Response::HTTP_OK,
            [
                'content-type' => 'text/event-stream',
                'X-Accel-Buffering' => 'no',
                'Cache-Control' => 'no-cache',
            ]
        );
    }
}
