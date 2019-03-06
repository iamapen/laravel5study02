<?php
declare(strict_types=1);

namespace App\Http\Apis;

use App\Http\Resources\ArticleResource;
use Illuminate\Http\Request;

class ArticlePayloadAction {

    /**
     * HAL(Hypertext Apllication Language) で返す
     *
     * ArticleResource
     *  |- UserResource
     *  |- CommentResourceCollection
     *  |   |- CommentResource *
     * @param Request $req
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $req)
    {
        $resource = new ArticleResource([
            'id' => 1,
            'title' => 'Laravel REST API',
            'comments' => [
                [
                    'id' => 2134,
                    'body' => 'awesome!',
                    'user_id' => 133345,
                    'user_name' => 'Application Developer',
                ],
            ],
            'user_id' => 13255,
            'user_name' => 'User1',
        ]);

        return $resource->response($req)
            ->header('content-type', 'application/hal+json');
    }
}
