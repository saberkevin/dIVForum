@extends('layouts.main-layout')
@section('title', 'Master Forum')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <h5 class="pull-left">List Of Forums</h5>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <td>Name</td>
                                <td>Category</td>
                                <td>Owner</td>
                                <td>Description</td>
                                <td>Status</td>
                                <td>Actions</td>
                                </thead>
                                <tbody>
                                @if(count($datas) > 0)
                                    @foreach($datas as $data)
                                        <tr>
                                            <td>{{ $data->forum->name }}</td>
                                            <td>{{ $data->category->name }}</td>
                                            <td>{{ $data->forum->user->name }}</td>
                                            <td>{{ $data->forum->description }}</td>
                                            <td>{{ $data->forum->status }}</td>
                                            <td>
                                                <div>
                                                    <div class="pull-left">
                                                        <form method="post" action="{{ route('close-forum', ['id' => $data->forum->id]) }}">
                                                            {{ csrf_field() }}
                                                            <button type="submit" class="btn btn-danger btn-sm" @if($data->forum->status == 'closed') disabled @endif>
                                                                <i class="fa fa-times"></i>
                                                                Close
                                                            </button>
                                                        </form>
                                                    </div>
                                                    <div class="pull-left">
                                                        <form method="post" action="{{ route('delete-forum', ['id' => $data->id]) }}">
                                                            {{ csrf_field() }}
                                                            {{ method_field('delete') }}
                                                            <button type="submit" class="btn btn-danger btn-sm">
                                                                <i class="fa fa-trash"></i>
                                                                Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                            {{ $datas->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection