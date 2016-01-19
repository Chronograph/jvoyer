@extends('layouts.master')


@section('title', ' | Home')




@section('content')
    <div class="row">
        <div class="col-md-3">
            <h3>{{ $project->name }}</h3>
        </div>
        <div class="col-md-3 col-md-offset-6">
            @if($servers->count() > 0)
                <button class="btn btn-success pull-right header3-button"><span class="fa fa-cloud-download" aria-hidden="true"></span> Deploy</button>

            @endif
            <button class="btn btn-primary pull-right header3-button" data-toggle="modal" data-target="#project-edit-modal"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Settings</button>
        </div>
    </div>

        <div class="container">
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
                                <td align="right"> {{ $res . '|||' . $ret}}</td>

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
                <div class="container-fluid">
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
                                    <td>{{ $deployment->id }}</td>
                                    <td>{{ $deployment->committer }}</td>
                                    <td>{{ $deployment->commit }}</td>
                                    <td>{{ $deployment->status }}</td>
                                    <td alight="right">Buttons here? </td>
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
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-2">
                            <h4> Servers </h4>
                        </div>
                        <div class="col-md-offset-6 col-md-4 pullright">
                            <button class="btn btn-primary pull-right header4-button" data-toggle="modal" data-target="#new-server-modal"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Server </button>
                            <button class="btn btn-primary pull-right header4-button" data-toggle="modal" data-target="#manage-environment-modal"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Manage Environment </button>
                        </div>
                    </div>
                    <br>
                    @if ($servers->count() > 0)


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
                                    <td alight="right">Buttons here? </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
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