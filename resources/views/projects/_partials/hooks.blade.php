<div class="callout">
    <h4>{{ trans('hooks.integration_help') }}</h4>
</div>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">{{ trans('hooks.label') }}</h3>
        <div class="pull-right">
            <button type="button" class="btn btn-success" title="{{ trans('hooks.create') }}" data-toggle="modal" data-target="#hook"><span class="ion ion-plus"></span> {{ trans('hooks.create') }}</button>
        </div>
    </div>

    <div class="box-body" id="no_hooks">
        <p>{{ trans('hooks.none') }}</p>
    </div>

    <div class="box-body table-responsive">
        <table class="table table-striped" id="hook_list">
            <thead>
                <tr>
                    <th>{{ trans('hooks.name') }}</th>
                    <th>{{ trans('hooks.type') }}</th>
                    <th>{{ trans('hooks.enabled') }}</th>
                    <th class="text-center">{{ trans('hooks.on_deployment_success') }}</th>
                    <th class="text-center">{{ trans('hooks.on_deployment_failure') }}</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>

@push('templates')
    <script type="text/template" id="hook-template">
        <td><%- name %></td>
        <td><span class="ion ion-<%- icon %>"></span> <%- label %></td>
        <td><% if (enabled) { %>{{ trans('app.yes') }}<% } else { %>{{ trans('app.no') }}<% } %></td>
        <td class="text-center"><% if (on_deployment_success) { %><i class="ion ion-android-checkbox-outline"></i><% } else { %> <i class="ion ion-android-checkbox-outline-blank"></i> <% } %></td>
        <td class="text-center"><% if (on_deployment_failure) { %><i class="ion ion-android-checkbox-outline"></i><% } else { %> <i class="ion ion-android-checkbox-outline-blank"></i> <% } %></td>
        <td>
            <div class="btn-group pull-right">
                <button type="button" class="btn btn-default btn-edit" title="{{ trans('hooks.edit') }}" data-toggle="modal" data-backdrop="static" data-target="#hook"><i class="ion ion-edit"></i></button>
                <button type="button" class="btn btn-danger btn-delete" title="{{ trans('hooks.delete') }}" data-toggle="modal" data-backdrop="static" data-target="#model-trash"><i class="ion ion-trash-a"></i></button>
            </div>
        </td>
    </script>
@endpush