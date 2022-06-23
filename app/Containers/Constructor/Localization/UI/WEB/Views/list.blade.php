@extends('constructor.base')

@section('title', 'Localization | List')
@section('page-title')
    <button type="button" class="btn bg-gradient-primary form-localization" data-toggle="modal"
            data-target="#modal-form">
        <i class="fas fa-plus-square"></i>&nbsp;
        Add Localization
    </button>
@stop

@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-switch/css/bootstrap3/bootstrap-switch.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
    <style>
        div.input-group-prepend span {
            min-width: 150px;
        }

        div.input-group {
            margin-bottom: 10px;
        }
    </style>
@stop

@section('js')
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    <script src="{{ asset('plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- Toastr -->
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>

    <script>
        $(function () {
            @foreach($languages as $language)
            $("#localization-table-{{ $language->getId() }}").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            @endforeach

            var Toast = Swal.mixin({
                toast: true,
                position: 'bottom',
                showConfirmButton: false,
                timer: 3000
            });

            $('#edit-localization').on('click', function () {
                let editLocalizationId = $(this).attr('data-id');

                $.ajax({
                    url: '{{ route('constructor_localization_find', ':id') }}'.replace(':id', editLocalizationId),
                    type: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        @foreach($languages as $language)

                        @endforeach
                        console.log(response.data);
                    },
                    error: function (error) {
                        Toast.fire({
                            icon: 'error',
                            title: error.responseJSON.message
                        })
                    }
                });
            });

            $('#add-language').on('click', function () {
                let countryShortName = $('.select-country').find(':selected').val();
                if (countryShortName === '') {
                    return;
                }

                $.ajax({
                    url: '{{ route('constructor_localization_store') }}',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: {
                        'code': countryShortName
                    },
                    success: function () {
                        location.reload();
                    },
                    error: function (error) {
                        Toast.fire({
                            icon: 'error',
                            title: error.responseJSON.message
                        })
                    }
                });
            });

            let deleteLocalizationId = null;

            $('button[data-target="#modal-delete"]').on('click', function () {
                deleteLocalizationId = $(this).attr('data-id');
            });

            $('#delete-language').on('click', function () {
                if (deleteLocalizationId === null) {
                    return;
                }

                $.ajax({
                    url: '{{ route('constructor_localization_destroy', ':id') }}'.replace(':id', deleteLocalizationId),
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function () {
                        location.reload();
                    },
                    error: function (error) {
                        Toast.fire({
                            icon: 'error',
                            title: error.responseJSON.message
                        })
                    }
                });
            });
        });
    </script>
@stop

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Languages</li>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary card-outline card-outline-tabs">
                    <div class="card-header p-0 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                            @foreach($languages as $language)
                                <li class="nav-item">
                                    <a class="nav-link {{$languages->first()?->getId() === $language->getId() ? 'active' : ''}}"
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
                            @foreach($languages as $language)
                                <div class="tab-pane fade {{$languages->first()?->getId() === $language->getId() ? 'show active' : ''}}"
                                     id="language-tab-{{ $language->getId() }}" role="tabpanel"
                                     aria-labelledby="language-tab-{{ $language->getId() }}-tab">

                                    <table id="localization-table-{{ $language->getId() }}"
                                           class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Point</th>
                                            <th>Translate</th>
                                            <th>Theme</th>
                                            <th class="dt-right">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($list->get($language->getId()) as $point)
                                            <tr>
                                                <td>{{ $point->getId() }}</td>
                                                <td>{{ $point->getPoint() }}</td>
                                                <td>{{ $point->getValues()?->first()?->getValue() }}</td>
                                                <td>{{ $point->getTheme()?->getName() ?? 'Global Point' }}</td>
                                                <td class="dt-right">
                                                    <div class="btn-group">
                                                        <button type="button" class="btn bg-gradient-primary btn-sm"
                                                                id="edit-localization"
                                                                data-id="{{ $point->getId() }}"
                                                                data-toggle="modal"
                                                                data-target="#modal-form">
                                                            <i class="fas fa-edit"></i>
                                                            Edit
                                                        </button>
                                                        <button type="button" class="btn bg-gradient-danger btn-sm"
                                                                data-id="{{ $point->getId() }}"
                                                                data-toggle="modal"
                                                                data-target="#modal-delete">
                                                            <i class="fas fa-trash-alt"></i>
                                                            Delete
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>

    <div class="modal fade" id="modal-delete">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Are you sure?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure that you want to remove one of the points?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    <button type="button" class="btn btn-danger" id="delete-language">Yes, remove
                        this Point!
                    </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="modal-form">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body border-bottom">
                    <div class="form-group">
                        <label>Point</label>
                        <input type="text" class="form-control" id="point" data-id="" placeholder="Enter Point">
                    </div>
                </div>
                <div class="modal-body border-bottom">
                    <div class="form-group">
                        @foreach($languages as $language)
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">{{ $language->getName() }}:</span>
                                </div>
                                <input type="text" class="form-control" id="point-translation"
                                       data-id="{{ $language->getId() }}" placeholder="Enter Translation">
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>For Theme</label>
                        <select class="form-control select-country" style="width: 100%;">
                            <option value="">Global Point</option>
                            @foreach($themes as $theme)
                                <option value="{{ $theme->getId() }}">{{ $theme->getName() }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel
                    </button>
                    <button type="button" class="btn btn-success" id="add-language">Add</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection
