@extends('layouts.master')


@section('title', ' | Home')

@section('nav2')
        <!-- second nav for specific page -->
<nav class="navbar navbar-default navbar-static-top pad-sides">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#my-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <h3 class="navbar-text">Project Dashboard</h3>


        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="my-navbar-collapse-1">
            <ul class="nav navbar-nav">


             <!--   <li class="{{ (Request::is('/') ? 'active' : '') }}">
                    <a href="{{URL::to('/') }}"><i class="glyphicon glyphicon-home"></i> Home </a>
                </li>
                <li class="{{ (Request::is('projects*') ? 'active' : '') }}">
                    <a href="{{URL::to('projects') }}"><i class="fa fa-folder-open"></i> Projects </a>
                </li> -->
                <li class="dropdown">
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <button class="btn btn-success navbar-btn" data-toggle="modal" data-target="#project-modal" value="Login"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> New Project</button>
            </ul>

        </div>
    </div>
</nav>

@endsection


@section('content')

    <div class="row well white">
        @if($projects->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Repository</th>
                        <th colspan="2">Last Deployed</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($projects as $project)
                    <tr>
                        <td>{{ $project->name . "  " . $project->repo_provider}}</td>
                        @if($project->repo_provider == 'github')
                            <td><i class="fa fa-github" aria-hidden="true"></i> {{ $project->repository }}</td>
                        @elseif($project->repo_provider == 'bitbucket')
                            <td><i class="fa fa-bitbucket" aria-hidden="true"></i> {{ $project->repository }}</td>
                        @endif
                        <td>Jan 123</td>
                        <td><button type="button" class="btn btn-primary pull-right" onclick="location.href= '{{ URL::to('projects/' . $project->id) }}';" ><span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span></button></td>
                    </tr>
                    @endforeach
                </tbody>


            </table>
        @else
            <h1 class="text-center">Please add a project to get started!</h1>
        @endif
    </div>
@endsection

@section('modals')
    <div id="project-modal" class="modal fade project-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-book" aria-hidden="true"></span> Add a Project </h4>
                </div>
                <form id="projectForm" method="POST" action="{{URL::to('projects') }}">
                    {!! csrf_field() !!}

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-xs-12">

                                <div class="form-group">
                                    <label for="name" class="col-sm-3 control-label">Name</label>
                                    <div class="col-sm-8 add-low-margin">
                                        <input type="text" class="form-control" id="name" name="name" value="" required="" title="Name" placeholder="Name of Project">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="provider" class="col-sm-3 control-label">Provider</label>
                                    <div class="col-sm-8">
                                        <input type="radio" name="provider" value="github"> <i class="fa fa-github" aria-hidden="true"></i> GitHub<br>
                                    </div>
                                    <div class="col-sm-offset-3 col-sm-8 add-low-margin">
                                        <input type="radio" name="provider" value="bitbucket"> <i class="fa fa-bitbucket" aria-hidden="true"></i> Bitbucket<br>
                                    </div>



                                </div>

                                <div class="form-group">
                                    <label for="repo" class="col-sm-3 control-label">Repository</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="repo" name="repo" value="" required="" title="Repository" placeholder="/stash/path/to/repo.git">
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-floppy-saved" aria-hidden="true"></span> Create Project</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection