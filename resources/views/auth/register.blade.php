@extends('layouts.main-layout')
@section('title', 'Register')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    @if(Auth::check())
                        @if(Auth::user()->role->where('role_id', 1)->first())
                            User Data
                        @endif
                        @else Register
                    @endif

                </div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('addUpdateUser', ['routeName' => $routeName, 'id' => $id]) }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{old('name')}}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        @if(Auth::check())
                            @if(Auth::user()->role->where('role_id', 1)->first())
                                <div class="form-group {{ $errors->has('role') ? ' has-error' : '' }}">
                                    <label for="role" class="col-md-4 control-label">Role</label>

                                    <div class="col-md-6">
                                        <select name="role" id="role" class="form-control">
                                            <option value="">Select Role</option>
                                            @foreach($roles as $role)
                                                <option value="{{$role->id}}">{{$role->name}}</option>
                                             @endforeach
                                        </select>

                                        @if ($errors->has('role'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('role') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        @endif

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="email" value="{{old('email')}}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password_confirmation" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation">

                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                            @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 control-label">Phone</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control" name="phone" value="{{old('phone')}}">

                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 control-label">Gender</label>

                            <div class="col-md-6">
                                <input id="male" type="radio" name="gender" value="Male"> Male
                                <input id="female" type="radio" name="gender" value="Female"> Female

                                @if ($errors->has('gender'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="address" class="col-md-4 control-label">Address</label>

                            <div class="col-md-6">
                                <textarea class="form-control" rows="5" id="address" name="address"></textarea>

                                @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('profile_picture') ? ' has-error' : '' }}">
                            <label for="profile_picture" class="col-md-4 control-label">Profile Picture</label>

                            <div class="col-md-6">
                                <input id="profile_picture" type="file" class="form-control" name="profile_picture">

                                @if ($errors->has('profile_picture'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('profile_picture') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('birthday') ? ' has-error' : '' }}">
                            <label for="birthday" class="col-md-4 control-label">Birthday</label>

                            <div class="col-md-6">
                                <input id="birthday" type="date" class="form-control" name="birthday" value="{{old('birthday')}}">

                                @if ($errors->has('birthday'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('birthday') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        @if(!Auth::check())
                        <div class="form-group{{ $errors->has('agreement') ? ' has-error' : '' }}">
                            <label for="agreement" class="col-md-4 control-label">Agreement</label>

                            <div class="col-md-6">
                                <input id="agreement" type="checkbox" name="agreement">
                                By registering to this website, I agree to terms and conditions.
                                @if ($errors->has('agreement'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('agreement') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        @endif

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
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
