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
            <h3 class="navbar-text"> {{ $project->name }} </h3>


        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="my-navbar-collapse-1">
            <ul class="nav navbar-nav">



                <li class="dropdown">
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">

                <button class="btn btn-primary navbar-btn" data-toggle="modal" data-target="#project-edit-modal"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Settings</button>

                @if($servers->count() > 0)

                    <button id="deploy-btn" class="btn btn-success navbar-btn"><i class="fa fa-cloud-download" aria-hidden="true"></i> Deploy</button>
                @endif

            </ul>

        </div>
    </div>
</nav>

@endsection

@section('content')
    <div class="container add-low-margin">
        <div class="row">
            <div class="col-md-5 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Project Details</strong></h3>
                    </div>
                    <table class="table">
                        <tbody>
                        <tr>
                            <td>Repository</td>
                            <td align="right">{{ $project->repository }}</td>
                        </tr>
                        <tr>
                            <td>Deploy Branch</td>
                            <td align="right"> <span class="label label-default">master</span> </td>
                        </tr>
                        <tr>
                            <td>Health Check URL</td>
                            <td align="right">{{$day}}</td>

                        </tr>
                        </tbody>
                    </table>

                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Deployments</strong></h3>
                    </div>
                    <table class="table">
                        <tbody>
                        <tr>
                            <td>Today's</td>
                            <td align="right">0</td>
                        </tr>
                        <tr>
                            <td>This Week</td>
                            <td align="right"> 0</td>
                        </tr>
                        <tr>
                            <td>Last Duration</td>
                            <td align="right"> N/A </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <div>

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#deployments" aria-controls="deployments" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-time" aria-hidden="true"></span> Deployments</a></li>
            <li role="presentation"><a href="#servers" aria-controls="servers" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-tasks" aria-hidden="true"></span> Servers</a></li>
            <li role="presentation"><a href="#collaborators" aria-controls="collaborators" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Collaborators</a></li>
            <li role="presentation"><a href="#deployment_hooks" aria-controls="deployment_hooks" role="tab" data-toggle="tab">Deployment Hooks</a></li>
            <li role="presentation"><a href="#heartbeats" aria-controls="heartbeats" role="tab" data-toggle="tab">Heartbeats</a></li>
            <li role="presentation"><a href="#notifications" aria-controls="notifications" role="tab" data-toggle="tab">Notifications</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="deployments">
                <div class="container-fluid white bottom-border-curved">
                    <div class="row">
                        <div class="col-md-5">
                            <h4> Recent Deployments </h4>
                        </div>
                    </div>
                    <br>
                    @if ($deployments->count() > 0)
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Started</th>
                                <th>Committer</th>
                                <th>Commit</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($deployments as $deployment)
                                <tr>
                                    <td>{{ $deployment->created_at->format('M jS, g:i A') }}</td>
                                    <td>{{ $deployment->committer }}</td>
                                    <td>{{ $deployment->commit }}</td>
                                    <td>{{ $deployment->status }}</td>
                                    <td align="right">
                                        <button class="btn btn-primary"><i class="fa fa-long-arrow-right" onclick="location.href= '{{ URL::to('deployments/' . $project->id) }}';"> </i> </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {!! $deployments->render() !!}
                    @else
                        <p>No deployments have been made for this project</p>
                    @endif
                </div>
            </div>

            <div role="tabpanel" class="tab-pane" id="servers">
                <div class="container-fluid white bottom-border-curved">
                    <div class="row">
                        <div class="col-md-2">
                            <h4> Servers </h4>
                        </div>
                        <div class="col-md-offset-6 col-md-4 pullright">
                            <button class="btn btn-primary pull-right header4-button" data-toggle="modal" data-target="#new-server-modal" ><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Server </button>
                            <button class="btn btn-primary pull-right header4-button" data-toggle="modal" data-target="#manage-environment-modal" ><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Manage Environment </button>
                        </div>
                    </div>
                    <br>
                    @if ($servers->count() > 0)
                        <form id="deployForm" method="POST" action="{{URL::to('deploy') }}">
                            {!! csrf_field() !!}
                            <input type="hidden" name="project_id" value="{{ $project->id }}">

                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Connect As</th>
                                    <th>IP Address</th>
                                    <th>Recieves Code</th>
                                    <th>Connection Status</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($servers as $server)
                                    <input type="hidden" name="server_ids[]" value="{{$server->id}}">
                                    <tr>
                                        <td> {{ $server->name}} </td>
                                        <td> {{ $server->server_user}} </td>
                                        <td> {{ $server->ip}} </td>
                                        @if($server->receives_code)
                                            <td><i class="fa fa-check"></i> Yes</td>
                                        @else
                                            <td><i class="fa fa-times"></i> No</td>
                                        @endif
                                        <td> {{ $server->connection_status}} </td>
                                        <td align="right">
                                            <button class="btn btn-success"><i class="fa fa-pencil"></i></button>
                                            <button class="btn btn-primary"><i class="fa fa-key"></i></button>
                                            <button class="btn btn-danger"><i class="fa fa-remove"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </form>
                        {!! $servers->render() !!}
                    @else
                        <p>No servers have been assigned to this project</p>
                    @endif
                </div>
            </div>

            <div role="tabpanel" class="tab-pane" id="collaborators">...</div>
            <div role="tabpanel" class="tab-pane" id="deployment_hooks">...</div>
            <div role="tabpanel" class="tab-pane" id="heartbeats">...</div>
            <div role="tabpanel" class="tab-pane" id="notifications">...</div>
        </div>

    </div>
