<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\Project;
use App\Server;
use App\Deployment;
use App\Jobs\DeployJob;
use Carbon\Carbon;

class ProjectController extends Controller
{
	public function home()
	{
		return view('home', ['users' => User::all()]);
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	    $user = Auth::user();

	    $projects = $user->projects;
	    //$all = Project::all();
	    //dd($projects);
        return view('projects', ['projects' => $projects, 'user' => $user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

	public function deployProject(){
		$this->dispatch(new DeployJob());
		return('OK!');

	}

	public function deployProjectpost(Request $request){
		//dd($request);
		//middleware check if user matches with project + server
		$user = Auth::user();
		$project = Project::find($request->input('project_id'));
		$server_ids = $request->input('server_ids');
		for($i = 0 ; $i < sizeof($server_ids) ; $i++){
			$deployment = new Deployment;
			$server = Server::find($server_ids[$i]);
			$deployment->project_id = $project->id;
			$deployment->server_id = $server->id;
			$deployment->committer = $user->name;
			$deployment->save();

			$this->dispatch(new DeployJob($project, $server, $deployment));
		}

		return("ok");

	}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
	    $user = Auth::user();

	    $project = new Project;
	    $project->name = $request->input('name');
	    $project->repository = $request->input('repo');
	    $project->repo_provider = $request->input('provider');
	    $project->user_id = $user->id;

	    $project->save();


	    return redirect()->action('ProjectController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

		$day = new Carbon();
	    $day = $day->format("YmdHis");
        $project = Project::find($id);
	    //exec('cd .. ; /home/vagrant/.composer/vendor/bin/envoy run deploy', $res, $ret);

	    $servers = $project->servers()->simplePaginate(15);
	    $deployments = $project->deployments()->simplePaginate(15);
	    return view('project', ['project' => $project,
		    'servers' => $servers, 'deployments' => $deployments,
	        'day' => $day]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

	    $project = Project::find($id);
	    $project->name = $request->input('name');
	    $project->repository = $request->input('repo');

	    $project->save();

	    return redirect()->action('ProjectController@show',['id' => $id]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
