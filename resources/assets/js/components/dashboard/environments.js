(function ($) {

    //Fix me please
    var FINISHED     = 0;
    var PENDING      = 1;
    var DEPLOYING    = 2;
    var FAILED       = 3;
    var NOT_DEPLOYED = 4;

    $('#environment_list table').sortable({
        containerSelector: 'table',
        itemPath: '> tbody',
        itemSelector: 'tr',
        placeholder: '<tr class="placeholder"/>',
        delay: 500,
        onDrop: function (item, container, _super) {
            _super(item, container);

            var ids = [];
            $('tbody tr td:first-child', container.el[0]).each(function (idx, element) {
                ids.push($(element).data('environment-id'));
            });

            $.ajax({
                url: '/environments/reorder',
                method: 'POST',
                data: {
                    environments: ids
                }
            });
        }
    });

    $('#environment').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var modal = $(this);
        var title = trans('environments.create');

        $('.btn-danger', modal).hide();
        $('.callout-danger', modal).hide();
        $('.has-error', modal).removeClass('has-error');
        $('.label-danger', modal).remove();
        $('#add-environment-command', modal).hide();

        if (button.hasClass('btn-edit')) {
            title = trans('environments.edit');
            $('.btn-danger', modal).show();
        } else {
            $('#environment_id').val('');
            $('#environment_name').val('');
            $('#environment_description').val('');
            $('#environment_default_on').prop('checked', true);
            $('#add-environment-command', modal).show();
        }

        modal.find('.modal-title span').text(title);
    });

    $('body').delegate('.environment-trash button.btn-delete','click', function (event) {
        var target = $(event.currentTarget);
        var icon = target.find('i');
        var dialog = target.parents('.modal');

        icon.removeClass().addClass('fixhub fixhub-load fixhub-spin');
        dialog.find('input').attr('disabled', 'disabled');
        $('button.close', dialog).hide();

        var environment = Fixhub.Environments.get($('#model_id').val());

        environment.destroy({
            wait: true,
            success: function(model, response, options) {
                dialog.modal('hide');
                $('.callout-danger', dialog).hide();

                icon.removeClass().addClass('fixhub fixhub-delete');
                $('button.close', dialog).show();
                dialog.find('input').removeAttr('disabled');

                Fixhub.toast(trans('environments.delete_success'));
            },
            error: function() {
               icon.removeClass().addClass('fixhub fixhub-delete');
                $('button.close', dialog).show();
                dialog.find('input').removeAttr('disabled');
            }
        });
    });

    $('#environment button.btn-save').on('click', function (event) {
        var target = $(event.currentTarget);
        var icon = target.find('i');
        var dialog = target.parents('.modal');

        icon.removeClass().addClass('fixhub fixhub-load fixhub-spin');
        dialog.find('input').attr('disabled', 'disabled');
        $('button.close', dialog).hide();

        var environment_id = $('#environment_id').val();

        if (environment_id) {
            var environment = Fixhub.Environments.get(environment_id);
        } else {
            var environment = new Fixhub.Environment();
        }

        environment.save({
            name:            $('#environment_name').val(),
            description:     $('#environment_description').val(),
            default_on:      $('#environment_default_on').is(':checked'),
            targetable_type: $('input[name="targetable_type"]').val(),
            targetable_id:   $('input[name="targetable_id"]').val(),
            add_commands:    $('#environment_commands').is(':checked')
        }, {
            wait: true,
            success: function(model, response, options) {
                dialog.modal('hide');
                $('.callout-danger', dialog).hide();

                icon.removeClass().addClass('fixhub fixhub-save');
                $('button.close', dialog).show();
                dialog.find('input').removeAttr('disabled');

                var msg = trans('environments.edit_success');
                if (!environment_id) {
                    Fixhub.Environments.add(response);
                    msg = trans('environments.create_success');
                }
                Fixhub.toast(msg);
            },
            error: function(model, response, options) {
                $('.callout-danger', dialog).show();

                var errors = response.responseJSON;

                $('.has-error', dialog).removeClass('has-error');
                $('.label-danger', dialog).remove();

                $('form input', dialog).each(function (index, element) {
                    element = $(element);

                    var name = element.attr('name');

                    if (typeof errors[name] !== 'undefined') {
                        var parent = element.parent('div');
                        parent.addClass('has-error');
                        parent.append($('<span>').attr('class', 'label label-danger').text(errors[name]));
                    }
                });

                icon.removeClass().addClass('fixhub fixhub-save');
                $('button.close', dialog).show();
                dialog.find('input').removeAttr('disabled');
            }
        });
    });

    Fixhub.Environment = Backbone.Model.extend({
        urlRoot: '/environments',
        initialize: function() {

        }
    });

    var Environments = Backbone.Collection.extend({
        model: Fixhub.Environment
    });

    Fixhub.Environments = new Environments();

    Fixhub.EnvironmentsTab = Backbone.View.extend({
        el: '#app',
        events: {

        },
        initialize: function() {
            this.$list = $('#environment_list tbody');

            $('#no_environments').show();
            $('#environment_list').hide();

            this.listenTo(Fixhub.Environments, 'add', this.addOne);
            this.listenTo(Fixhub.Environments, 'reset', this.addAll);
            this.listenTo(Fixhub.Environments, 'remove', this.addAll);
            this.listenTo(Fixhub.Environments, 'all', this.render);

            Fixhub.listener.on('environment:' + Fixhub.events.MODEL_CHANGED, function (data) {
                $('#environment_' + data.model.id).html(data.model.name);

                var environment = Fixhub.Environments.get(parseInt(data.model.id));

                if (environment) {
                    environment.set(data.model);
                }
            });

            Fixhub.listener.on('environment:' + Fixhub.events.MODEL_CREATED, function (data) {
                var targetable_type = $('input[name="targetable_type"]').val();
                var targetable_id = $('input[name="targetable_id"]').val();
                if (targetable_type == data.model.targetable_type && parseInt(data.model.targetable_id) === parseInt(targetable_id)) {
                    Fixhub.Environments.add(data.model);
                }
            });

            Fixhub.listener.on('environment:' + Fixhub.events.MODEL_TRASHED, function (data) {
                var environment = Fixhub.Environments.get(parseInt(data.model.id));

                if (environment) {
                    Fixhub.Environments.remove(environment);
                }
            });
        },
        render: function () {
            if (Fixhub.Environments.length) {
                $('#no_environments').hide();
                $('#environment_list').show();
            } else {
                $('#no_environments').show();
                $('#environment_list').hide();
            }
        },
        addOne: function (environment) {

            var view = new Fixhub.EnvironmentView({
                model: environment
            });

            this.$list.append(view.render().el);

            $('.server-names', this.$list).tooltip();
            
            if (Fixhub.Environments.length < 2) {
                $('.drag-handle', this.$list).hide();
            } else {
                $('.drag-handle', this.$list).show();
            }
        },
        addAll: function () {
            this.$list.html('');
            Fixhub.Environments.each(this.addOne, this);
        }
    });

    Fixhub.EnvironmentView = Backbone.View.extend({
        tagName:  'tr',
        events: {
            'click .btn-edit': 'edit',
            'click .btn-delete': 'trash'
        },
        initialize: function () {
            this.listenTo(this.model, 'change', this.render);
            this.listenTo(this.model, 'destroy', this.remove);

            this.template = _.template($('#environment-template').html());
        },
        render: function () {
            var data = this.model.toJSON();

            var parse_data = Fixhub.formatProjectStatus(parseInt(this.model.get('status')));
            data = $.extend(data, parse_data);

            data.last_run = data.last_run != null ? moment(data.last_run).fromNow() : trans('app.never');

            this.$el.html(this.template(data));

            return this;
        },
        edit: function() {
            $('#environment_id').val(this.model.id);
            $('#environment_name').val(this.model.get('name'));
            $('#environment_description').val(this.model.get('description'));
            $('#environment_default_on').prop('checked', (this.model.get('default_on') === true));
        },
        trash: function() {
            var target = $('#model_id');
            target.val(this.model.id);
            target.parents('.modal').removeClass().addClass('modal fade environment-trash');
        }
    });
})(jQuery);
