@extends('layouts.main-layout')
@section('title', 'Edit Forum Thread')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Update Forum Thread</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('update-forum-thread', ['id' => $id, 'thread_id' => $thread_id]) }}" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <label for="thread_content" class="col-md-4 control-label">Content</label>
                            <div class="form-group {{ $errors->has('thread_content') ? ' has-error' : '' }}">
                                <div class="col-md-6">
                                    <input id="thread_content" type="text" class="form-control" name="thread_content" placeholder="Enter content here..." value="{{ $edit->content }}">

                                    @if ($errors->has('thread_content'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('thread_content') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Update
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection