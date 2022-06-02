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
    <!-- CodeMirror -->
    <script src="{{ asset('plugins/codemirror/codemirror.js') }}"></script>
    <script src="{{ asset('plugins/codemirror/mode/css/css.js') }}"></script>
    <script src="{{ asset('plugins/codemirror/mode/xml/xml.js') }}"></script>
    <script src="{{ asset('plugins/codemirror/mode/htmlmixed/htmlmixed.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- Toastr -->
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>

    <script>

        $(function () {
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
        });

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
@endsection
