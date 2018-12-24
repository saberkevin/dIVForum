@extends('layouts.main-layout')
@section('title', 'Home')
@section('content')
    <div class="container">
        <div class="topnav">
            <div class="search-container">
                <form action="{{ route('search-forum') }}" method="post">
                    {{csrf_field()}}
                    <input type="text" placeholder="Search.." name="search">
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
                                        {{ $data->forums->name }}
                                        @if($data->forums->status == 'open')
                                            <span class="forum-open pull-right">Open</span>
                                        @elseif($data->forums->status == 'closed')
                                            <span class="forum-closed pull-right">Closed</span>
                                        @endif
                                    </h4>
                                    <p class="summary">Category: {{ $data->categories->name }}</p>
                                    <p class="summary">Posted on: {{ $data->forums->created_at }}</p>
                                    <br>
                                    <p class="summary">{{ $data->forums->description }}</p>
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
                <a href="{{ route('login') }}"><i class="fa fa-plus-circle insert-button pull-right"></i></a>
            </footer>
        @endif
    </div>
@endsection