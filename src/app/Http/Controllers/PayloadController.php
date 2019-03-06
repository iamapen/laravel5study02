<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final class PayloadController
{

    /**
     * 文字列からレスポンスを作成する例
     * @return Response
     */
    public function fromString(): Response
    {
        // Facadeを使う場合
        $res = \Response::make('hello world', Response::HTTP_OK, ['content-type' => 'text/plain']);
        // ヘルパ関数を使う場合
        $res = response('hello world', Response::HTTP_OK, ['content-type' => 'text/plain']);

        return $res;
    }

    /**
     * Viewを使う例
     * @return Response
     */
    public function useView(): Response
    {
        // Facadeを使う場合
        $res = \Response::view('sample.file');
        // ヘルパ関数を使う場合
        $view = view('sample.file');
        $res = response($view, Response::HTTP_OK);
        return $res;
    }

    /**
     * JSONレスポンスの例
     * @return JsonResponse
     */
    public function json(): JsonResponse
    {
        // Facadeを使う場合
        $res = \Response::json(['status' => 'success']);
        // ヘルパ関数を使う場合
        $res = response()->json(['status' => 'success']);
        return $res;
    }
}
