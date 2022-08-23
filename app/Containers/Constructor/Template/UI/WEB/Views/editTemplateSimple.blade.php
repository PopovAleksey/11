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

            $('button#localization-point-to-code').on('click', function () {
                setCodeMirrorTarget(code);
            });

            $('button#page-field').on('click', function () {
                let fieldId = $(this).attr('data-id');
                code.replaceSelection('{FIELD_' + fieldId + '}');
            });

            $('button#insert-content').on('click', function () {
                let content = $(this).attr('data-value');
                code.replaceSelection(content);
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
                    saveTemplate(Toast, code.getValue());
                }
            }

            $('button#save-button').on('click', () => saveTemplate(Toast, code.getValue()));
        });
    </script>
@stop
@section('template-form')
    <div class="card">
        <div class="card-header">
            @if($template->getType() === \App\Ship\Parents\Models\TemplateInterface::BASE_TYPE)
                <div class="btn-group margin-10">
                    <button type="button" class="btn btn-warning"
                            id="localization-point-to-code"
                            data-toggle="modal"
                            data-target="#modal-localization-point">
                        Localization
                    </button>
                    <button type="button" class="btn btn-info" id="insert-content" data-value="{CONTENT}">
                        Content
                    </button>

                    <div class="input-group-prepend">
                        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown"
                                aria-expanded="false">
                            Title/Description
                        </button>
                        <div class="dropdown-menu" style="">
                            <button class="dropdown-item" href="#" id="insert-content"
                                    data-value="{TITLE}">
                                Site Title
                            </button>
                            <button class="dropdown-item" href="#" id="insert-content"
                                    data-value="{DESCRIPTION}">
                                Site Description
                            </button>
                        </div>
                    </div>

                    <div class="input-group-prepend">
                        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown"
                                aria-expanded="false">
                            Metadata
                        </button>
                        <div class="dropdown-menu" style="">
                            <button class="dropdown-item" href="#" id="insert-content"
                                    data-value="{META_CHARSET}">
                                Meta Charset
                            </button>
                            <button class="dropdown-item" href="#" id="insert-content"
                                    data-value="{META_DESCRIPTION}">
                                Meta Description
                            </button>
                            <button class="dropdown-item" href="#" id="insert-content"
                                    data-value="{META_KEYWORDS}">
                                Meta Keywords
                            </button>
                            <button class="dropdown-item" href="#" id="insert-content"
                                    data-value="{META_AUTHOR}">
                                Meta Author
                            </button>
                        </div>
                    </div>

                    <div class="input-group-prepend">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                                aria-expanded="false">
                            JavaScript
                        </button>
                        <div class="dropdown-menu" style="">
                            @foreach($includableItems->get(\App\Ship\Parents\Models\TemplateInterface::JS_TYPE) ?? [] as $item)
                                <button class="dropdown-item" href="#" id="insert-content"
                                        data-value="{JAVASCRIPT_{{ $item->getId() }}}">
                                    {{ $item->getName() }}
                                    <sup>ID: {{ $item->getId() }} /
                                        Language: {{ $item->getLanguage()?->getName() ?? 'General' }}</sup>
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <div class="input-group-prepend">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                                aria-expanded="false">
                            CSS
                        </button>
                        <div class="dropdown-menu" style="">
                            @foreach($includableItems->get(\App\Ship\Parents\Models\TemplateInterface::CSS_TYPE) ?? [] as $item)
                                <button class="dropdown-item" href="#" id="insert-content"
                                        data-value="{CSS_{{ $item->getId() }}}">
                                    {{ $item->getName() }}
                                    <sup>ID: {{ $item->getId() }} /
                                        Language: {{ $item->getLanguage()?->getName() ?? 'General' }}</sup>
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <div class="input-group-prepend">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                                aria-expanded="false">
                            Menu
                        </button>
                        <div class="dropdown-menu" style="">
                            @foreach($includableItems->get(\App\Ship\Parents\Models\TemplateInterface::MENU_TYPE) ?? [] as $item)
                                <button class="dropdown-item" href="#" id="insert-content"
                                        data-value="{MENU_{{ $item->getId() }}}">
                                    {{ $item->getName() }}
                                    <sup>ID: {{ $item->getId() }} /
                                        Language: {{ $item->getLanguage()?->getName() ?? 'General' }}</sup>
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <div class="input-group-prepend">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                                aria-expanded="false">
                            Widget
                        </button>
                        <div class="dropdown-menu" style="">
                            @foreach($includableItems->get(\App\Ship\Parents\Models\TemplateInterface::WIDGET_TYPE) ?? [] as $item)
                                <button class="dropdown-item" href="#" id="insert-content"
                                        data-value="{WIDGET_{{ $item->getId() }}}">
                                    {{ $item->getName() }}
                                    <sup>ID: {{ $item->getId() }} /
                                        Language: {{ $item->getLanguage()?->getName() ?? 'General' }}</sup>
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
            @if($template->getType() === \App\Ship\Parents\Models\TemplateInterface::PAGE_TYPE)
                <div class="btn-group margin-10">
                    <div class="input-group-prepend">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                                aria-expanded="false">
                            Widget
                        </button>
                        <div class="dropdown-menu" style="">
                            @foreach($includableItems->get(\App\Ship\Parents\Models\TemplateInterface::WIDGET_TYPE) ?? [] as $item)
                                <button class="dropdown-item" href="#" id="insert-content"
                                        data-value="{WIDGET_{{ $item->getId() }}}">
                                    {{ $item->getName() }}
                                    <sup>ID: {{ $item->getId() }} /
                                        Language: {{ $item->getLanguage()?->getName() ?? 'General' }}</sup>
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
            <div class="btn-group margin-10">
                @if($template->getPage() !== null)
                    @foreach($template->getPage()?->getFields() as $field)
                        <button type="button" class="btn btn-default" id="page-field" data-id="{{$field->getId()}}">
                            {{$field->getName()}}&nbsp;<sup>ID: {{ $field->getId() }}</sup>
                        </button>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="card-body card-code">
            <textarea id="code" class="p-3">{{ $template->getCommonHtml() }}</textarea>
        </div>
    </div>
@stop