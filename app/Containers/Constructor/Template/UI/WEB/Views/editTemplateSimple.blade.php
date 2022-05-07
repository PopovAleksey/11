@extends('constructor@template::editTemplate')
@section('js')
    @parent
    <script>
        $(function () {
            @if($template->getType() === \App\Ship\Parents\Models\TemplateInterface::JS_TYPE)
            let CodeMirrorMode = 'javascript';
            @elseif($template->getType() === \App\Ship\Parents\Models\TemplateInterface::CSS_TYPE)
            let CodeMirrorMode = 'css';
            @else
            let CodeMirrorMode = 'htmlmixed';
            @endif
            // CodeMirror
            let code = CodeMirror.fromTextArea(document.getElementById("code"), {
                lineNumbers: true,
                mode: CodeMirrorMode,
                theme: "default",
                continueComments: "Enter",
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

        });
    </script>
@stop
@section('template-form')
    <div class="card">
        <div class="card-header">
            @if($template->getType() === \App\Ship\Parents\Models\TemplateInterface::BASE_TYPE)
                <div class="btn-group margin-10">
                    <button type="button" class="btn btn-info" id="insert-content" data-value="{CONTENT}">
                        Content
                    </button>
                    <button type="button" class="btn btn-info" id="insert-content" data-value="{JAVASCRIPT}">JS</button>
                    <button type="button" class="btn btn-info" id="insert-content" data-value="{CSS}">CSS</button>
                    <button type="button" class="btn btn-info" id="insert-content" data-value="{MENU}">Menu</button>
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
        <div class="card-body card-code">
            <textarea id="code" class="p-3">{{ $template->getName() }}</textarea>
        </div>
    </div>
@stop