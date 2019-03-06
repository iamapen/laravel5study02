<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

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

    /**
     * JSONPレスポンス
     * @return JsonResponse
     */
    public function jsonp(): JsonResponse
    {
        // Facadeを使う場合
        $res = \Response::jsonp('funcName', ['status' => 'success']);
        // ヘルパ関数を使う場合
        $res = response()->jsonp('funcName', ['status' => 'success']);
        return $res;
    }

    /**
     * 独自メディアタイプの例
     * @return JsonResponse
     */
    public function orgMediaType(): JsonResponse
    {
        $res = response()->json(
            ['status' => 'success'],
            Response::HTTP_OK,
            ['content-type' => 'application/vnd.laravel-api.json']
        );
        return $res;
    }

    /**
     * ダウンロード
     * @return BinaryFileResponse
     */
    public function download(): BinaryFileResponse
    {
        $filepath = __FILE__;

        $res = \Response::download($filepath, 'controller.php', ['content-type' => 'text/plain']);
        // ヘルパ関数を使う場合
        $res = response()->download($filepath, 'controller.php', ['content-type' => 'text/plain']);
        return $res;
    }

    /**
     * ダウンロード
     * @param Request $req
     * @return RedirectResponse
     */
    public function redirect(Request $req): RedirectResponse
    {
        // 下記はすべて同じ結果が得られる
        $res = \Response::redirectTo('/');
        $res = response()->redirectTo('/');
        $res = redirect('/');

        // redirect時に様々な動作を行う例
        // sessionにflashとして詰められる
        $res = redirect('/')
            ->withInput($req->all())
            ->with('error', 'validation error.');
        return $res;
    }
}
