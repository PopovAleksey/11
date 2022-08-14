@extends('constructor.base')

@section('title', 'Theme ' . $template->getTheme()->getName() . ' | Template ' . $template->getType())
@section('page-title')
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">Theme<span
                        class="ml-1 cm-strong">{{ $template->getTheme()->getName() }}</span></span>
        </div>
        <div class="input-group-prepend">
            <span class="input-group-text">Type<span
                        class="ml-1 cm-strong">{{ $template->getType() . (in_array($template->getType(), [\App\Ship\Parents\Models\TemplateInterface::PAGE_TYPE, \App\Ship\Parents\Models\TemplateInterface::WIDGET_TYPE], true) ? ' [' . $template?->getPage()->getName() . ']' : '') }}</span></span>
        </div>
        <input type="text" class="form-control" placeholder="Enter Template Name..." id="theme-name"
               value="{{ $template->getName() }}"/>
        @if(isset($baseTemplates))
            <div class="input-group-prepend">
                <span class="input-group-text">Base Template</span>
            </div>
            <select id="base-template" class="form-control">
                @foreach($baseTemplates as $baseTemplate)
                    <option value="{{ $baseTemplate->getId() }}" {{ $template->getParentTemplateId() === $baseTemplate->getId() ? "selected='selected'" : '' }}>{{ $baseTemplate->getName() }}</option>
                @endforeach
            </select>
        @endif
        <div class="input-group-append">
            <button type="button" class="btn btn-warning" id="save-name">
                <i class="fas fa-circle-notch fa-spin" style="display: none;"></i>&nbsp;Save
            </button>
        </div>
    </div>
@stop
@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-switch/css/bootstrap3/bootstrap-switch.min.css') }}">

    <!-- CodeMirror -->
    <link rel="stylesheet" href="{{ asset('plugins/codemirror/codemirror.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/codemirror/theme/monokai.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
    <style>
        .card-code {
            padding: 0 !important;
        }

        .margin-10 {
            margin: 10px;
        }
    </style>
@stop

