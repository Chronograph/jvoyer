@extends('layouts.master')


@section('title', ' | Home')




@section('content')
    <div class="row">
        <div class="col-md-3">
            <h3>{{ $project->name }}</h3>
        </div>
        <div class="col-md-3 col-md-offset-6">
            <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#project-edit-modal"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Settings</button>
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
                                <td align="right">test/thing</td>
                            </tr>
                            <tr>
                                <td>Deploy Branch</td>
                                <td align="right"> <span class="label label-default">master</span> </td>
                            </tr>
                            <tr>
                                <td>Health Check URL</td>
                                <td align="right"> N/A </td>
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

            </div>

            <div role="tabpanel" class="tab-pane" id="servers">
                <div class="container">
                    <div class="row">
                        <div class="col-md-2">
                            <h4> Servers </h4>
                        </div>

                            <button class="btn btn-primary pull-right"> Add Server </button>


                            <button class="btn btn-primary pull-right" > Manage Environment </button>







                    </div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th> head 1</th>
                            <th> head 2</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td> thing </td>
                            <td> thing 2</td>
                        </tr>
                        </tbody>
                    </table>
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
                    <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-book" aria-hidden="true"></span> Add a Project </h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12">


                            <form id="projectForm" method="POST" action="{{URL::to('projects') }}">
                                {!! csrf_field() !!}

                                <div class="form-group">
                                    <label for="name" class="control-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="" required="" title="Name" placeholder="Name of Project">

                                </div>
                                <div class="form-group">
                                    <label for="repo" class="control-label">Repository</label>
                                    <input type="text" class="form-control" id="repo" name="repo" value="" required="" title="Repository" placeholder="/stash/path/to/repo.git">

                                </div>

                                <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-floppy-saved" aria-hidden="true"></span> Create Project</button>

                            </form>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="server-modal" class="modal fade project-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-book" aria-hidden="true"></span> Add a Project </h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12">


                            <form id="serverForm" method="POST" action="{{URL::to('servers') }}">
                                {!! csrf_field() !!}

                                <div class="form-group">
                                    <label for="name" class="control-label">SERVER STUFF NOT DONE</label>
                                    <input type="text" class="form-control" id="name" name="name" value="" required="" title="Name" placeholder="Name of Project">

                                </div>
                                <div class="form-group">
                                    <label for="repo" class="control-label">Repository</label>
                                    <input type="text" class="form-control" id="repo" name="repo" value="" required="" title="Repository" placeholder="/stash/path/to/repo.git">

                                </div>

                                <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-floppy-saved" aria-hidden="true"></span> Create Project</button>

                            </form>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection