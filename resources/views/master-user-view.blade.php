@extends('layouts.main-layout')
@section('title', 'Master User')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <h5 class="pull-left">List Of User</h5>
                        <a href="{{ route('addUser') }}" class="btn btn-success pull-right">Add New User</a>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <td>Photo</td>
                                <td>Name</td>
                                <td>Role</td>
                                <td>Email</td>
                                <td>Phone</td>
                                <td>Address</td>
                                <td>Birthday</td>
                                <td>Gender</td>
                                <td>Actions</td>
                                </thead>
                                <tbody>
                                @if(count($datas) > 0)
                                @foreach($datas as $data)
                                    <tr>
                                        <td><img src="profile_picture/{{$data->profile_picture}}" alt="" class="imgData"></td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->role->role->name }}</td>
                                        <td>{{ $data->email }}</td>
                                        <td>{{ $data->phone }}</td>
                                        <td>{{ $data->address }}</td>
                                        <td>{{ $data->birthday }}</td>
                                        <td>{{ $data->gender }}</td>
                                        <td>
                                            <div>
                                                <div class="pull-left">
                                                    <form method="get" action="{{ route('updateUserPage', ['id' => $data->id]) }}">
                                                        {{ csrf_field() }}
                                                        <button type="submit" class="btn edit-button">
                                                            <i class="fa fa-edit edit-button"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                                <div class="pull-left">
                                                    <form method="post" action="{{ route('deleteUser', ['id' => $data->id]) }}">
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
                                @else @php Auth::logout(); @endphp
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