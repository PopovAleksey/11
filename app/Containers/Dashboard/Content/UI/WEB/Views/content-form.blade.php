@extends('dashboard.base')

@section('title', 'Page Types | Simple Page | ' . $page->getName())
@section('page-title', 'Simple Page | ' . $page->getName())

@section('css')
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
@stop

@section('js')
    <!-- SweetAlert2 -->
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- Toastr -->
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>

    <script>
        $(function () {
            @foreach($languages as $language)
            @foreach($page->getFields() as $field)
            @if($field->getType() === \App\Containers\Constructor\Page\Models\PageFieldInterface::TEXTAREA_TYPE)
            $('textarea[name=field-{{ $language->getId() }}-{{ $field->getId() }}]').summernote({ height: 200 });
            @endif
            @endforeach
            @endforeach

            var Toast = Swal.mixin({
                toast: true,
                position: 'bottom',
                showConfirmButton: false,
                timer: 3000
            });

            $("form#content-form").submit(function (event) {
                event.preventDefault();

                $('#save-button').prop("disabled", true);

                let result = [];

                $.each($(this).serializeArray(), function (index, item) {
                    let name = item.name.split('-');
                    let languageId = name[1];
                    let fieldId = name[2];

                    let data = {
                        languageId: parseInt(languageId),
                        fieldId: parseInt(fieldId),
                        value: item.value
                    }

                    result.push(data);
                });

                $.ajax({
                    url: '{{ $contentId === null ? route('dashboard_content_store') : route('dashboard_content_update', ['id' => $contentId]) }}',
                    type: '{{ $contentId === null ? 'POST' : 'PATCH' }}',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: {
                        'pageId': {{ $pageId }},
                        'values': result
                    },
                    success: function (response) {
                        if (response.id === undefined) {
                            $('#save-button').prop("disabled", false);
                            return;
                        }
                        location.href = '{{ route('dashboard_content_edit', ':id') }}'.replace(':id', response.id);
                    },
                    error: function (error) {
                        Toast.fire({
                            icon: 'error',
                            title: error.responseJSON.message
                        });
                        $('#save-button').prop("disabled", false);
                    }
                });

            });
        });
    </script>
@stop

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">
        <a href="{{route('dashboard_page_show', ['id' => $pageId])}}">{{$page->getName()}}</a>
    </li>
@stop

@section('content')
    <div class="container-fluid">
        <form id="content-form">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary card-outline card-outline-tabs">
                        <div class="card-header p-0 border-bottom-0">
                            <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                                @foreach($languages as $language)
                                    <li class="nav-item">
                                        <a class="nav-link {{head($languages)?->getId() === $language->getId() ? 'active' : ''}}"
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
                                @foreach($languages as $language)
                                    <div class="tab-pane fade {{head($languages)?->getId() === $language->getId() ? 'show active' : ''}}"
                                         id="language-tab-{{ $language->getId() }}" role="tabpanel"
                                         aria-labelledby="language-tab-{{ $language->getId() }}-tab">
                                        <div class="card-body">
                                            @foreach($page->getFields() as $field)
                                                <div class="form-group">
                                                    <label for="field-{{ $language->getId() }}-{{ $field->getId() }}">{{ $field->getName() }}</label>
                                                    @php($formValue = data_get($values, [$language->getId(), $field->getId()])?->getValue())
                                                    @switch($field->getType())
                                                        @case(\App\Containers\Constructor\Page\Models\PageFieldInterface::INPUT_TYPE)
                                                        <input type="text" class="form-control"
                                                               name="field-{{ $language->getId() }}-{{ $field->getId() }}"
                                                               value="{{ $formValue ?? head($field->getValues()) }}"
                                                               placeholder="{{ $field->getPlaceholder() }}"/>
                                                        @break
                                                        @case(\App\Containers\Constructor\Page\Models\PageFieldInterface::TEXTAREA_TYPE)
                                                        <textarea class="form-control"
                                                                  name="field-{{ $language->getId() }}-{{ $field->getId() }}"
                                                                  placeholder="{{ $field->getPlaceholder() }}">
                                                        {{ $formValue ?? head($field->getValues()) }}
                                                    </textarea>
                                                        @break
                                                        @case(\App\Containers\Constructor\Page\Models\PageFieldInterface::SELECT_TYPE)
                                                        <select class="form-control"
                                                                name="field-{{ $language->getId() }}-{{ $field->getId() }}">
                                                            <option value="">{{ $field->getPlaceholder() }}</option>
                                                            @foreach($field->getValues() as $value)
                                                                <option value="{{ $value }}" {{ $formValue === $value ? 'selected' : '' }}>{{ $value }}</option>
                                                            @endforeach
                                                        </select>
                                                        @break
                                                        @case(\App\Containers\Constructor\Page\Models\PageFieldInterface::SELECT_MULTIPLE_TYPE)
                                                        <select multiple="" class="form-control"
                                                                name="field-{{ $language->getId() }}-{{ $field->getId() }}">
                                                            @foreach($field->getValues() as $value)
                                                                <option value="{{ $value }}" {{ $formValue === $value ? 'checked' : '' }}>{{ $value }}</option>
                                                            @endforeach
                                                        </select>
                                                        @break
                                                        @case(\App\Containers\Constructor\Page\Models\PageFieldInterface::RADIO_TYPE)
                                                        @foreach($field->getValues() as $value)
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                       name="field-{{ $language->getId() }}-{{ $field->getId() }}"
                                                                       value="{{ $value }}"
                                                                        {{ $formValue === $value ? ' checked' : '' }}/>
                                                                <label class="form-check-label">{{ $value }}</label>
                                                            </div>
                                                        @endforeach
                                                        @break
                                                        @case(\App\Containers\Constructor\Page\Models\PageFieldInterface::CHECKBOX_TYPE)
                                                        @foreach($field->getValues() as $value)
                                                            <div class="form-check">
                                                                <input class="form-check-input"
                                                                       type="checkbox"
                                                                       name="field-{{ $language->getId() }}-{{ $field->getId() }}"
                                                                       value="{{ $value }}"
                                                                        {{ $formValue === $value ? ' checked' : '' }} />
                                                                <label class="form-check-label">{{ $value }}</label>
                                                            </div>
                                                        @endforeach
                                                        @break
                                                    @endswitch
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card card-outline">
                        <div class="card-body pad table-responsive col-12 col-md-3 align-self-end">
                            <button type="submit" class="btn btn-block btn-success" id="save-button">Save</button>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.col -->
            </div>
        </form>
    </div>
@endsection
