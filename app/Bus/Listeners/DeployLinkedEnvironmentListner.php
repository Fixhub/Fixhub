<?php

/*
 * This file is part of Fixhub.
 *
 * Copyright (C) 2016 Fixhub.org
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fixhub\Bus\Listeners;

use Fixhub\Bus\Events\DeployFinishedEvent;
use Fixhub\Bus\Jobs\SetupDeploymentJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Queue\InteractsWithQueue;
use Fixhub\Models\Deployment;
use Fixhub\Models\EnvironmentLink;

/**
 * When a deploy finished, trigger linked environment to deploy.
 */
class DeployLinkedEnvironmentListner implements ShouldQueue
{
    use InteractsWithQueue, DispatchesJobs;

    /**
     * Handle the event.
     *
     * @param  DeployFinishedEvent $event
     * @return void
     */
    public function handle(DeployFinishedEvent $event)
    {
        $deployment = $event->deployment;

        if (!$deployment->isSuccessful()) {
            return;
        }

        $project = $deployment->project;

        $oppositeEnvironments = $deployment->environments->pluck('oppositePivot')->flatten();
        $ids = [];
        $link_type = EnvironmentLink::MANUAL;
        foreach ($oppositeEnvironments as $item) {
            $ids[] = $item->id;

            if ($item->pivot) {
                $link_type = $item->pivot->link_type;
            }
        }

        if (sizeof($ids) < 1) {
            return;
        }

        // Fix me
        $fields = [
            'reason'         => trans('environments.link_deploy_reason'),
            'project_id'     => $project->id,
            'environments'   => $ids,
            'branch'         => $project->branch,
            'optional'       => [],
        ];

        $optional = array_pull($fields, 'optional');
        $environments = array_pull($fields, 'environments');

        $fields['status'] = $link_type == EnvironmentLink::AUTOMATIC ? Deployment::PENDING : Deployment::DRAFT;

        $new = Deployment::create($fields);

        $this->dispatch(new SetupDeploymentJob(
            $new,
            $environments,
            $optional
        ));
    }
}
