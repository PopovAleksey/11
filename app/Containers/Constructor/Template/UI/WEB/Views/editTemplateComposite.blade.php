@extends('constructor@template::editTemplate')
@section('js')
    @parent
    <script>
        $(function () {
            // CodeMirror
            let code = CodeMirror.fromTextArea(document.getElementById("code"), {
                lineNumbers: true,
                mode: 'htmlmixed',
                theme: "default",
                continueComments: "Enter",
            });
            code.setSize(null, 600);

            let codePreview = CodeMirror.fromTextArea(document.getElementById("code-preview"), {
                lineNumbers: true,
                mode: 'htmlmixed',
                theme: "default",
                continueComments: "Enter",
            });
            codePreview.setSize(null, 600);

            let codeContent = CodeMirror.fromTextArea(document.getElementById("code-content"), {
                lineNumbers: true,
                mode: 'htmlmixed',
                theme: "default",
                continueComments: "Enter",
            });
            codeContent.setSize(null, 600);

            $('a.nav-link').on('click', function () {
                setInterval(() => code.refresh(), 500);
                setInterval(() => codePreview.refresh(), 500);
                setInterval(() => codeContent.refresh(), 500);
            });

            $('button#insert-common').on('click', function () {
                let content = $(this).attr('data-value');
                code.replaceSelection(content);
            });

            $('button#insert-preview').on('click', function () {
                let content = $(this).attr('data-value');
                codePreview.replaceSelection(content);
            });

            $('button#insert-content').on('click', function () {
                let content = $(this).attr('data-value');
                codeContent.replaceSelection(content);
            });

            let Toast = Swal.mixin({
                toast: true,
                position: 'bottom',
                showConfirmButton: false,
                timer: 3000
            });

            document.onkeydown = (e) => {
                if ((e.ctrlKey || e.metaKey) && e.key === 's') {
                    e.preventDefault();
                    saveTemplate(Toast, code.getValue(), codeContent.getValue(), codePreview.getValue());
                }
            }

            $('button#save-button').on('click', () => saveTemplate(Toast, code.getValue(), codeContent.getValue(), codePreview.getValue()));

        });
    </script>
@stop
@section('template-form')
    <div class="card card-primary card-outline card-outline-tabs">
        <div class="card-header p-0 border-bottom-0">
            <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill"
                       href="#custom-tabs-four-common" role="tab"
                       aria-controls="custom-tabs-four-home"
                       aria-selected="true">Common Page Style</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill"
                       href="#custom-tabs-four-preview" role="tab"
                       aria-controls="custom-tabs-four-profile"
                       aria-selected="false">Preview Content Style</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill"
                       href="#custom-tabs-four-content" role="tab"
                       aria-controls="custom-tabs-four-profile"
                       aria-selected="false">Content Page Style</a>
                </li>
            </ul>
        </div>
        <div class="card-body card-code">
            <div class="tab-content" id="custom-tabs-four-tabContent">
                <div class="tab-pane fade show active" id="custom-tabs-four-common" role="tabpanel"
                     aria-labelledby="custom-tabs-four-common-tab">
                    <div class="btn-group margin-10">
                        <button type="button" class="btn btn-info" id="insert-common"
                                data-value="{PREVIEWS}">
                            Previews Content List
                        </button>
                        @if($template->getPage() !== null)
                            @foreach($template->getPage()?->getFields() as $field)
                                <button type="button" class="btn btn-default" id="insert-common"
                                        data-value="{FIELD_{{$field->getId()}}}">
                                    {{$field->getName()}}&nbsp;<sup>ID: {{ $field->getId() }}</sup>
                                </button>
                            @endforeach
                        @endif
                    </div>
                    <textarea id="code" class="p-3">{{ $template->getCommonHtml() }}</textarea>
                </div>
                <div class="tab-pane fade" id="custom-tabs-four-preview" role="tabpanel"
                     aria-labelledby="custom-tabs-four-preview-tab">
                    <div class="btn-group margin-10">
                        <button type="button" class="btn btn-info" id="insert-preview" data-value="{LINK}">
                            Link URL
                        </button>
                        @if($template->getChildPage() !== null)
                            @foreach($template->getChildPage()?->getFields() as $field)
                                <button type="button" class="btn btn-default" id="insert-preview"
                                        data-value="{FIELD_{{$field->getId()}}}">
                                    {{$field->getName()}}&nbsp;<sup>ID: {{ $field->getId() }}</sup>
                                </button>
                            @endforeach
                        @endif
                    </div>
                    <textarea id="code-preview" class="p-3">{{ $template->getPreviewHtml() }}</textarea>
                </div>
                <div class="tab-pane fade" id="custom-tabs-four-content" role="tabpanel"
                     aria-labelledby="custom-tabs-four-content-tab">
                    <div class="btn-group margin-10">
                        @if($template->getChildPage() !== null)
                            @foreach($template->getChildPage()?->getFields() as $field)
                                <button type="button" class="btn btn-default" id="insert-content"
                                        data-value="{FIELD_{{$field->getId()}}}">
                                    {{$field->getName()}}&nbsp;<sup>ID: {{ $field->getId() }}</sup>
                                </button>
                            @endforeach
                        @endif
                    </div>
                    <textarea id="code-content" class="p-3">{{ $template->getElementHtml() }}</textarea>
                </div>
            </div>
        </div>
        <!-- /.card -->
    </div>
@stop