@endsection

@section('modals')
    <div id="project-edit-modal" class="modal fade project-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-book" aria-hidden="true"></span> Edit Project </h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12">


                            <form id="projectForm" method="POST" action="{{ URL::to('projects/update/' . $project->id) }}">
                                {!! csrf_field() !!}

                                <div class="form-group">
                                    <label for="name" class="control-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $project->name }}" required="" title="Name" placeholder="Name of Project">

                                </div>
                                <div class="form-group">
                                    <label for="repo" class="control-label">Repository</label>
                                    <input type="text" class="form-control" id="repo" name="repo" value=" {{ $project->repository }}" required="" title="Repository" placeholder="/stash/path/to/repo.git">

                                </div>

                                <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-floppy-saved" aria-hidden="true"></span> Save Changes</button>

                            </form>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="new-server-modal" class="modal fade project-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-tasks" aria-hidden="true"></span> Add Server</h4>
                </div>
                <form id="serverForm" class="form-horizontal" method="POST" action="{{URL::to('servers') }}">
                    {!! csrf_field() !!}
                    <input type="hidden" name="project_id" value="{{ $project->id }}" >
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="name" class="col-sm-3 control-label">Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="name" name="name" value="" required="" title="Name" placeholder="Name of Server">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="repo" class="col-sm-3 control-label">IP Address</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="ip" name="ip" value="" required="" title="IP Address" placeholder="127.0.0.1">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="repo" class="col-sm-3 control-label">Connect As</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="user" name="user" value="" required="" title="User" placeholder="user">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="checkbox col-sm-offset-3 col-sm-8">
                                        <label>
                                            <input name="receives" type="checkbox" checked> Receives Code Deployments
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="repo" class="col-sm-3 control-label">Project Path</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="path" name="path" value="" required="" title="Project Path" placeholder="/home/var/www">
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success pull-right"><span class="glyphicon glyphicon-floppy-saved" aria-hidden="true"></span> Save Server</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    $( document ).ready(function() {
        console.log( "ready!" );
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        $('#manage-environment-btn').on('click', function(){
            swal("Good job!");
        });

        $('#deploy-btn').on('click', function(){
            $(this).text("Working");
            $(this).prepend('<i class="fa fa-spinner fa-pulse"></i> ' );
            console.log($("#deployForm").serialize());
            $.post(
                "../deploy",
                $( "#deployForm" ).serialize()
            ).done(function( data ) {
                console.log( "Done" );
                $('#deploy-btn').text('Deployed!');
                $('#deploy-btn').prepend('<i class="fa fa-check"></i> ');

            });
        });



    });

</script>

@endsection