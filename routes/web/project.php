<?php

/*
 * This file is part of Fixhub.
 *
 * Copyright (C) 2016 Fixhub.org
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::group([
        'middleware' => ['auth', 'jwt'],
        'namespace'  => 'Dashboard',
    ], function () {
        // Project
        Route::get('projects/{project}/{tab?}', [
            'as'   => 'projects',
            'uses' => 'ProjectController@show',
        ])->middleware('project.acl:view');
        Route::post('projects', [
            'as'   => 'projects.create',
            'uses' => 'ProjectController@create',
        ]);

        // Deployment
        Route::get('deployment/{deployment}', [
            'as'   => 'deployments',
            'uses' => 'DeploymentController@show',
        ]);

        Route::post('deployments', [
            'as'   => 'deployments.create',
            'uses' => 'DeploymentController@create',
        ]);

        Route::post('deployment/{deployment}/deploy-draft', [
            'as'   => 'deployments.deploy-draft',
            'uses' => 'DeploymentController@deployDraft',
        ]);

        Route::post('deployment/{deployment}/rollback', [
            'as'   => 'deployments.rollback',
            'uses' => 'DeploymentController@rollback',
        ]);

        Route::get('deployment/{deployment}/abort', [
            'as'   => 'deployments.abort',
            'uses' => 'DeploymentController@abort',
        ]);

        // Environment Link
        Route::post('environment-links', [
            'uses' => 'EnvironmentLinkController@store',
        ]);

        // Environment Cabinets
        Route::post('cabinets/{environment}', [
            'uses' => 'CabinetController@store',
        ]);
        Route::delete('cabinets/{environment}/{cabinet}', [
            'uses' => 'CabinetController@destroy',
        ]);

        // Server
        Route::post('servers', [
            'uses' => 'ServerController@store',
        ]);
        Route::put('servers/{server}', [
            'uses' => 'ServerController@update',
        ]);
        Route::delete('servers/{server}', [
            'uses' => 'ServerController@destroy',
        ]);
        Route::post('servers/reorder', [
            'uses' => 'ServerController@reorder',
        ]);
        Route::get('servers/{server}/test', [
            'as'    => 'servers.test',
            'uses'  => 'ServerController@test',
        ]);


        Route::get('log/{log}', [
            'as'   => 'server_log.show',
            'uses' => 'ServerLogController@show',
        ]);
        Route::get('projects/{project}/commands/{step}', [
            'as'   => 'commands.step',
            'uses' => 'CommandController@index',
        ]);
        Route::post('commands/reorder', [
            'as'   => 'commands.reorder',
            'uses' => 'CommandController@reorder',
        ]);
        Route::post('environments/reorder', [
            'as'    => 'environments.reorder',
            'uses'  => 'EnvironmentController@reorder',
        ]);
        Route::get('projects/{project}/environments/{environment}/{tab?}', [
            'as'   => 'environments.show',
            'uses' => 'EnvironmentController@show',
        ]);

        // In both of template & project
        Route::post('environments', [
            'uses' => 'EnvironmentController@store',
        ]);
        Route::post('variables', [
            'uses' => 'VariableController@store',
        ]);
        Route::post('commands', [
            'uses' => 'CommandController@store',
        ]);
        Route::post('config-files', [
            'uses' => 'ConfigFileController@store',
        ]);
        Route::post('shared-files', [
            'uses' => 'SharedFileController@store',
        ]);

        Route::group(['middleware' => 'project.acl:manage',
            ], function () {
                Route::put('projects/{project}', [
                    'as'   => 'projects.update',
                    'uses' => 'ProjectController@update',
                ]);

                Route::delete('projects/{project}', [
                    'as'   => 'projects.destroy',
                    'uses' => 'ProjectController@destroy',
                ]);

                // Webhook
                Route::get('webhook/{project}/refresh', [
                    'middleware' => 'admin',
                    'as'         => 'webhook.refresh',
                    'uses'       => 'WebhookController@refresh',
                ]);

                // Member
                Route::post('members/{project}', [
                    'uses' => 'MemberController@store',
                ]);

                Route::delete('members/{project}/{user}', [
                    'uses' => 'MemberController@destroy',
                ]);


                // Hook
                Route::post('hooks/{project}', [
                    'uses' => 'HookController@store',
                ]);
                Route::put('hooks/{project}/{hook}', [
                    'uses' => 'HookController@update',
                ]);
                Route::delete('hooks/{project}/{hook}', [
                    'uses' => 'HookController@destroy',
                ]);

                // Refresh
                Route::get('repository/{id}/refresh', [
                    'as'     => 'repository.refresh',
                    'uses'   => 'RepositoryController@refresh',
                    'middle' => 'api',
                ]);

                // Environment
                Route::put('environments/{environment}', [
                    'uses' => 'EnvironmentController@update',
                ]);
                Route::delete('environments/{environment}', [
                    'uses' => 'EnvironmentController@destroy',
                ]);

                // Variable
                Route::put('variables/{variable}', [
                    'uses' => 'VariableController@update',
                ]);
                Route::delete('variables/{variable}', [
                    'uses' => 'VariableController@destroy',
                ]);

                // Command
                Route::put('commands/{command}', [
                    'uses' => 'CommandController@update',
                ]);
                Route::delete('commands/{command}', [
                    'uses' => 'CommandController@destroy',
                ]);

                // SharedFile
                Route::put('shared-files/{shared_file}', [
                    'uses' => 'SharedFileController@update',
                ]);
                Route::delete('shared-files/{shared_file}', [
                    'uses' => 'SharedFileController@destroy',
                ]);

                // ConfigFile
                Route::put('config-files/{config_file}', [
                    'uses' => 'ConfigFileController@update',
                ]);
                Route::delete('config-files/{config_file}', [
                    'uses' => 'ConfigFileController@destroy',
                ]);
            });
    });
