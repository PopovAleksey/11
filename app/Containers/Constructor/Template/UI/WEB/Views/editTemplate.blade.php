@extends('constructor.base')

@section('title', 'Theme ' . $template->getTheme()->getName() . ' | Template ' . $template->getType())
@section('page-title', 'Theme ' . $template->getTheme()->getName() . ' | Template ' . $template->getType() . ( $template->getType() === \App\Containers\Constructor\Template\Models\TemplateInterface::PAGE_TYPE ? ' [' . $template?->getPage()->getName() . ']' : ''))

@section('css')
    <!-- CodeMirror -->
    <link rel="stylesheet" href="{{ asset('plugins/codemirror/codemirror.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/codemirror/theme/monokai.css') }}">
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

    <script>
        $(function () {
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

            $('button#blog-content').on('click', function () {
                code.replaceSelection('{CONTENT_LIST}');
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
                        @if($template->getPage()->getType() === \App\Containers\Constructor\Page\Models\PageInterface::BLOG_TYPE)
                        <div class="btn-group margin-10">
                            <button type="button" class="btn btn-info" id="page-content" data-id="">Content</button>
                        </div>
                        @endif
                        <div class="btn-group margin-10">
                            @foreach($template->getPage()->getFields() as $field)
                                <button type="button" class="btn btn-default" id="blog-field"
                                        data-id="{{$field->getId()}}">{{$field->getName()}}</button>
                            @endforeach
                        </div>
                    </div>
                    <div class="card-body">
                        <textarea id="code" class="p-3">{{ $template->getHtml() }}</textarea>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success float-right">Save</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
