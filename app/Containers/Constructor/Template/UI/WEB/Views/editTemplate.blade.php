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
                        class="ml-1 cm-strong">{{ $template->getType() . ( $template->getType() === \App\Ship\Parents\Models\TemplateInterface::PAGE_TYPE ? ' [' . $template?->getPage()->getName() . ']' : '') }}</span></span>
        </div>
        <input type="text" class="form-control" placeholder="Enter Template Name..." id="theme-name"
               value="{{ $template->getName() }}"/>
        <div class="input-group-append">
            <button type="button" class="btn btn-warning" id="save-name">
                <i class="fas fa-circle-notch fa-spin" style="display: none;"></i>&nbsp;Save Name
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

            document.onkeydown = (e) => {
                if ((e.ctrlKey || e.metaKey) && e.key === 's') {
                    e.preventDefault();
                    saveTemplate(Toast);
                }
            }

            $('button#submit').on('click', () => saveTemplate(Toast));

            $('button#save-name').on('click', function () {
                $('button#save-name').prop("disabled", true);
                $('button#save-name i').show();

                let themeName = $('input#theme-name').val();

                $.ajax({
                    url: '{{ route('constructor_template_name_update', ['id' => $template->getId()]) }}',
                    type: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: {'name': themeName},
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

        function saveTemplate(Toast) {
            $(this).prop("disabled", true);

            console.log('Send HTML to save');
            Toast.fire({
                icon: 'error',
                title: 'Send HTML to save'
            });
            return;

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
                {{--<div class="card card-primary card-outline card-outline-tabs">
                    <div class="card-header p-0 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill"
                                   href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home"
                                   aria-selected="true">
                                    @if($template->getType() === \App\Ship\Parents\Models\TemplateInterface::MENU_TYPE)
                                        Common Menu Style
                                    @elseif($template->getPage()?->getType() === \App\Ship\Parents\Models\PageInterface::BLOG_TYPE)
                                        Common Page Style
                                    @endif
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill"
                                   href="#custom-tabs-four-profile" role="tab"
                                   aria-controls="custom-tabs-four-profile" aria-selected="false">
                                    @if($template->getType() === \App\Ship\Parents\Models\TemplateInterface::MENU_TYPE)
                                        Menu Item Style
                                    @elseif($template->getPage()?->getType() === \App\Ship\Parents\Models\PageInterface::BLOG_TYPE)
                                        Content Style
                                    @endif
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body card-code">
                        <div class="tab-content" id="custom-tabs-four-tabContent">
                            <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel"
                                 aria-labelledby="custom-tabs-four-home-tab">
                                @if($template->getType() === \App\Ship\Parents\Models\TemplateInterface::BASE_TYPE)
                                    <div class="btn-group margin-10">
                                        <button type="button" class="btn btn-info" id="insert-content"
                                                data-value="{CONTENT}">
                                            Content
                                        </button>
                                        <button type="button" class="btn btn-info" id="insert-content"
                                                data-value="{JAVASCRIPT}">JS
                                        </button>
                                        <button type="button" class="btn btn-info" id="insert-content"
                                                data-value="{CSS}">CSS
                                        </button>
                                        <button type="button" class="btn btn-info" id="insert-content"
                                                data-value="{MENU}">Menu
                                        </button>
                                    </div>
                                @elseif($template->getType() === \App\Ship\Parents\Models\TemplateInterface::MENU_TYPE)
                                    <div class="btn-group margin-10">
                                        <button type="button" class="btn btn-info" id="insert-content"
                                                data-value="{ITEMS}">
                                            Menu Items
                                        </button>
                                    </div>
                                @elseif($template->getPage()?->getType() === \App\Ship\Parents\Models\PageInterface::BLOG_TYPE)
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
                                <textarea id="code-main" class="p-3">{{ $template->getName() }}1</textarea>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel"
                                 aria-labelledby="custom-tabs-four-profile-tab">
                                @if($template->getType() === \App\Ship\Parents\Models\TemplateInterface::MENU_TYPE)
                                    <div class="btn-group margin-10">
                                        <button type="button" class="btn btn-info" id="insert-content"
                                                data-value="{LINK}">
                                            Link URL
                                        </button>
                                        <button type="button" class="btn btn-info" id="insert-content"
                                                data-value="{NAME}">Link Name
                                        </button>
                                    </div>
                                @endif
                                <div class="btn-group margin-10">
                                    @if($template->getChildPage() !== null)
                                        @foreach($template->getChildPage()?->getFields() as $field)
                                            <button type="button" class="btn btn-default" id="page-field"
                                                    data-id="{{$field->getId()}}">{{$field->getName()}}</button>
                                        @endforeach
                                    @endif
                                </div>
                                <textarea id="code-element" class="p-3">{{ $template->getName() }}2</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>--}}
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-outline">
                    <div class="card-body pad table-responsive col-12 col-md-3 align-self-end">
                        <button id="submit" type="submit" class="btn btn-block btn-success" id="save-button">Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
