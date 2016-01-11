<!-- resources/views/auth/login.blade.php -->



@extends('layouts.master')

@section('title', ' | Compare List')


@section('styles')
    <style>
        td.opt1 {
            text-align:center;
            vertical-align:middle;
            margin_top:20px;
        }
        th.opt1 {
            text-align:center;
            vertical-align:middle;
        }
        tr.clicked {
            opacity:0.5;
            background-color:gainsboro;
        }


    </style>
@endsection

@section('content')

    <div class="col-xs-12 col-md-offset-4 col-md-4 col-sm-6 col-sm-offset-3">
        <h2 class="text-center" >Please Login</h2>
        <div class="well">

            <form id="signup_form" method="POST" action="/auth/login">
                {!! csrf_field() !!}


                <div class="form-group">
                    <label for="email" class="control-label">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" value="" required="" title="" placeholder="">
                    <span class="help-block"></span>
                </div>
                <div class="form-group">
                    <label for="password" class="control-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" value="" required="" title="">
                    <span class="help-block"></span>
                </div>
                <div id="loginErrorMsg" class="alert alert-error hide">Wrong username og password</div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember" id="remember"> Remember login
                    </label>

                </div>
                <button type="submit" class="btn btn-success btn-block">Login</button>

            </form>
        </div>
    </div>

@endsection

@section('scripts')


@endsection
