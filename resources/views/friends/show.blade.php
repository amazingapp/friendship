@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">User Profile</div>
                <div class="panel-body">
                @include('errors.messages')
                @include('flash.messages')
                <form action="/friends/requests" method="post">
                    {{csrf_field()}}
                    <input type="hidden" name="employee_id" value="{{$employee->employee_id}}">
                    <button type="submit">Add as friend</button>
                </form>
                <div class="posts">
                    @foreach ($posts as $post)
                        <h3>{{ $post->user->name }} </h3>
                            <p>
                                {{ $post->message }}
                            </p>
                            <p>
                                @if( $post->comments->count())


                                @endif
                            </p>
                            <p>
                                <form action="{{route('leave.comments', [$post->user->employee_id, $post->id])}}" method="post">
                                    {{csrf_field()}}
                                    <input type="hidden" name="user_id" value="{{$post->user->id}}">
                                    <input type="hidden" name="post_id" value="{{$post->id}}">
                                    <textarea name="comment"></textarea>
                                    <button type="submit">Leave Comment</button>
                                </form>
                            </p>
                    @endforeach
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection