@extends('layouts.main-layout')
@section('title', 'Master Category')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Add New Category</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('add-category') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="">

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Add
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @if($datas->count() != 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <td>ID</td>
                            <td>Name</td>
                            <td>Actions</td>
                            </thead>
                            <tbody>
                            @foreach($datas as $data)
                                <tr>
                                    <td>{{ $data->id }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>
                                        <div>
                                            <div class="pull-left">
                                                <form method="get" action="{{ url('master-category/edit/'.$data->id) }}">
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn edit-button">
                                                        <i class="fa fa-edit edit-button"></i>
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="pull-left">
                                                <form method="post" action="{{ url('master-category/delete/'.$data->id) }}">
                                                    {{ csrf_field() }}
                                                    {{ method_field('delete') }}
                                                    <button type="submit" class="btn delete-button">
                                                        <i class="fa fa-trash delete-button"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $datas->links() }}
                    </div>
                @else
                    <p>No Data Available</p>
                @endif
            </div>
        </div>
    </div>
@endsection