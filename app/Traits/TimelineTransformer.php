<?php
namespace App\Traits;

use Illuminate\Pagination\LengthAwarePaginator;
use Request;

trait TimelineTransformer
{
    use Transformer;

    /**
     * sort By Latest Timeline
     * @param  [type] $timeline [description]
     * @return [type]           [description]
     */
    protected function sortByLatest($timeline)
    {
        $results = $this->transformCollection($timeline->all())
                        ->sortByDesc(function ($item) {
                            return $item['commented_at'];
                        })->values();

        return new LengthAwarePaginator(
                                            $results,
                                            $timeline->total(),
                                            $timeline->perPage(),
                                            Request::get('page', 1),
                                            ['path' => Request::path()]
                                        );
    }

    /**
     * [transform description]
     * @param  [type] $model [description]
     * @return [type]        [description]
     */
    public function transform($model)
    {
        return [
                    'id' => $model->id,
                    'permalink' => route('posts.show',[$model->user->employee_id, $model->id],false),
                    'user_id' => $model->user_id,
                    'comments_count' => $model->comments_count,
                    'likes_count' => $model->likes_count,
                    'message' => $model->message,
                    'commented_at' => $model->created_at->toDateTimeString(),
                    'user' => [
                            'id' => $model->user->id,
                            'email' => $model->user->email,
                            'employee_id' => $model->user->employee_id,
                            'image' => $model->user->image,
                            'name' => $model->user->name,
                        ]
            ];
    }
}
