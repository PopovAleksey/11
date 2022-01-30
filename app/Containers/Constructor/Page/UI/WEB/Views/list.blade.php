@extends('constructor.base')

@section('title', 'Page Types | List')
@section('page-title', 'Page Types List')

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
                            url: '{{ route('constructor_page_update', ':id') }}'.replace(':id', $(this).attr('data-id')),
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

            $('#create-page').on('click', function () {
                let pageType = $('.select-type').find(':selected').val();
                let pageName = $('.page-name').val();
                if (pageType === '' || pageName === '') {
                    return;
                }

                $('#create-page').prop("disabled", true);

                $.ajax({
                    url: '{{ route('constructor_page_store') }}',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: {
                        'name': pageName,
                        'type': pageType
                    },
                    success: function (response) {
                        if (response.id === undefined) {
                            $('#create-page').prop("disabled", false);
                            return;
                        }
                        location.href = '{{ route('constructor_page_edit', ':id') }}'.replace(':id', response.id);
                    },
                    error: function (error) {
                        Toast.fire({
                            icon: 'error',
                            title: error.responseJSON.message
                        });
                        $('#create-page').prop("disabled", false);
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
                    url: '{{ route('constructor_page_destroy', ':id') }}'.replace(':id', deletePageId),
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
    <li class="breadcrumb-item active">Page Types</li>
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
                            Add Page Type
                        </button>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Type</th>
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
                                        @if ($item->getType() === 'simple')
                                            <i class="far fa-file-alt"></i> Simple Page
                                        @elseif($item->getType() === 'blog')
                                            <i class="far fa-newspaper"></i> Blog Page
                                        @elseif($item->getType() === 'category')
                                            <i class="far fa-list-alt"></i> Category
                                        @endif
                                    </td>
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
                                            <button type="button" class="btn bg-gradient-primary btn-sm"
                                                    onclick="location.href='{{ route('constructor_page_edit', $item->getId()) }}'">
                                                <i class="fas fa-cog"></i>
                                                Configuration
                                            </button>
                                            <button type="button" class="btn bg-gradient-danger btn-sm"
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
                                        <button type="button" class="btn btn-danger" id="delete-page">Yes, remove
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
                                        <h4 class="modal-title">Create new Page</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Page Type</label>
                                            <select class="form-control select-type" style="width: 100%;">
                                                <option value="simple">Simple Page</option>
                                                <option value="blog">Blog Page</option>
                                                <option value="category">Category</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" class="form-control page-name"
                                                   placeholder="Enter name ...">
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel
                                        </button>
                                        <button type="button" class="btn btn-success" id="create-page">Create</button>
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
