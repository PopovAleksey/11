@extends('constructor.base')

@section('title', 'Page Types | Simple Page | ' . $data->getName())
@section('page-title', 'Simple Page | ' . $data->getName())

@section('css')
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
    <style>
        .bootstrap-switch-container {
            display: contents;
        }
    </style>
@stop

@section('js')
    <!-- SweetAlert2 -->
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- Toastr -->
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>

    <script>
        $(function () {

            function createNameFieldForm(dataId, inputValue) {
                let nameForm = document.createElement('div');
                nameForm.classList.add('input-group', 'mb-3');

                let nameInput = document.createElement('input');
                nameInput.classList.add('form-control');
                nameInput.setAttribute('type', 'text');
                nameInput.setAttribute('id', 'field-name');
                nameInput.setAttribute('name', 'name');
                nameInput.setAttribute('data-id', dataId);
                nameInput.setAttribute('value', inputValue);

                let removeElement = document.createElement('div');
                removeElement.classList.add('input-group-prepend');

                let removeButton = document.createElement('button');
                removeButton.classList.add('btn', 'btn-danger');
                removeButton.setAttribute('id', 'remove-element');
                removeButton.setAttribute('data-id', dataId);

                let removeButtonText = document.createTextNode('Remove Field');

                let removeButtonIcon = document.createElement('i');
                removeButtonIcon.classList.add('far', 'fa-trash-alt');

                removeButton.appendChild(removeButtonIcon);
                removeButton.appendChild(removeButtonText);
                removeElement.appendChild(removeButton);
                nameForm.appendChild(nameInput)
                nameForm.appendChild(removeElement);

                return nameForm;
            }

            function createTypeFieldForm(dataId, selectedType = null) {
                let typeForm = document.createElement('div');
                typeForm.classList.add('form-group');

                let selectTypes = document.createElement('select');
                selectTypes.classList.add('form-control');
                selectTypes.setAttribute('id', 'field-type');
                selectTypes.setAttribute('name', 'type');
                selectTypes.setAttribute('data-id', dataId);
                Object.entries({
                    input: 'Input',
                    textarea: 'Textarea',
                    select: 'Select',
                    selectMultiple: 'Select Multiple',
                    radio: 'Radio',
                    checkbox: 'Checkbox',
                    file: 'File'
                }).forEach(function ([type, value]) {
                    let selectOption = document.createElement('option');
                    selectOption.setAttribute('value', type);
                    selectOption.innerText = value;

                    if (type === selectedType) {
                        selectOption.setAttribute('selected', true);
                    }
                    //@TODO Temporary Disabled elements with multiple values and file
                    if (type === 'selectMultiple' || type === 'checkbox' || type === 'file') {
                        selectOption.setAttribute('disabled', true);
                    }

                    selectTypes.appendChild(selectOption);
                });

                typeForm.appendChild(selectTypes);

                return typeForm;
            }

            let nextTab = 1;

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


                let nameForm = createNameFieldForm(nextTab, 'Tab ' + nextTab);
                let typeForm = createTypeFieldForm(nextTab);

                $('#vert-tabs-field-' + nextTab)
                    .html(nameForm)
                    .append(typeForm)
                    .append('<div class="row field-form" id="input-form">' +
                        '<div class="col-lg-4">' +
                        '<div class="input-group">' +
                        '<input type="text" name="value" placeholder="Default Value" class="form-control" />' +
                        '</div></div>' +
                        '<div class="col-lg-4"><div class="input-group">' +
                        '<input type="text" name="placeholder" placeholder="Placeholder" class="form-control" />' +
                        '</div></div>' +
                        '<div class="col-lg-4"><div class="input-group">' +
                        '<input type="text" name="mask" placeholder="Input Mask" class="form-control" />' +
                        '</div></div></div>')
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

                $('#vert-tabs-tab a:last').tab('show');

                nextTab++;
            });

            $('button#remove-current-element').on('click', function () {
                var elementId = $(this).attr('data-id');

                $('#vert-tabs-tab a[href="#vert-tabs-current-field-' + elementId + '"]').remove();
                $('#vert-tabs-current-field-' + elementId).remove();

                $('#vert-tabs-tab a:last').tab('show');
            });

            $('input#field-name').on('change', function () {
                var elementAttrId = $(this).attr('data-id');
                var value = $(this).val();

                $('#vert-tabs-tab #current-field-name-' + elementAttrId).text(value === '' ? 'Tab ' + nextTab : value);
            });

            var Toast = Swal.mixin({
                toast: true,
                position: 'bottom',
                showConfirmButton: false,
                timer: 3000
            });

            $("form#fields-form").submit(function (event) {
                event.preventDefault();

                $('#add-element').prop("disabled", true);
                $('#save-fields').prop("disabled", true);

                let result = [];
                let json = {};

                let pageName = '';

                $.each($(this).serializeArray(), function (index, item) {
                    if (item.name === 'page-name') {
                        pageName = item.value;
                        return;
                    }

                    json[item.name] = item.value;
                    if (item.name === 'mask') {
                        result.push(json);
                        json = {};
                    }
                });

                $.ajax({
                    url: '{{ route('constructor_page_update', ['id' => $pageId]) }}',
                    type: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: {
                        'name': pageName,
                        'fields': result
                    },
                    success: function (response) {
                        if (response.id === undefined) {
                            $('#add-element').prop("disabled", false);
                            $('#save-fields').prop("disabled", false);
                            return;
                        }
                        location.href = '{{ route('constructor_page_edit', ':id') }}'.replace(':id', response.id);
                    },
                    error: function (error) {
                        Toast.fire({
                            icon: 'error',
                            title: error.responseJSON.message
                        });
                        $('#add-element').prop("disabled", false);
                        $('#save-fields').prop("disabled", false);
                    }
                });
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
                    <form id="fields-form">
                        <input type="hidden" name="page-name" value="{{$data->getName()}}"/>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5 col-sm-3">
                                    <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist"
                                         aria-orientation="vertical">
                                        <a class="nav-link active disabled" id="vert-tabs-settings-tab"
                                           data-toggle="pill"
                                           href="#vert-tabs-field-0" role="tab" aria-controls="vert-tabs-settings"
                                           aria-selected="false">Page's Fields</a>

                                        @foreach($data->getFields() as $field)
                                            <a class="nav-link" id="vert-tabs-settings-tab"
                                               data-toggle="pill"
                                               href="#vert-tabs-current-field-{{$field->getId()}}" role="tab"
                                               aria-controls="vert-tabs-settings"
                                               aria-selected="false">
                                                <strong id="current-field-name-{{$field->getId()}}">{{$field->getName()}}</strong>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-7 col-sm-9">
                                    <div class="tab-content" id="vert-tabs-tabContent">
                                        <div class="tab-pane fade show active" id="vert-tabs-field-0" role="tabpanel"
                                             aria-labelledby="vert-tabs-settings-tab">

                                        </div>
                                        @foreach($data->getFields() as $field)
                                            <div class="tab-pane fade" id="vert-tabs-current-field-{{$field->getId()}}"
                                                 role="tabpanel"
                                                 aria-labelledby="vert-tabs-settings-tab">
                                                <div class="input-group mb-3">
                                                    <input type="hidden" name="id" value="{{$field->getId()}}">
                                                    <input class="form-control" type="text"
                                                           id="field-name" name="name" data-id="{{$field->getId()}}"
                                                           value="{{$field->getName()}}">
                                                    <div class="input-group-prepend">
                                                        <button class="btn btn-danger" id="remove-current-element"
                                                                data-id="{{$field->getId()}}">
                                                            <i class="far fa-trash-alt"></i>Remove Field
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <select class="form-control" id="field-type" name="type"
                                                            data-id="{{$field->getId()}}">
                                                        <option value="input" {{$field->getType() == 'input' ? 'selected' : ''}}>
                                                            Input
                                                        </option>
                                                        <option value="textarea" {{$field->getType() == 'textarea' ? 'selected' : ''}}>
                                                            Textarea
                                                        </option>
                                                        <option value="select" {{$field->getType() == 'select' ? 'selected' : ''}}>
                                                            Select
                                                        </option>
                                                        {{--@TODO Temporary Disabled elements with multiple values and file--}}
                                                        <option value="selectMultiple" {{$field->getType() == 'selectMultiple' ? 'selected' : ''}} disabled>
                                                            Select Multiple
                                                        </option>
                                                        <option value="radio" {{$field->getType() == 'radio' ? 'selected' : ''}}>
                                                            Radio
                                                        </option>
                                                        {{--@TODO Temporary Disabled elements with multiple values and file--}}
                                                        <option value="checkbox" {{$field->getType() == 'checkbox' ? 'selected' : ''}} disabled>
                                                            Checkbox
                                                        </option>
                                                        {{--@TODO Temporary Disabled elements with multiple values and file--}}
                                                        <option value="file" {{$field->getType() == 'file' ? 'selected' : ''}} disabled>
                                                            File
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="row field-form" id="input-form">
                                                    <div class="col-lg-4">
                                                        <div class="input-group">
                                                            <input type="text" name="value" placeholder="Default Value"
                                                                   class="form-control"
                                                                   value="{{ in_array($field->getType(), ['input', 'textarea']) ? $field->getInputValue() : $field->getListValue()}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="input-group">
                                                            <input type="text" name="placeholder"
                                                                   placeholder="Placeholder"
                                                                   class="form-control"
                                                                   value="{{$field->getPlaceholder()}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="input-group">
                                                            <input type="text" name="mask" placeholder="Input Mask"
                                                                   class="form-control" value="{{$field->getMask()}}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body row">
                            <div class="col-md-6">
                                <button type="button" class="btn btn-block btn-info btn-sm" id="add-element">
                                    Add Field
                                </button>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-block btn-success btn-sm" id="save-fields">
                                    Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
@endsection
