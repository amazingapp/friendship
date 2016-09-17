@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                @include('flash.messages')
                @include('errors.messages')
                <div class="panel-body">
                    Respond to your 1 friend request.
                    @foreach ($friendRequests as $friend)
                        <?php $friendRequest = $friend->sender()->first(); ?>
                        <p>
                            {{$friendRequest->name}}
                            <span>
                            <form action="/friends/accept" method="POST">
                                {{csrf_field()}}
                                <input type="hidden" name="employee_id" value="{{$friendRequest->employee_id}}" />
                                <button type="submit" class="btn btn-primary btn-sm">Confirm</button>
                            </form>
                            <form action="/friends/decline" method="POST">
                              {{csrf_field()}}
                              <input type="hidden" name="employee_id" value="{{$friendRequest->employee_id}}" />
                              <button type="submit" class="btn btn-default btn-sm">Delete Request</button>
                            </form>
                            </span>
                        </p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
