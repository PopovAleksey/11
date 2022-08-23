@php use App\Ship\Parents\Models\ConfigurationCommonInterface; @endphp
@extends('dashboard.base')

@section('title', 'Configuration | Common')
@section('page-title', 'Common Configuration')

@section('css')
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <style>
        .border-bottom {
            margin-bottom: 15px;
            padding-bottom: 15px;
        }
    </style>
@stop

@section('js')
    <!-- SweetAlert2 -->
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- Toastr -->
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

    <script>
        $(function () {
            $('.select').select2({
                theme: 'bootstrap4'
            })

            let Toast = Swal.mixin({
                toast: true,
                position: 'bottom',
                showConfirmButton: false,
                timer: 3000
            });

            $('button#save-button').click(function () {
                $('button#save-button').prop("disabled", true);
                $('button#save-button i').show();

                let languageId = $('select[name="{{ ConfigurationCommonInterface::DEFAULT_LANGUAGE }}"]').val();
                let contentId = $('select[name="{{ ConfigurationCommonInterface::DEFAULT_INDEX }}"]').val();
                let themeId = $('select[name="{{ ConfigurationCommonInterface::DEFAULT_THEME }}"]').val();

                let multiLanguage = {};

                $('div.multi-language-configs input').each(function () {
                    let langId = $(this).attr('data-lang-id');
                    let config = $(this).attr('name');
                    let value = $(this).val();

                    if (multiLanguage[config] === undefined) {
                        multiLanguage[config] = [];
                    }

                    multiLanguage[config].push({
                        language_id: parseInt(langId),
                        value: value
                    });

                });

                $.ajax({
                    url: '{{ route('dashboard_configuration_common_update') }}',
                    type: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: {
                        {{ ConfigurationCommonInterface::DEFAULT_LANGUAGE }}: languageId,
                        {{ ConfigurationCommonInterface::DEFAULT_INDEX }}: contentId,
                        {{ ConfigurationCommonInterface::DEFAULT_THEME }}: themeId,
                        {{ ConfigurationCommonInterface::TITLE }}: multiLanguage['{{ ConfigurationCommonInterface::TITLE }}'],
                        {{ ConfigurationCommonInterface::DESCRIPTION }}: multiLanguage['{{ ConfigurationCommonInterface::DESCRIPTION }}'],
                        {{ ConfigurationCommonInterface::TITLE_SEPARATOR }}: multiLanguage['{{ ConfigurationCommonInterface::TITLE_SEPARATOR }}'],
                        {{ ConfigurationCommonInterface::META_CHARSET }}: multiLanguage['{{ ConfigurationCommonInterface::META_CHARSET }}'],
                        {{ ConfigurationCommonInterface::META_DESCRIPTION }}: multiLanguage['{{ ConfigurationCommonInterface::META_DESCRIPTION }}'],
                        {{ ConfigurationCommonInterface::META_KEYWORDS }}: multiLanguage['{{ ConfigurationCommonInterface::META_KEYWORDS }}'],
                        {{ ConfigurationCommonInterface::META_AUTHOR }}: multiLanguage['{{ ConfigurationCommonInterface::META_AUTHOR }}'],
                    },
                    success: function () {
                        Toast.fire({
                            icon: 'success',
                            title: 'Saved'
                        });
                        $('button#save-button').prop("disabled", false);
                        $('button#save-button i').hide();
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
            });
        });
    </script>
@stop

@section('breadcrumb')
    @parent
@stop

@section('content')
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Default Language</label>
                            <select class="form-control select"
                                    name="{{ ConfigurationCommonInterface::DEFAULT_LANGUAGE }}"
                                    style="width: 100%;">
                                <option {{ $configs->getDefaultLanguageId() === null ? 'selected="selected"' : '' }} disabled>
                                    Choose Language
                                </option>
                                @foreach($configs->getLanguageList() as $language)
                                    <option value="{{ $language->getId() }}"
                                            {{ $language->getId() === $configs->getDefaultLanguageId() ? 'selected="selected"' : '' }}>
                                        {{ $language->getName() }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Index Content</label>
                            <select class="form-control select"
                                    name="{{ ConfigurationCommonInterface::DEFAULT_INDEX }}"
                                    style="width: 100%;">
                                <option {{ $configs->getDefaultIndexContentId() === null ? 'selected="selected"' : '' }} disabled>
                                    Choose Content
                                </option>
                                @foreach($configs->getContentList() as $content)
                                    <option value="{{ $content->getContentId() }}"
                                            {{ $content->getContentId() === $configs->getDefaultIndexContentId() ? 'selected="selected"' : '' }}>
                                        {{ $content->getValue() }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Default Theme</label>
                            <select class="form-control select"
                                    name="{{ ConfigurationCommonInterface::DEFAULT_THEME }}"
                                    style="width: 100%;">
                                <option {{ $configs->getDefaultThemeId() === null ? 'selected="selected"' : '' }} disabled>
                                    Choose Theme
                                </option>
                                @foreach($configs->getThemeList() as $theme)
                                    <option value="{{ $theme->getId() }}"
                                            {{ $theme->getId() === $configs->getDefaultThemeId() ? 'selected="selected"' : '' }}>
                                        {{ $theme->getName() }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
        </div>


        <div class="row">
            <div class="col-12">
                <div class="card card-primary card-outline card-outline-tabs">
                    <div class="card-header p-0 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                            @foreach($configs->getLanguageList() as $language)
                                <li class="nav-item">
                                    <a class="nav-link {{$configs->getLanguageList()->first()?->getId() === $language->getId() ? 'active' : ''}}"
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
                            @foreach($configs->getLanguageList() as $language)
                                <div class="tab-pane multi-language-configs fade {{$configs->getLanguageList()->first()?->getId() === $language->getId() ? 'show active' : ''}}"
                                     id="language-tab-{{ $language->getId() }}" role="tabpanel"
                                     aria-labelledby="language-tab-{{ $language->getId() }}-tab">

                                    <div class="row border-bottom">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Title</label>
                                                <input class="form-control input"
                                                       name="{{ ConfigurationCommonInterface::TITLE }}"
                                                       data-lang-id="{{ $language->getId() }}"
                                                       value="{{ $configs->getMultiLanguage()?->get($language->getId())?->get(ConfigurationCommonInterface::TITLE)?->getValue() }}"
                                                       placeholder="Enter Title ...">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Description</label>
                                                <input class="form-control input"
                                                       name="{{ ConfigurationCommonInterface::DESCRIPTION }}"
                                                       data-lang-id="{{ $language->getId() }}"
                                                       value="{{ $configs->getMultiLanguage()?->get($language->getId())?->get(ConfigurationCommonInterface::DESCRIPTION)?->getValue() }}"
                                                       placeholder="Enter Description ...">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Title Separator</label>
                                                <input class="form-control input"
                                                       name="{{ ConfigurationCommonInterface::TITLE_SEPARATOR }}"
                                                       data-lang-id="{{ $language->getId() }}"
                                                       value="{{ $configs->getMultiLanguage()?->get($language->getId())?->get(ConfigurationCommonInterface::TITLE_SEPARATOR)?->getValue() }}"
                                                       placeholder="Enter Separator ...">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Meta Charset</label>
                                                <input class="form-control input"
                                                       name="{{ ConfigurationCommonInterface::META_CHARSET }}"
                                                       data-lang-id="{{ $language->getId() }}"
                                                       value="{{ $configs->getMultiLanguage()?->get($language->getId())?->get(ConfigurationCommonInterface::META_CHARSET)?->getValue() ?? 'UTF-8' }}"
                                                       placeholder="Enter Meta Charset ...">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Meta Description</label>
                                                <input class="form-control input"
                                                       name="{{ ConfigurationCommonInterface::META_DESCRIPTION }}"
                                                       data-lang-id="{{ $language->getId() }}"
                                                       value="{{ $configs->getMultiLanguage()?->get($language->getId())?->get(ConfigurationCommonInterface::META_DESCRIPTION)?->getValue() }}"
                                                       placeholder="Enter Meta Description ...">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Meta Keywords</label>
                                                <input class="form-control input"
                                                       name="{{ ConfigurationCommonInterface::META_KEYWORDS }}"
                                                       data-lang-id="{{ $language->getId() }}"
                                                       value="{{ $configs->getMultiLanguage()?->get($language->getId())?->get(ConfigurationCommonInterface::META_KEYWORDS)?->getValue() }}"
                                                       placeholder="Enter Meta keywords ...">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Meta Author</label>
                                                <input class="form-control input"
                                                       name="{{ ConfigurationCommonInterface::META_AUTHOR }}"
                                                       data-lang-id="{{ $language->getId() }}"
                                                       value="{{ $configs->getMultiLanguage()?->get($language->getId())?->get(ConfigurationCommonInterface::META_AUTHOR)?->getValue() }}"
                                                       placeholder="Enter Meta Author ...">
                                            </div>
                                        </div>
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
                        <button type="submit" class="btn btn-block btn-success" id="save-button">
                            <i class="fas fa-circle-notch fa-spin" style="display: none;"></i>&nbsp;Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
