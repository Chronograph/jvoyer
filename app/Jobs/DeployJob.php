<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Server;
use App\Project;
use App\Deployment;
use Carbon\Carbon;

class DeployJob extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

	protected $project;
	protected $server;
	protected $deployment;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Project $project, Server $server, Deployment $deployment)
    {
	    $this->project = $project;
	    $this->server = $server;
	    $this->deployment = $deployment;
    }



	public function cloneReleases()
	{
		$tmp = explode("/",$this->project->repository);
		$project_name = $tmp[sizeof($tmp) - 1];
		$this->deployment->clone_start = new Carbon();
		$this->deployment->save();
		exec('cd .. ; /home/vagrant/.composer/vendor/bin/envoy run deploygit'
			. ' --repo=' . $this->project->repository
			. ' --provider=' . $this->project->repo_provider
			. ' --ip=' . $this->server->ip
			. ' --path=' . $this->server->path
			. ' --user=' . $this->server->server_user
			. ' --pname=' . $project_name
			. ' --time='  . $this->deployment->created_at->format("YmdHis"),
			$res, $ret);

		foreach($res as &$line) {
			if (strpos($line, ']') !== false) {
				$line = substr($line, strpos($line, ']') + 3 );
			}
		}

		$this->deployment->clone_log = implode('\n',$res);
		$this->deployment->clone_done = new Carbon();

		$this->deployment->save();
	}

	public function composerDependencies()
	{
		$tmp = explode("/",$this->project->repository);
		$project_name = $tmp[sizeof($tmp) - 1];
		$this->deployment->composer_start = new Carbon();
		$this->deployment->save();
		exec('cd .. ; /home/vagrant/.composer/vendor/bin/envoy run composer'
			. ' --ip=' . $this->server->ip
			. ' --path=' . $this->server->path
			. ' --user=' . $this->server->server_user
			. ' --time='  . $this->deployment->created_at->format("YmdHis"),
			$res, $ret);

		foreach($res as &$line) {
			if (strpos($line, ']') !== false) {
				$line = substr($line, strpos($line, ']') + 3 );
			}
		}

		$this->deployment->composer_log = implode('\n',$res);
		$this->deployment->composer_done = new Carbon();

		$this->deployment->save();
	}

	public function activateRelease()
	{
		$tmp = explode("/",$this->project->repository);
		$project_name = $tmp[sizeof($tmp) - 1];
		$this->deployment->activate_start = new Carbon();
		$this->deployment->save();
		exec('cd .. ; /home/vagrant/.composer/vendor/bin/envoy run activate'
			. ' --ip=' . $this->server->ip
			. ' --path=' . $this->server->path
			. ' --user=' . $this->server->server_user
			. ' --time='  . $this->deployment->created_at->format("YmdHis"),
			$res, $ret);

		foreach($res as &$line) {
			if (strpos($line, ']') !== false) {
				$line = substr($line, strpos($line, ']') + 3 );
			}
		}

		$this->deployment->activate_log = implode('\n',$res);
		$this->deployment->activate_done = new Carbon();

		$this->deployment->save();
	}

	public function purgeRelease()
	{
		$tmp = explode("/",$this->project->repository);
		$project_name = $tmp[sizeof($tmp) - 1];
		$this->deployment->purge_start = new Carbon();
		$this->deployment->save();
		exec('cd .. ; /home/vagrant/.composer/vendor/bin/envoy run purgereleases'
			. ' --ip=' . $this->server->ip
			. ' --path=' . $this->server->path
			. ' --user=' . $this->server->server_user
			. ' --keep=' . $this->server->keep_releases,
			$res, $ret);

		foreach($res as &$line) {
			if (strpos($line, ']') !== false) {
				$line = substr($line, strpos($line, ']') + 3 );
			}
		}

		$this->deployment->purge_log = implode('\n',$res);
		$this->deployment->purge_done = new Carbon();

		$this->deployment->save();
	}

	/**
	 * Execute the job.
	 *
	 * @return void
	 */
	public function handle()
	{
		$this->deployment->status = 'Running';
		$this->deployment->save();
		$this->cloneReleases();
		$this->composerDependencies();
		$this->activateRelease();
		//$this->purgeRelease();

	}
}
