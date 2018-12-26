@extends('layouts.main-layout')
@section('title', 'Forum Thread')
@section('content')
    <div class="container">
        <div class="panel-body">
            <div class="media">
                <div class="media-body">
                    <h4 class="title">
                        {{ $data->forum->name }}
                        @if($data->forum->status == 'open')
                            <span class="forum-open pull-right">Open</span>
                        @elseif($data->forum->status == 'closed')
                            <span class="forum-closed pull-right">Closed</span>
                        @endif
                    </h4>
                    <p class="summary">Category: {{ $data->category->name }}</p>
                    <p class="summary">Owner: {{ $data->forum->user->name }}</p>
                    <p class="summary">Posted on: {{ $data->forum->created_at }}</p>
                    <br>
                    <p class="summary">Description: </p>
                    <p class="summary">{{ $data->forum->description }}</p>
                </div>
            </div>
            <div class="topnav">
                <div class="search-container">
                    <form action="{{ route('search-forum-thread', ['id' => $id]) }}" method="post">
                        {{csrf_field()}}
                        <input type="text" placeholder="Search Threads by Content / Thread Owner" name="search">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>
                @if($search)
                    <div>
                        <span>Thread Search Results With '</span>
                        <span class="font-weight-bold">{{ $search }}</span>
                        <span>' Keywords:</span>
                    </div>
                @endif
            </div>
        </div>
        <br>
        <div class="panel-body">
            @if($threads->count() != 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <tbody>
                        @foreach($threads as $thread)
                            <tr>
                                <td>
                                    <div class="media">
                                        <div class="media-body">
                                            <h4 class="title">
                                                {{-- TBD LINK TO PROFILE --}}
                                                <a href="{{ route('view-forum-thread', ['thread_id' => $thread->user->id]) }}">{{ $thread->user->name }}</a>
                                                {{--=====================--}}
                                                <div>
                                                    <div class="pull-right">
                                                        <form method="post" action="{{ route('delete-forum-thread', ['id' => $thread->id]) }}">
                                                            {{ csrf_field() }}
                                                            {{ method_field('delete') }}
                                                            <button type="submit" class="btn btn-danger btn-sm">
                                                                <i class="fa fa-trash"></i>
                                                                Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                    <div class="pull-right">
                                                        <form method="get" action="{{ route('thread-edit-page', ['id' => $id, 'thread_id' => $thread->id]) }}">
                                                            {{ csrf_field() }}
                                                            <button type="submit" class="btn btn-warning btn-sm">
                                                                <i class="fa fa-edit"></i>
                                                                Edit
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </h4>
                                            <p class="summary">{{ $thread->user->role->role->name }}</p>
                                            <p class="summary">Posted at: {{ $thread->forum->created_at }}</p>
                                            <br>
                                            <p class="summary">{{ $thread->content }}</p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">
                        {{ $threads->links() }}
                    </div>
                </div>
            @else
                <p>This forum doesn’t have any thread</p>
            @endif
        </div>
        <div class="panel-body">
            <h4>Post New Thread</h4>
            <p>Content: </p>
            <div class="topnav">
                <div class="thread-container">
                    <form class="form-horizontal" action="{{ route('add-forum-thread', ['id' => $id]) }}" method="post">
                        {{csrf_field()}}
                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            <div class="col-md-6">
                                <input id="thread_content" type="text" class="form-control" name="thread_content" placeholder="Enter content here..." value="">

                                @if ($errors->has('thread_content'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('thread_content') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="pull-right">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Post</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection