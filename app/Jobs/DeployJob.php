<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Server;
use App\Project;

class DeployJob extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

	protected $project;
	protected $server;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Project $project, Server $server)
    {
	    $this->project = $project;
	    $this->server = $server;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
	    exec('cd .. ; /home/vagrant/.composer/vendor/bin/envoy run deploy'
		    . ' --repo=' . $this->project->repository
		    . ' --provider=' . $this->project->repo_provider
		    . ' --ip=' . $this->server->ip
		    . ' --path=' . $this->server->path
		    . ' --user=' . $this->server->server_user,
		    $res, $ret);

    }
}