@section('js')
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    <!-- CodeMirror -->
    <script src="{{ asset('plugins/codemirror/codemirror.js') }}"></script>
    <script src="{{ asset('plugins/codemirror/mode/css/css.js') }}"></script>
    <script src="{{ asset('plugins/codemirror/mode/xml/xml.js') }}"></script>
    <script src="{{ asset('plugins/codemirror/mode/htmlmixed/htmlmixed.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- Toastr -->
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
    <!-- InputMask -->
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/inputmask/jquery.inputmask.min.js') }}"></script>

    <script>
        let codeMirror = null;

        $(function () {
            $("#table-point-list")
                .DataTable({
                    "responsive": true, "lengthChange": false, "autoWidth": false,
                })
                .buttons()
                .container();

            let Toast = Swal.mixin({
                toast: true,
                position: 'bottom',
                showConfirmButton: false,
                timer: 3000
            });

            $('button#save-name').on('click', function () {
                $('button#save-name').prop("disabled", true);
                $('button#save-name i').show();

                let themeName = $('input#theme-name').val();
                let baseTemplate = $('select#base-template').val();

                $.ajax({
                    url: '{{ route('constructor_template_name_update', ['id' => $template->getId()]) }}',
                    type: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: {
                        'name': themeName,
                        'parent_template_id': baseTemplate
                    },
                    success: function () {
                        $('button#save-name').prop("disabled", false);
                        $('button#save-name i').hide();
                        Toast.fire({
                            icon: 'success',
                            title: 'Saved Success!'
                        });
                    },
                    error: function (error) {
                        Toast.fire({
                            icon: 'error',
                            title: error.responseJSON.message
                        });
                        $('button#save-name').prop("disabled", false);
                        $('button#save-name i').hide();
                    }
                });
            });

            $('input#custom-point').inputmask({regex: "^[a-zA-Z0-9.]+$", placeholder: ""});

            $('input#custom-point').on('blur', function () {
                let point = $('input#custom-point').val();

                if (point === '') {
                    return;
                }

                $('span#point-error').hide();
                $('div#modal-localization-point input#custom-point').prop("disabled", true).removeClass('is-valid is-invalid');
                $('div#modal-localization-point button#save-insert-custom-point').prop("disabled", true);
                $('div#modal-localization-point button#save-insert-custom-point i').show();
                $('div#modal-localization-point button#save-insert-custom-point span').text('Checking...')

                $.ajax({
                    url: '{{ route('constructor_localization_is_exists') }}',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: {
                        'point': point,
                        'theme_id': '{{ $template->getTheme()->getId() }}'
                    },
                    success: function (response) {
                        let isExists = response.exists;

                        if (isExists === false) {
                            $('span#point-error').hide();
                            $('div#modal-localization-point input#custom-point').addClass('is-valid');
                            $('div#modal-localization-point button#save-insert-custom-point').prop("disabled", false);
                        } else {
                            $('div#modal-localization-point input#custom-point').addClass('is-invalid');
                            $('span#point-error').show();
                        }

                        $('div#modal-localization-point select').prop("disabled", false);
                        $('div#modal-localization-point input#custom-point').prop("disabled", false);
                        $('div#modal-localization-point button#save-insert-custom-point i').hide();
                        $('div#modal-localization-point button#save-insert-custom-point span').text('Save and Insert');
                    },
                    error: function (error) {
                        Toast.fire({
                            icon: 'error',
                            title: error.responseJSON.message
                        })

                        $('div#modal-localization-point input#point').addClass('is-invalid');
                        $('div#modal-localization-point button#save-localization-button').prop("disabled", false);
                        $('div#modal-localization-point button#save-localization-button i').hide();
                        $('div#modal-localization-point button#save-localization-button span').text('Save and Insert');
                    }
                });
            });

            $('button#insert-point').on('click', function () {
                let content = $(this).attr('data-value');
                if (codeMirror instanceof CodeMirror) {
                    codeMirror.replaceSelection(content);
                }
                $('#modal-localization-point').modal('hide');
            });

            $('div#modal-localization-point button#save-insert-custom-point').on('click', function () {
                let point = $('input#custom-point').val();

                if (point === '') {
                    return;
                }

                let values = [];
                let defaultValue = null;

                $('div#modal-localization-point input#custom-point').prop("disabled", true).removeClass('is-valid is-invalid');
                $('div#modal-localization-point button#save-insert-custom-point').prop("disabled", true);
                $('div#modal-localization-point button#save-insert-custom-point i').show();
                $('div#modal-localization-point button#save-insert-custom-point span').text('Saving...')

                $('input#custom-point-translation').each(function () {
                    values.push({
                        'language_id': $(this).attr('data-id'),
                        'value': $(this).val()
                    });
                    defaultValue = defaultValue ?? $(this).val();
                });

                $.ajax({
                    url: '{{ route('constructor_localization_store') }}',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: {
                        'point': point,
                        'theme_id': {{ $template->getThemeId() }},
                        'values': values
                    },
                    success: function () {
                        if (codeMirror instanceof CodeMirror) {
                            codeMirror.replaceSelection('{L_' + point + '}' + defaultValue + '{L}');
                        }
                        $('div#modal-localization-point select').prop("disabled", false);
                        $('div#modal-localization-point input#custom-point').prop("disabled", false);
                        $('div#modal-localization-point button#save-insert-custom-point').prop("disabled", false);
                        $('div#modal-localization-point button#save-insert-custom-point i').hide();
                        $('div#modal-localization-point button#save-insert-custom-point span').text('Save and Insert');
                        $('#modal-localization-point').modal('hide');
                    },
                    error: function (error) {
                        Toast.fire({
                            icon: 'error',
                            title: error.responseJSON.message
                        });
                        $('div#modal-localization-point select').prop("disabled", false);
                        $('div#modal-localization-point input#custom-point').prop("disabled", false);
                        $('div#modal-localization-point button#save-insert-custom-point i').hide();
                        $('div#modal-localization-point button#save-insert-custom-point span').text('Save and Insert');
                    }
                });
            });
        });

        function setCodeMirrorTarget(target) {
            if (target instanceof CodeMirror) {
                codeMirror = target;
            }
        }

        function saveTemplate(Toast, commonHtml, elementHtml = null, previewHtml = null) {
            $('button#save-button').prop("disabled", true);
            $('button#save-button i').show();

            let themeName = $('input#theme-name').val();
            let baseTemplate = $('select#base-template').val();
            let widgetCountElement = $('input#widget-count').val();
            let widgetShowBy = $('select#widget-show-by').val();

            $.ajax({
                url: '{{ route('constructor_template_update', ':id') }}'.replace(':id', {{$template->getId()}}),
                type: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    'name': themeName,
                    'parent_template_id': baseTemplate,
                    'commonHtml': commonHtml,
                    'elementHtml': elementHtml,
                    'previewHtml': previewHtml,
                    'widget': {
                        'count': widgetCountElement ? parseInt(widgetCountElement) : null,
                        'show_by': widgetShowBy ?? null
                    }
                },
                success: function () {
                    $('button#save-button').prop("disabled", false);
                    $('button#save-button i').hide();
                    Toast.fire({
                        icon: 'success',
                        title: 'Saved Success!'
                    });
                },
                error: function (error) {
                    Toast.fire({
                        icon: 'error',
                        title: error.responseJSON.message
                    });
                    $('button#save-button').prop("disabled", false);
                    $('button#save-button i').hide();
                }
            });
        }
    </script>
