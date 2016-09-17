<hr>
<div class="timeline-profile">
    <div class="like-comments-section">
              <span class="glyphicon glyphicon-thumbs-up"></span> <a class="btn-likes-comments" href="#">Like</a> &nbsp;&nbsp;
              @if( $post->likes_count > 0 )
                <span><a href="javascript:void();"> {{ $post->likes_count . ' ' .str_plural('like', $post->likes_count) }}</a></span>
              @endif
    </div>
    <post-status-comments post-status-comments-data='{ "user_id" : "{!! $user->id !!}", "post_id" : "{!! $post->id !!}"}'></post-status-comments>
</div>