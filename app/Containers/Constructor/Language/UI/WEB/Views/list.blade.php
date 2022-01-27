@extends('constructor.base')

@section('title', 'Languages | List')
@section('page-title', 'Languages List')

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
    <link rel="stylesheet" href="../../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
    <style>
        .bootstrap-switch-container {
            display: contents;
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
    <script src="../../plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- Toastr -->
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>

    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

            var Toast = Swal.mixin({
                toast: true,
                position: 'bottom',
                showConfirmButton: false,
                timer: 3000
            });

            $("input[data-bootstrap-switch]").each(function () {
                $(this).bootstrapSwitch('state', $(this).prop('checked'))
                    .on('switchChange.bootstrapSwitch', function (event, state) {
                        $.ajax({
                            url: '{{ route('constructor_language_update', ':id') }}'.replace(':id', $(this).attr('data-id')),
                            type: 'PATCH',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            data: {
                                'active': state === true ? 1 : 0
                            },
                            error: function (error) {
                                Toast.fire({
                                    icon: 'error',
                                    title: error.responseJSON.message
                                })
                            }
                        })
                    });
            });

            $('.select-country').select2().on("change", function () {
                let countryShortName = $('.select-country').find(':selected').val().toLowerCase();
                $('.country-short-name').val(countryShortName.charAt(0).toLocaleUpperCase() + countryShortName.slice(1));
                $('.country-path').val(countryShortName);
            });

            $('#add-language').on('click', function () {
                let countryShortName = $('.select-country').find(':selected').val();
                if (countryShortName === '') {
                    return;
                }

                $.ajax({
                    url: '{{ route('constructor_language_store') }}',
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

            let deleteLanguageId = null;

            $('button[data-target="#modal-delete"]').on('click', function () {
                deleteLanguageId = $(this).attr('data-id');
                console.log(deleteLanguageId);
            });

            $('#delete-language').on('click', function () {
                if (deleteLanguageId === null) {
                    return;
                }

                $.ajax({
                    url: '{{ route('constructor_language_destroy', ':id') }}'.replace(':id', deleteLanguageId),
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
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <button type="button" class="btn bg-gradient-primary create-language" data-toggle="modal"
                                data-target="#modal-create">
                            <i class="fas fa-plus-square"></i>&nbsp;
                            Add Language
                        </button>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Language</th>
                                <th>Short Name</th>
                                <th>Path</th>
                                <th class="dt-center">Is Active</th>
                                <th class="dt-right">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($list as $item)
                                <tr>
                                    <td>{{ $item->getId() }}</td>
                                    <td>{{ $item->getName() }}</td>
                                    <td>{{ $item->getShortName() }}</td>
                                    <td>{{ $domain }}/<b>{{ strtolower($item->getShortName()) }}</b>/index.html</td>
                                    <td class="dt-center">
                                        <div class="bootstrap-switch-container" style="width: 126px; margin-left: 0px;">
                                            <input type="checkbox" name="my-checkbox"
                                                   data-id="{{ $item->getId() }}"
                                                   {{ $item->isActive() === true ? 'checked=""' : '' }}
                                                   data-bootstrap-switch=""
                                                   data-off-color="danger"
                                                   data-on-color="success">
                                        </div>
                                    </td>
                                    <td class="dt-right">
                                        <div class="btn-group">
                                            <button type="button" class="btn bg-gradient-warning btn-sm"
                                                    data-id="{{ $item->getId() }}"
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
                                        <p>Are you sure that you want remove one of the language. It will delete all
                                            information and content of this language.</p>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                        <button type="button" class="btn btn-danger" id="delete-language">Yes, remove
                                            this language!
                                        </button>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>

                        <div class="modal fade" id="modal-create">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Choose new Language</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Country</label>
                                            <select class="form-control select-country" style="width: 100%;">
                                                <option value="">Choose country ...</option>
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country['code'] }}">{{ $country['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Short Name</label>
                                            <input type="text" class="form-control country-short-name"
                                                   placeholder="Choose country ..." disabled>
                                        </div>

                                        <div class="form-group">
                                            <label>Path</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">{{ $domain }}/</span>
                                                </div>
                                                <input type="text" class="form-control country-path"
                                                       placeholder="Choose country ..." disabled>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">/index.html</span>
                                                </div>
                                            </div>
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
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
@endsection
