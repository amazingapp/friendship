@foreach ($posts->sortByDesc('created_at') as $post)
  <div class="panel panel-default">
            <div class="user-post panel-body">
                          <div class="timeline-profile">
                               <img src="/images/40.png" class="pull-left" />
                                 <h5 class="h5bold">
                                     <a href="{{route('friends.show', $post->user->employee_id)}}">{!! $post->user->name !!} </a>
                                 </h5>
                               <small class="text-muted">
                                  <span class="glyphicon glyphicon-time"></span>&nbsp;
                                    @if( Carbon\Carbon::now() < $post->created_at->addDay() )
                                        <abbr title="{{  $post->created_at->format('l, F j, Y h:i A')}}">
                                              <span class="timestampContent">{{ $post->created_at->diffForHumans() }}</span>
                                          </abbr>
                                        @else
                                          <abbr title="{{  $post->created_at->format('l, F j, Y h:i A')}}">
                                            <span class="timestampContent">{{ $post->created_at->format('F j') }}</span>
                                        </abbr>
                                    @endif
                                </small>
                               <div class="clearfix"></div>
                          </div>
                          <div class="user-post-status">
                              {!! $post->message !!}
                          </div>
                          @include('users.partials.user-comments')
            </div>
  </div>
@endforeach