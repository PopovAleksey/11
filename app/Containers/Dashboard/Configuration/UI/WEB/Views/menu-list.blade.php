@extends('dashboard.base')

@section('title', 'Menus | List')
@section('page-title', 'Menus List')

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
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
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
                            url: '{{ route('constructor_theme_activate', ':id') }}'.replace(':id', $(this).attr('data-id')),
                            type: 'PATCH',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            data: {
                                'active': state === true ? 1 : 0
                            },

                            success: function () {
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Success saved!'
                                })
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

            $('#create-menu').on('click', function () {
                let menuName = $('.menu-name').val();
                let menuTemplateId = $('.select-template').val();

                if (menuName === '' || menuTemplateId === null) {
                    return;
                }

                $('#create-menu').prop("disabled", true);

                $.ajax({
                    url: '{{ route('dashboard_configuration_menu_store') }}',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: {
                        'name': menuName,
                        'template_id': menuTemplateId
                    },
                    success: function (response) {
                        if (response.id === undefined) {
                            $('#create-menu').prop("disabled", false);
                            return;
                        }
                        location.href = '{{ route('dashboard_configuration_menu_edit', ':id') }}'.replace(':id', response.id);
                    },
                    error: function (error) {
                        Toast.fire({
                            icon: 'error',
                            title: error.responseJSON.message
                        });
                        $('#create-menu').prop("disabled", false);
                    }
                });
            });

            let deletePageId = null;

            $('button[data-target="#modal-delete"]').on('click', function () {
                deletePageId = $(this).attr('data-id');
            });

            $('#delete-page').on('click', function () {
                if (deletePageId === null) {
                    return;
                }

                $('#delete-page').prop("disabled", true);

                $.ajax({
                    url: '{{ route('dashboard_configuration_menu_destroy', ':id') }}'.replace(':id', deletePageId),
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
                        });
                        $('#delete-page').prop("disabled", false);
                    }
                });
            });
        });
    </script>
@stop

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Themes</li>
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
                            Add Menu
                        </button>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Template</th>
                                <th>Language</th>
                                <th class="dt-center">Is Active</th>
                                <th class="dt-right">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($list as $item)
                                <tr>
                                    <td>{{ $item->getId() }}</td>
                                    <td>{{ $item->getName() }}</td>
                                    <td>
                                        {{ $item->getTemplate()->getTheme()->getName() }}:
                                        {{ $item->getTemplate()->getName() }}
                                    </td>
                                    <td>{{ $item->getTemplate()?->getLanguage()?->getName() ?? 'General' }}</td>
                                    <td class="dt-center">
                                        <div class="bootstrap-switch-container" style="width: 126px; margin-left: 0px;">
                                            <input type="checkbox" name="my-checkbox"
                                                   data-id="{{ $item->getId() }}"
                                                   {{ $item->getActive() === true ? 'checked=""' : '' }}
                                                   data-bootstrap-switch=""
                                                   data-off-color="danger"
                                                   data-on-color="success">
                                        </div>
                                    </td>
                                    <td class="dt-right">
                                        <div class="btn-group">
                                            <button type="button" class="btn bg-gradient-warning btn-sm"
                                                    onclick="location.href='{{ route('dashboard_configuration_menu_edit', $item->getId()) }}'">
                                                <i class="fas fa-list"></i>&nbsp;
                                                Menu Items
                                            </button>
                                            <button type="button" class="btn bg-gradient-danger btn-sm"
                                                    data-id="{{ $item->getId() }}"
                                                    data-toggle="modal"
                                                    data-target="#modal-delete">
                                                <i class="fas fa-trash-alt"></i>&nbsp;
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
                                        <p>Are you sure that you want to remove one of the menu.</p>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                        <button type="button" class="btn btn-danger" id="delete-page">Yes, remove
                                            this menu!
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
                                        <h4 class="modal-title">Create new Menu</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" class="form-control menu-name"
                                                   placeholder="Enter name ...">
                                        </div>
                                        <div class="form-group">
                                            <label>Template</label>
                                            <select class="form-control select-template" style="width: 100%;">
                                                @foreach ($templates as $template)
                                                    <option value="{{ $template->getId() }}">
                                                        {{ $template->getTheme()->getName() }}
                                                        : {{ $template->getName() }} /
                                                        {{ $template->getLanguage()?->getName() ?? 'General' }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel
                                        </button>
                                        <button type="button" class="btn btn-success" id="create-menu">Create</button>
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
