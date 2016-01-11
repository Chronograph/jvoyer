@extends('layouts.master')


@section('title', ' | Home')




@section('content')
    <div class="row">
        <div class="col-md-3">
            <h3>Project Dashboard</h3>
        </div>
        <div class="col-md-3 col-md-offset-6">
            <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#project-modal" value="Login"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> New Project</button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
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
                        <td>{{ $project->name }}</td>
                        <td>{{ $project->repository }}</td>
                        <td>Jan 123</td>
                        <td><button type="button" class="btn btn-primary pull-right" onclick="location.href= '{{ URL::to('projects/' . $project->id) }}';" ><span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span></button></td>
                    </tr>
                    @endforeach
                </tbody>


            </table>
        </div>
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
@endsection