@stop

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('constructor_template_index') }}">Themes</a></li>
    <li class="breadcrumb-item">
        <a href="{{ route('constructor_theme_edit', ['id' => $template->getTheme()->getId()]) }}">
            {{ $template->getTheme()->getName() }}
        </a>
    </li>
    <li class="breadcrumb-item active">{{ $template->getName() }}</li>
@stop

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @yield('template-form')
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-outline">
                    <div class="card-body pad table-responsive col-12 col-md-3 align-self-end">
                        <button type="submit" class="btn btn-block btn-success" id="save-button">
                            <i class="fas fa-circle-notch fa-spin" style="display: none;"></i>&nbsp;Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-localization-point">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-body border-bottom">
                    <table id="table-point-list" class="table table-sm table-bordered table-hover">
                        <thead>
                        <tr>
                            <th class="w-25">Point</th>
                            <th class="w-50">Translate</th>
                            <th class="w-25">Insert</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($localizationList as $point)
                            <tr>
                                <td class="text-right text-bold">{{ $point->getPoint() }}</td>
                                <td>{{ $point->getValues()?->first()?->getValue() }}</td>
                                <td>
                                    <button class="btn btn-sm btn-block bg-gradient-success w-100" id="insert-point"
                                            data-value="{L_{{ $point->getPoint() }}}{{ $point->getValues()?->first()?->getValue() }}{L}">
                                        <i class="fas fa-file-import"></i>&nbsp;
                                        Insert
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-body">
                    <label>Custom Point:</label>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend w-25">
                                <span class="input-group-text w-100">Point:</span>
                            </div>
                            <input type="text" class="form-control w-75" id="custom-point" placeholder="Enter Point">
                            <span id="point-error" style="display: none"
                                  class="error invalid-feedback">Point is exists!</span>
                        </div>
                    </div>
                    <div class="form-group">
                        @foreach($languages as $language)
                            <div class="input-group">
                                <div class="input-group-prepend w-25">
                                    <span class="input-group-text w-100">{{ $language->getName() }}:</span>
                                </div>
                                <input type="text" class="form-control w-75" id="custom-point-translation"
                                       data-id="{{ $language->getId() }}" placeholder="Enter Translation">
                            </div>
                        @endforeach
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <button type="submit" class="btn btn-block btn-success form-control w-25"
                                    id="save-insert-custom-point" disabled>
                                <i class="fas fa-circle-notch fa-spin" style="display: none;"></i>
                                <span>Save and Insert</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection
