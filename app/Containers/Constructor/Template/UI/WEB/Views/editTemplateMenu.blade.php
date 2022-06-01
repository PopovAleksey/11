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

            let codeElem = CodeMirror.fromTextArea(document.getElementById("code-element"), {
                lineNumbers: true,
                mode: 'htmlmixed',
                theme: "default",
                continueComments: "Enter",
            });
            codeElem.setSize(null, 600);

            $('a.nav-link').on('click', function () {
                setInterval(() => code.refresh(), 500);
                setInterval(() => codeElem.refresh(), 500);
            });

            $('button#insert-content').on('click', function () {
                let content = $(this).attr('data-value');
                code.replaceSelection(content);
            });

            $('button#insert-element').on('click', function () {
                let content = $(this).attr('data-value');
                codeElem.replaceSelection(content);
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
                    saveTemplate(Toast, code.getValue(), codeElem.getValue());
                }
            }

            $('button#save-button').on('click', () => saveTemplate(Toast, code.getValue(), codeElem.getValue()));

        });
    </script>
@stop
@if($template->getType() === \App\Ship\Parents\Models\TemplateInterface::WIDGET_TYPE)
    @section('page-title')
        @parent
        <div class="input-group" style="margin-top: 10px">
            <div class="input-group-prepend">
                <span class="input-group-text">Count of Show Elements</span>
            </div>
            <input type="number" class="form-control" placeholder="Enter Count of Showing Elements..." id="widget-count"
                   value="{{ $template->getWidget()?->getCountElements() ?? 1 }}"/>
            <div class="input-group-prepend">
                <span class="input-group-text">Show By</span>
            </div>
            <select class="form-control" id="widget-show-by">
                @foreach($listShowBy as $showBy)
                    <option value="{{ $showBy }}"{{ $showBy === $template->getWidget()?->getShowBy() ? ' selected' : '' }}>{{ ucfirst($showBy) }}</option>
                @endforeach
            </select>
        </div>
    @endsection
@endif
@section('template-form')
    <div class="card card-primary card-outline card-outline-tabs">
        <div class="card-header p-0 border-bottom-0">
            <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill"
                       href="#custom-tabs-four-home" role="tab"
                       aria-controls="custom-tabs-four-home"
                       aria-selected="true">Common Style</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill"
                       href="#custom-tabs-four-profile" role="tab"
                       aria-controls="custom-tabs-four-profile"
                       aria-selected="false">One Item Style</a>
                </li>
            </ul>
        </div>
        <div class="card-body card-code">
            <div class="tab-content" id="custom-tabs-four-tabContent">
                <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel"
                     aria-labelledby="custom-tabs-four-home-tab">
                    <div class="btn-group margin-10">
                        <button type="button" class="btn btn-info" id="insert-content"
                                data-value="{ITEMS}">
                            All Items
                        </button>
                    </div>
                    <textarea id="code" class="p-3">{{ $template->getCommonHtml() }}</textarea>
                </div>
                <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel"
                     aria-labelledby="custom-tabs-four-profile-tab">
                    <div class="btn-group margin-10">
                        <button type="button" class="btn btn-info" id="insert-element" data-value="{LINK}">
                            Link URL
                        </button>
                        <button type="button" class="btn btn-info" id="insert-element" data-value="{NAME}">
                            Link Name
                        </button>
                    </div>
                    <textarea id="code-element" class="p-3">{{ $template->getElementHtml() }}</textarea>
                </div>
            </div>
        </div>
        <!-- /.card -->
    </div>
@stop