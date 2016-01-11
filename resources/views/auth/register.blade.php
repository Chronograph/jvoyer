

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
        <h2 class="text-center" >Want to Sign Up?</h2>
        <div class="well">

            <form id="signup_form" method="POST" action="/auth/register">
                {!! csrf_field() !!}

                <div class="form-group">
                    <label for="name" class="control-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="" required="" title="" placeholder="">
                    <span class="help-block"></span>
                </div>
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
                <div class="form-group">
                    <label for="password_confirmation" class="control-label">Password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" value="" required="" title="">
                    <span class="help-block"></span>
                </div>


                <button type="submit" class="btn btn-info btn-block">Sign Me Up!</button>

            </form>
        </div>
    </div>

@endsection

@section('scripts')

    <script>
        /*
        $(document).ready(function () {


            //validation rules
            //by default it will append a <label class="error> element to the invalid input
            //and will add a "error" class to the input
            $("#signup_form").validate({
                rules: {
                    "email": {
                        required: true,
                        email: true
                    },
                    "password": {
                        required: true,
                        minlength: 5
                    }
                }
            });
        });*/
    </script>
@endsection