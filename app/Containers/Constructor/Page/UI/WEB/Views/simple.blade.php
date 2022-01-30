@extends('constructor.base')

@section('title', 'Page Types | Simple Page | ' . $data->getName())
@section('page-title', 'Simple Page | ' . $data->getName())

@section('css')
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
    <style>
        .bootstrap-switch-container {
            display: contents;
        }
    </style>
@stop

@section('js')

    <!-- Toastr -->
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>

    <script>
        $(function () {
            var nextTab = 1;

            $('button#add-element').on('click', function () {
                $('#vert-tabs-tab a:last')
                    .clone()
                    .attr('href', '#vert-tabs-field-' + nextTab)
                    .removeClass("active disabled")
                    .html('<strong id="field-name-' + nextTab + '">Tab ' + nextTab + '</strong>')
                    .appendTo('#vert-tabs-tab');

                $('#vert-tabs-tabContent .tab-pane:last')
                    .clone()
                    .attr('id', 'vert-tabs-field-' + nextTab)
                    .removeClass("active disabled")
                    .html('')
                    .appendTo('#vert-tabs-tabContent');

                $('#vert-tabs-field-' + nextTab)
                    .html('<div class="input-group mb-3">' +
                        '<input type="text" class="form-control" id="field-name" data-id="' + nextTab + '" value="Tab ' + nextTab + '">' +
                        '<div class="input-group-prepend">' +
                        '<button type="button" class="btn btn-danger" id="remove-element" data-id="' + nextTab + '">' +
                        '<i class="far fa-trash-alt"></i> Remove Element' +
                        '</button>' +
                        '</div></div>')
                    .append('<div class="form-group">' +
                        '<select class="form-control" id="field-type" data-id="' + nextTab + '">' +
                        '<option value="input">Input</option>' +
                        '<option value="textarea">Textarea</option>' +
                        '<option value="select">Select</option>' +
                        '<option value="select-multiple">Select Multiple</option>' +
                        '<option value="radio">Radio</option>' +
                        '<option value="checkbox">Checkbox</option>' +
                        '<option value="file">File</option>' +
                        '</select></div><hr>')
                    .append('<div class="row" id="input-form">' +
                        '<div class="col-lg-4">' +
                        '<div class="input-group">' +
                        '<div class="input-group-prepend">' +
                        '<span class="input-group-text"><input type="checkbox" checked="checked" /></span>' +
                        '</div>' +
                        '<input type="text" name="value" placeholder="Default Value" class="form-control" />' +
                        '</div></div>' +
                        '<div class="col-lg-4"><div class="input-group">' +
                        '<input type="text" name="placeholder" placeholder="Placeholder" class="form-control" />' +
                        '</div></div>' +
                        '<div class="col-lg-4"><div class="input-group">' +
                        '<input type="text" name="mask" placeholder="Input Mask" class="form-control" />' +
                        '</div></div></div>')
                    .append('<div class="row" id="textarea-form" style="display: none;">' +
                        '<div class="col-lg-4">' +
                        '<div class="input-group">' +
                        '<div class="input-group-prepend">' +
                        '<span class="input-group-text"><input type="checkbox" checked="checked" /></span>' +
                        '</div>' +
                        '<input type="text" name="value" placeholder="Default Value" class="form-control" />' +
                        '</div></div>' +
                        '<div class="col-lg-4"><div class="input-group">' +
                        '<input type="text" name="placeholder" placeholder="Placeholder" class="form-control" />' +
                        '</div></div></div>')
                    .append('<div class="row" id="select-radio-checkbox-form" style="display: none;">' +
                        '<div class="col-lg-4">' +
                        '<div class="input-group">' +
                        '<div class="input-group-prepend">' +
                        '<span class="input-group-text"><input type="checkbox" checked="checked" /></span>' +
                        '</div>' +
                        '<input type="text" name="value" placeholder="Possible Values Separete ;" class="form-control" />' +
                        '</div></div</div>')
                ;


                $('button#remove-element').on('click', function () {
                    var elementId = $(this).attr('data-id');

                    $('#vert-tabs-tab a[href="#vert-tabs-field-' + elementId + '"]').remove();
                    $('#vert-tabs-field-' + elementId).remove();

                    $('#vert-tabs-tab a:last').tab('show');
                });

                $('input#field-name').on('change', function () {
                    var elementAttrId = $(this).attr('data-id');
                    var value = $(this).val();

                    $('#vert-tabs-tab #field-name-' + elementAttrId).text(value === '' ? 'Tab ' + nextTab : value);
                });

                $('select#field-type').on('change', function () {
                    var elementAttrId = $(this).attr('data-id');
                    var value = $(this).val();

                    var inputForm = $('#vert-tabs-field-' + elementAttrId + ' div#input-form');
                    var textareaForm = $('#vert-tabs-field-' + elementAttrId + ' div#textarea-form');
                    var selectForm = $('#vert-tabs-field-' + elementAttrId + ' div#select-radio-checkbox-form');

                    inputForm.hide();
                    textareaForm.hide();
                    selectForm.hide();

                    switch (value) {
                        case 'input':
                            inputForm.show();
                            break;
                        case 'textarea':
                            textareaForm.show();
                            break;
                        case 'select':
                        case 'select-multiple':
                        case 'radio':
                        case 'checkbox':
                            selectForm.show();
                            break;

                    }
                });

                $('#vert-tabs-tab a:last').tab('show');

                nextTab++;
            });
        });
    </script>
@stop

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active"><a href="{{route('constructor_page_index')}}">Page Types</a></li>
    <li class="breadcrumb-item active">Simple Page</li>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5 col-sm-3">
                                <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist"
                                     aria-orientation="vertical">
                                    <a class="nav-link active disabled" id="vert-tabs-settings-tab" data-toggle="pill"
                                       href="#vert-tabs-field-0" role="tab" aria-controls="vert-tabs-settings"
                                       aria-selected="false">Page's Fields</a>
                                </div>
                                <button type="button" class="btn btn-block btn-info btn-sm" id="add-element">
                                    Add element
                                </button>
                            </div>
                            <div class="col-7 col-sm-9">
                                <div class="tab-content" id="vert-tabs-tabContent">
                                    <div class="tab-pane fade show active" id="vert-tabs-field-1" role="tabpanel"
                                         aria-labelledby="vert-tabs-settings-tab">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
@endsection
