<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Traits\Timeline;
use App\Traits\TimelineTransformer;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class TimelineController extends Controller
{
    use Timeline, TimelineTransformer;

    /**
     * Timeline for current user
     * @param  User    $employee [description]
     * @param  Request $request  [description]
     * @return JSON
     */
    public function index(User $employee)
    {
        $timeline = $this->sortByLatest( $this->getTimelineFor($employee)->paginate() );

        return response()->json($timeline);
    }
}
