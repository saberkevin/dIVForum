@extends('layouts.main-layout')
@section('title', 'Profile Page')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div>
                            <img src="../profile_picture/{{$data->profile_picture}}" alt="" class="profileUserImg pull-left">
                        </div>
                        <div class="col-md-9">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <table class="table borderless">
                                        <tr>
                                            <td colspan="3">
                                                @if($id == Auth::user()->id)
                                                    <a href="{{route('profileEdit', ['id' => Auth::user()->id])}}" class="btn btn-success btn-sm pull-right">Edit</a>
                                                @else
                                                    <div class="col-md-4 pull-right">
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">Give Popularity</div>
                                                            <div class="panel-body">
                                                                <a href="{{route('profileVote', ['id' => $id, 'voteBoolean' => 1])}}" class="btn btn-success btn-sm rightPopularity"><b>+</b></a>
                                                                <a href="{{route('profileVote', ['id' => $id, 'voteBoolean' => 0])}}" class="btn btn-danger btn-sm"><b>-</b></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>Name</b></td>
                                            <td colspan="2">{{$data->name}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Popularity</b></td>
                                            <td colspan="2">
                                                <button class="btn btn-success btn-sm">+{{$data->popularity->positive}}</button>
                                                <button class="btn btn-danger btn-sm">-{{$data->popularity->negative}}</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>Email</b></td>
                                            <td colspan="2">{{$data->email}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Phone</b></td>
                                            <td colspan="2">{{$data->phone}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Birthday</b></td>
                                            <td colspan="2">{{$data->birthday}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Gender</b></td>
                                            <td colspan="2">{{$data->gender}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Address</b></td>
                                            <td colspan="2">{{$data->address}}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        @if($id != Auth::user()->id)
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Message</div>
                    <div class="panel-body">
                        <form action="{{route('sendMessage', $id)}}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <textarea name="message" id="message" rows="3" class="col-md-12 form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <div class="pull-right sendMessageTop">
                                    <button type="submit" class="btn btn-primary">
                                        <span class="glyphicon glyphicon-plane"></span> Send
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
@endsection