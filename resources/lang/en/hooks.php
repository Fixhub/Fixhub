<?php

return [

    'label'                            => 'Hooks',
    'create'                           => 'Add a new hook',
    'create_slack'                     => 'Add a new Slack notification',
    'create_mail'                      => 'Add a new e-mail notification',
    'create_custom'                    => 'Add a new custom notification',
    'edit'                             => 'Edit the notification',
    'edit_slack'                       => 'Edit the Slack notification',
    'edit_mail'                        => 'Edit the e-mail notification',
    'edit_custom'                      => 'Edit the custom notification',
    'none'                             => 'The project does not currently have any notifications setup',
    'integration_help'                 => 'Hooks can be used for binding events when something is happening within the project.',
    'name'                             => 'Name',
    'type'                             => 'Type',
    'warning'                          => 'The notification could not be saved, please check the form below.',
    'not_configured_title'             => 'Service not configured',
    'not_configured'                   => 'The selected notification type can not be used as it has not been configured.',
    'triggers'                         => 'Triggers',
    'webhook'                          => 'Webhook URL',
    'icon'                             => 'Icon',
    'bot'                              => 'Bot',
    'icon_info'                        => 'Either an emoji, for example :ghost: or the URL to an image',
    'channel'                          => 'Channel',
    'deployments'                      => 'Deployments',
    'succeeded'                        => 'Succeeded',
    'failed'                           => 'Failed',
    'on_deployment_success'            => 'Deployment Succeeded',
    'on_deployment_failure'            => 'Deployment Failed',
    'custom'                           => 'Custom',
    'slack'                            => 'Slack',
    'mail'                             => 'E-mail',
    'which'                            => 'Which type of notification do you wish to add?',
    'test_subject'                     => 'Test Notification',
    'test_message'                     => 'This is a test to ensure the notification is setup correctly.',
    'enabled'                          => 'Hook enabled?',

    // Slack
    'branch'                           => 'Branch',
    'project'                          => 'Project',
    'commit'                           => 'Commit',
    'committer'                        => 'Committer',
    'deployment_details'               => 'Deployment details',
    'deployment_reason'                => 'Deployment reason - :reason',
    'deployment_success_slack_message' => ':white_check_mark: Deployment %s successful! :smile:',
    'deployment_failed_slack_message'  => ':x: Deployment %s failed! :cry:',

    // Email
    'project_name'                     => 'Project name',
    'deployed_branch'                  => 'Deployed branch',
    'deployment_details'               => 'View the deployment',
    'project_details'                  => 'View the project',
    'started_at'                       => 'Started at',
    'finished_at'                      => 'Finished at',
    'last_committer'                   => 'Last committer',
    'last_commit'                      => 'Last commit',
    'reason'                           => 'Deployment reason - :reason',
    'deployment_success_email_subject' => 'Deployment Finished',
    'deployment_success_email_message' => 'The deployment was successful',
    'deployment_failed_email_subject'  => 'Deployment Failed',
    'deployment_failed_email_message'  => 'The deployment has failed',
];
