<div class="modal fade" id="environment">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title"><i class="ion ion-plus"></i> <span>{{ trans('environments.create') }}</span></h4>
            </div>
            <form role="form">
                <input type="hidden" id="environment_id" name="id" />
                <input type="hidden" name="targetable_type" value="{{ $targetable_type }}" />
                <input type="hidden" name="targetable_id" value="{{ $targetable_id }}" />
                <div class="modal-body">

                    <div class="callout callout-danger">
                        <i class="icon ion ion-alert"></i> {{ trans('environments.warning') }}
                    </div>

                    <div class="form-group">
                        <label for="environment_name">{{ trans('environments.name') }}</label>
                        <input type="text" class="form-control" id="environment_name" name="name" placeholder="Environment name" />
                    </div>
                    <div class="form-group">
                        <label for="environment_description">{{ trans('environments.description') }}</label>
                        <input type="text" class="form-control" id="environment_description" name="description" placeholder="Description" />
                    </div>
                    <div class="form-group">
                        <label>{{ trans('environments.default_on') }}</label>
                        <div class="checkbox">
                            <label for="environment_default_on">
                                <input type="checkbox" value="1" name="default_on" id="environment_default_on" />
                                {{ trans('environments.default_description') }}
                            </label>
                        </div>
                        @if (Route::currentRouteName() == 'projects' && $project->commands->count() > 0)
                        <div class="checkbox" id="add-environment-command">
                            <label for="environment_commands">
                                <input type="checkbox" value="1" name="commands" id="environment_commands" checked />
                                {{ trans('environments.add_command') }}
                            </label>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary pull-left btn-save">{{ trans('app.save') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
