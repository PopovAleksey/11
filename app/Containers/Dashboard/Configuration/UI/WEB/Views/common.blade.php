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
                $('#save-button').prop("disabled", true);

                let languageId = $('select[name="{{ \App\Ship\Parents\Models\ConfigurationCommonInterface::DEFAULT_LANGUAGE }}"]').val();
                let contentId = $('select[name="{{ \App\Ship\Parents\Models\ConfigurationCommonInterface::DEFAULT_INDEX }}"]').val();

                $.ajax({
                    url: '{{ route('dashboard_configuration_common_update') }}',
                    type: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: {
                        {{ \App\Ship\Parents\Models\ConfigurationCommonInterface::DEFAULT_LANGUAGE }}: languageId,
                        {{ \App\Ship\Parents\Models\ConfigurationCommonInterface::DEFAULT_INDEX }}: contentId
                    },
                    success: function () {
                        Toast.fire({
                            icon: 'success',
                            title: 'Saved'
                        });
                        $('#save-button').prop("disabled", false);
                    },
                    error: function (error) {
                        Toast.fire({
                            icon: 'error',
                            title: error.responseJSON.message
                        });
                        location.href = '{{ route('dashboard_configuration_common') }}';
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
                    <div class="col-md-6">

                        <div class="form-group">
                            <label>Default Language</label>
                            <select class="form-control select"
                                    name="{{ \App\Ship\Parents\Models\ConfigurationCommonInterface::DEFAULT_LANGUAGE }}"
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
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Index Content</label>
                            <select class="form-control select"
                                    name="{{ \App\Ship\Parents\Models\ConfigurationCommonInterface::DEFAULT_INDEX }}"
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
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button id="save-button" class="btn btn-success float-right">Save</button>
            </div>
        </div>

    </div>
@endsection