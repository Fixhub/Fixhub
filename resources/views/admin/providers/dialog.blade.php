<div class="modal fade" id="provider">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title"><i class="ion ion-ios-browsers-outline"></i> <span>{{ trans('providers.create') }}</span></h4>
            </div>
            <form role="form">
                <input type="hidden" id="provider_id" name="id" />
                <div class="modal-body">

                    <div class="callout callout-danger">
                        <i class="icon ion ion-alert"></i> {{ trans('providers.warning') }}
                    </div>

                    <div class="form-group">
                        <label for="provider_title">{{ trans('providers.name') }}</label>
                        <div class="input-group">
                            <div class="input-group-addon"><i class="ion ion-pricetag"></i></div>
                            <input type="text" class="form-control" name="title" id="provider_name" placeholder="{{ trans('providers.name') }}" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="provider_slug">{{ trans('providers.slug') }}</label>
                        <div class="input-group">
                            <div class="input-group-addon"><i class="ion ion-android-bookmark"></i></div>
                            <input type="text" class="form-control" name="slug" id="provider_slug" placeholder="{{ trans('providers.slug') }}" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="provider_icon">{{ trans('providers.icon') }}</label>
                        <div class="input-group">
                            <div class="input-group-addon"><i class="ion ion-image"></i></div>
                            <input type="text" class="form-control" name="icon" id="provider_icon" placeholder="ion-android-open" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="provider_description">{{ trans('providers.description') }}</label>
                        <div class="input-group">
                            <div class="input-group-addon"><i class="ion ion-ios-paper-outline"></i></div>
                            <input type="text" class="form-control" name="description" id="provider_description" placeholder="{{ trans('providers.description') }}" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary pull-left btn-save">{{ trans('app.save') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
