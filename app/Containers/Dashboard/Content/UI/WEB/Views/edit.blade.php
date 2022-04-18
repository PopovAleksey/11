@extends('dashboard.base')

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
                }).forEach(function ([key, value]) {
                    let selectOption = document.createElement('option');
                    selectOption.setAttribute('value', key);
                    selectOption.innerText = value;

                    if (key === selectedType) {
                        selectOption.setAttribute('selected', true);
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

                console.log(JSON.stringify(result));
            });
        });
    </script>
@stop

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">
        <a href="{{route('dashboard_page_show', ['id' => $pageId])}}">{{$data->getName()}}</a>
    </li>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-12">
                <div class="card card-primary card-outline card-outline-tabs">
                    <div class="card-header p-0 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                            @foreach($languageList as $language)
                                <li class="nav-item">
                                    <a class="nav-link {{head($languageList)?->getId() === $language->getId() ? 'active' : ''}}"
                                       id="language-tab-{{ $language->getId() }}-tab"
                                       data-toggle="pill" href="#language-tab-{{ $language->getId() }}" role="tab"
                                       aria-controls="custom-tabs-four-home"
                                       aria-selected="true">{{ $language->getName() }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-four-tabContent">
                            @foreach($languageList as $language)
                                <div class="tab-pane fade {{head($languageList)?->getId() === $language->getId() ? 'show active' : ''}}"
                                     id="language-tab-{{ $language->getId() }}" role="tabpanel"
                                     aria-labelledby="language-tab-{{ $language->getId() }}-tab">
                                    @foreach($data->getFields() as $field)
                                        {{ $field->getName() }}<br>
                                        {{ $field->getType() }}<br>
                                        {{ $field->getPlaceholder() }}<br><br>
                                    @endforeach
                                    {{ $language->getName() }}
                                    {{ $language->getShortName() }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
