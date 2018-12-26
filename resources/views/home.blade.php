@extends('layouts.main-layout')
@section('title', 'Home')
@section('content')
    <div class="container">
        <div class="topnav">
            <div class="search-container">
                <form action="{{ route('search-forum') }}" method="post">
                    {{csrf_field()}}
                    <input type="text" placeholder="Search Forum by Forum / Category Name" name="search">
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
        <br>
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
                                        <a href="{{ route('view-forum-thread', ['id' => $data->id]) }}">{{ $data->forum->name }}</a>
                                        @if($data->forum->status == 'open')
                                            <span class="forum-open pull-right">Open</span>
                                        @elseif($data->forum->status == 'closed')
                                            <span class="forum-closed pull-right">Closed</span>
                                        @endif
                                    </h4>
                                    <p class="summary">Category: {{ $data->category->name }}</p>
                                    <p class="summary">Posted on: {{ $data->forum->created_at->format('d-M-Y h:i:s') }}</p>
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