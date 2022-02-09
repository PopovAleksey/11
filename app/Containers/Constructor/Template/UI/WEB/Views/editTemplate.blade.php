@extends('constructor.base')

@section('title', 'Theme ' . $template->getTheme()->getName() . ' | Template ' . $template->getType())
@section('page-title', 'Theme ' . $template->getTheme()->getName() . ' | Template ' . $template->getType() . ( $template->getType() === \App\Containers\Constructor\Template\Models\TemplateInterface::PAGE_TYPE ? ' [' . $template?->getPage()->getName() . ']' : ''))

@section('css')
    <!-- CodeMirror -->
    <link rel="stylesheet" href="{{ asset('plugins/codemirror/codemirror.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/codemirror/theme/monokai.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
    <style>
        .card-body {
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

            // CodeMirror
            let code = CodeMirror.fromTextArea(document.getElementById("code"), {
                lineNumbers: true,
                mode: "htmlmixed",
                theme: "default",
            });
            code.setSize(null, 600);

            $('button#page-field').on('click', function () {
                let fieldId = $(this).attr('data-id');
                code.replaceSelection('{FIELD_' + fieldId + '}');
            });

            $('button#insert-content').on('click', function () {
                let content = $(this).attr('data-value');
                code.replaceSelection(content);
            });

            $('button#submit').on('click', function () {

                $(this).prop("disabled", true);

                $.ajax({
                    url: '{{ route('constructor_template_update', ':id') }}'.replace(':id', {{$template->getId()}}),
                    type: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: {
                        'html': code.getValue()
                    },
                    success: function (response) {
                        if (response.id === undefined) {
                            $('button#submit').prop("disabled", false);
                            return;
                        }
                        location.href = '{{ route('constructor_template_edit', ':id') }}'.replace(':id', response.id);
                    },
                    error: function (error) {
                        Toast.fire({
                            icon: 'error',
                            title: error.responseJSON.message
                        });
                        $('button#submit').prop("disabled", false);
                    }
                });
            });
        })
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
    <li class="breadcrumb-item active">{{ $template->getType() }}{{ $template->getType() === \App\Containers\Constructor\Template\Models\TemplateInterface::PAGE_TYPE ? ' [' . $template?->getPage()->getName() . ']' : '' }}</li>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        @if($template->getType() === \App\Containers\Constructor\Template\Models\TemplateInterface::BASE_TYPE)
                            <div class="btn-group margin-10">
                                <button type="button" class="btn btn-info" id="insert-content" data-value="{CONTENT}">Content</button>
                                <button type="button" class="btn btn-info" id="insert-content" data-value="{JAVASCRIPT}">JS</button>
                                <button type="button" class="btn btn-info" id="insert-content" data-value="{CSS}">CSS</button>
                            </div>
                        @elseif($template->getPage()?->getType() === \App\Containers\Constructor\Page\Models\PageInterface::BLOG_TYPE)
                            <div class="btn-group margin-10">
                                <button type="button" class="btn btn-info" id="insert-content"
                                        data-value="{CONTENT_LIST}">Content
                                </button>
                            </div>
                        @endif
                        <div class="btn-group margin-10">
                            @if($template->getPage() !== null)
                                @foreach($template->getPage()?->getFields() as $field)
                                    <button type="button" class="btn btn-default" id="page-field"
                                            data-id="{{$field->getId()}}">{{$field->getName()}}</button>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <textarea id="code" class="p-3">{{ $template->getHtml() }}</textarea>
                    </div>
                    <div class="card-footer">
                        <button id="submit" class="btn btn-success float-right">Save</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
