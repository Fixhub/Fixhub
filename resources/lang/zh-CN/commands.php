<?php

/*
 * This file is part of Fixhub.
 *
 * Copyright (C) 2016 Fixhub.org
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [

    'label'                => '部署步骤',
    'deploy_webhook'       => '第三方服务调用以下链接，触发Fixhub进行自动化部署工作。',
    'webhook_help'         => 'Webhook 帮助',
    'webhook_example'      => '以HTTP POST方式调用该URL, Fixhub会获取最近提交的代码，并自动触发部署工作。',
    'webhook_fields'       => 'POST参数说明(可选项)',
    'webhook_reason'       => '部署原因，尽可能简短地描述本次部署意图',
    'webhook_source'       => '触发该部署工作的来源 如： "CI Server"',
    'webhook_branch'       => '不填写将自动读取项目的默认分支',
    'webhook_update'       => '布尔值，是否仅部署更新, 默认为false',
    'webhook_url'          => 'webhook url, 将部署结果发送给其他服务',
    'webhook_commands'     => '用逗号分隔的命令ID列表',
    'webhook_optional'     => '可选的命令ID',
    'webhook_curl'         => 'cURL 调用范例',
    'reason_example'       => '例如: 系统测试',
    'generate_webhook'     => '重新生成一个webhook链接 (注意: 旧链接将失效)',
    'step'                 => '步骤',
    'current'              => '执行任务',
    'before'               => '前置任务',
    'name'                 => '名称',
    'run_as'               => '运行用户',
    'migrations'           => '数据迁移',
    'bash'                 => 'Bash脚本',
    'environments'         => '部署环境',
    'servers'              => '服务器',
    'default'              => '默认',
    'options'              => 'Bash脚本中可使用的变量 (点击查看)',
    'release_id'           => '发布版本',
    'release_path'         => '发布路径',
    'branch'               => '部署分支',
    'project_path'         => '项目路径',
    'after'                => '后置任务',
    'configure'            => '配置',
    'clone'                => '创建新版本',
    'install'              => '安装新版本',
    'activate'             => '激活新版本',
    'purge'                => '清理旧版本',
    'warning'              => '保存失败，请检查表单信息.',
    'create'               => '新增',
    'edit'                 => '编辑',
    'sha'                  => 'SHA哈希值',
    'short_sha'            => 'SHA哈希值(短)',
    'deployer_name'        => '上线发起者',
    'deployer_email'       => '上线发起者邮箱',
    'committer_name'       => '代码最后提交者',
    'committer_email'      => '代码最后提交者邮箱',
    'none'                 => '还没有配置安装命令',
    'optional'             => '该步骤是否为可选？',
    'example'              => '例如:',
    'optional_description' => '是可选步骤',
    'default_description'  => '默认选中',
    'services'             => 'Fixhub支持的服务',
    'services_description' => '一旦该 webhook 地址由上述服务调用, Fixhub会根据对方所传数据触发部署工作。' .
                              '注意：在请求中包含 &quot;<em>update_only</em>&quot; 和 &quot;<em>commands</em>&quot; 参数 ' .
                              ', 其他所有参数将被忽略.',

];
