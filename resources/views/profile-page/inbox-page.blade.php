@extends('layouts.main-layout')
@section('title', 'Master User')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if(count($datas) > 0)
            @foreach($datas as $data)
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <div class="pull-left">
                            <a href="{{route('profilePage', ['id' => $data->sender_id])}}" class="inboxSenderName">{{$data->senders->name}}</a> <br>
                            {{$data->created_at->format('l, d-M-Y h:i:s')}}
                        </div>
                        <div class="pull-right">
                            <form method="post" action="{{ route('deleteMessage', ['id' => $data->id]) }}">
                                {{ csrf_field() }}
                                {{ method_field('delete') }}
                                <button type="submit" class="btn btn-danger">
                                    <span class="glyphicon glyphicon-trash"></span>Delete
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="panel-body">
                        {{$data->content}}
                    </div>
                </div>
            @endforeach
            @else <p align="center">No Message Available</p>
            @endif
        </div>
    </div>
    {{ $datas->links() }}
</div>
@endsection