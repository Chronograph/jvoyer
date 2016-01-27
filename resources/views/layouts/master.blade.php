<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <!-- Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/sweetalert.css" type="text/css" rel="stylesheet">
            <!-- Font just incase? -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Noticia+Text" rel="stylesheet" type="text/css">
    <link href="../css/custom.css" rel="stylesheet">
    <title> Envoyer @yield('title')</title>
    @yield('styles')
</head>

<body >

    <!-- first nav -->
    <nav class="navbar navbar-default navbar-static-top no-nav-margin pad-sides no-border">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#my-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{URL::to('/') }}">Jvoyer!</a>


            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="my-navbar-collapse-1">
                <ul class="nav navbar-nav">


                    <li class="{{ (Request::is('projects*') ? 'active' : '') }}">
                        <a href="{{URL::to('projects') }}"><i class="fa fa-folder-open"></i> Projects </a>
                    </li>
                    <li class="dropdown">
                    </li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    @if(Auth::check())
                        <li><p class="navbar-text">Hello, {{Auth::user()->name}}</p></li>
                        <li><button type="button" class="btn btn-danger navbar-btn" onclick="location.href='{{ URL::to('auth/logout') }}';" >Logout</button></li>
                    @else
                        <li style="margin-right:10px"><button type="button" class="btn btn-primary navbar-btn" data-toggle="modal" data-target=".login-modal" value="Login">Login</button></li>
                        <li><button type="button" class="btn btn-success navbar-btn" data-toggle="modal" data-target=".login-modal" value="Signup">Signup</button></li>
                    @endif
                </ul>

            </div>
        </div>
    </nav>

    @yield('nav2')



<div class="container">
    @yield('content')
</div>

@yield('modals')

<!-- Login Modal -->

<div id="login-overlay" class="modal fade login-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Login to J-voyer</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="well">

                            <form id="loginForm" method="POST" action="{{URL::to('auth/login') }}">
                                {!! csrf_field() !!}

                                <div class="form-group">
                                    <label for="email" class="control-label">Email Address</label>
                                    <input type="email" class="form-control" id="email" name="email" value="" required="" title="Please enter you username" placeholder="example@gmail.com">
                                    <span class="help-block"></span>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="control-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" value="" required="" title="Please enter your password">
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
                    <div class="col-xs-6">
                        <p style="margin-bottom:1px" class="lead">Don't have an Account?</p>
                        <p class="lead">Register now for <span class="text-success">FREE</span></p>
                        <ul class="list-unstyled" style="line-height: 2">
                            <li><span class="fa fa-check text-success"></span> Reasons...</li>
                            <li><span class="fa fa-check text-success"></span> This list isn't really needed</li>
                            <li><span class="fa fa-check text-success"></span> Stuff stuff stuff</li>
                            <li><span class="fa fa-check text-success"></span> More stuff</li>
                        </ul>
                        <p><a href="{{URL::to('auth/register') }}" class="btn btn-info btn-block">Yes please, register now!</a></p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


<!-- JQuery -->

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" ></script>
<script src="../js/sweetalert.min.js"></script>
@yield('scripts')

</body>

</html>