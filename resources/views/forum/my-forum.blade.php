@extends('layouts.main-layout')
@section('title', 'My Forum')
@section('content')
    <div class="container">
        @if($datas)
            <div class="table-responsive">
                <table class="table table-hover">
                    <tbody>
                    @foreach($datas as $data)
                        <tr>
                            <td>
                                <div class="media">
                                    <div class="media-body">
                                        <h4 class="title">
                                            {{ $data->forum->name }}
                                            @if($data->forum->status == 'open')
                                            <div>
                                                <div class="pull-right">
                                                    <form method="post" action="{{ route('close-forum', ['id' => $data->forum->id]) }}">
                                                        {{ csrf_field() }}
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            <i class="fa fa-times"></i>
                                                            Close
                                                        </button>
                                                    </form>
                                                </div>
                                                <div class="pull-right">
                                                    <form method="get" action="{{ route('forum-edit-page', ['id' => $data->id]) }}">
                                                        {{ csrf_field() }}
                                                        <button type="submit" class="btn btn-warning btn-sm">
                                                            <i class="fa fa-edit"></i>
                                                            Edit
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                            @endif
                                        </h4>
                                        <p class="summary">
                                            Status:
                                            @if($data->forum->status == 'open')
                                                <span class="forum-open">Open</span>
                                            @elseif($data->forum->status == 'closed')
                                                <span class="forum-closed">Closed</span>
                                            @endif
                                        </p>
                                        <br>
                                        <p class="summary">{{ $data->forum->description }}</p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="text-center">
                    {{ $datas->links() }}
                </div>
            </div>
        @endif
        @if(Auth::check())
            <footer>
                <a href="{{ route('home-insert-page') }}"><i class="fa fa-plus-circle insert-button pull-right"></i></a>
            </footer>
        @endif
    </div>
@endsection