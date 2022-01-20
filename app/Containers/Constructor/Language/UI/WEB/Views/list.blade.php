@extends('constructor.base')

@section('title', 'Languages | List')
@section('page-title', 'Languages List')

@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-switch/css/bootstrap3/bootstrap-switch.min.css') }}">
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

    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

            $("input[data-bootstrap-switch]").each(function () {
                $(this).bootstrapSwitch('state', $(this).prop('checked'));
            })
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
                        <button type="button" class="btn bg-gradient-primary create-language" onclick="location.href='{{ route('constructor_language_create') }}'">
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
                            <tr>
                                <td>1</td>
                                <td>English</td>
                                <td>En</td>
                                <td>{{ config('app.url') }}/<b>en</b>/index.html</td>
                                <td class="dt-center">
                                    <div class="bootstrap-switch-container" style="width: 126px; margin-left: 0px;">
                                        <input type="checkbox" name="my-checkbox" checked="" data-bootstrap-switch=""
                                               data-off-color="danger" data-on-color="success">
                                    </div>
                                </td>
                                <td class="dt-right">
                                    <div class="btn-group">
                                        <button type="button" class="btn bg-gradient-primary btn-sm" onclick="location.href='{{ route('constructor_language_edit', ['id' => 1]) }}'">
                                            <i class="fas fa-edit"></i>
                                            Edit
                                        </button>
                                        <button type="button" class="btn bg-gradient-warning btn-sm" data-toggle="modal" data-target="#modal-default">
                                            <i class="fas fa-trash-alt"></i>
                                            Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Українська</td>
                                <td>Ua</td>
                                <td>{{ config('app.url') }}/<b>ua</b>/index.html</td>
                                <td class="dt-center">
                                    <div class="bootstrap-switch-container" style="width: 126px; margin-left: 0px;">
                                        <input type="checkbox" name="my-checkbox" checked="" data-bootstrap-switch=""
                                               data-off-color="danger" data-on-color="success">
                                    </div>
                                </td>
                                <td class="dt-right">
                                    <div class="btn-group">
                                        <button type="button" class="btn bg-gradient-primary btn-sm" onclick="location.href='{{ route('constructor_language_edit', ['id' => 2]) }}'">
                                            <i class="fas fa-edit"></i>
                                            Edit
                                        </button>
                                        <button type="button" class="btn bg-gradient-warning btn-sm" data-toggle="modal" data-target="#modal-default">
                                            <i class="fas fa-trash-alt"></i>
                                            Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Русский</td>
                                <td>Ru</td>
                                <td>{{ config('app.url') }}/<b>ru</b>/index.html</td>
                                <td class="dt-center">
                                    <div class="bootstrap-switch-container" style="width: 126px; margin-left: 0px;">
                                        <input type="checkbox" name="my-checkbox" data-bootstrap-switch=""
                                               data-off-color="danger" data-on-color="success">
                                    </div>
                                </td>
                                <td class="dt-right">
                                    <div class="btn-group">
                                        <button type="button" class="btn bg-gradient-primary btn-sm" onclick="location.href='{{ route('constructor_language_edit', ['id' => 3]) }}'">
                                            <i class="fas fa-edit"></i>
                                            Edit
                                        </button>
                                        <button type="button" class="btn bg-gradient-warning btn-sm" data-toggle="modal" data-target="#modal-default">
                                            <i class="fas fa-trash-alt"></i>
                                            Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                        <div class="modal fade" id="modal-default">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Are you sure?</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure that you want remove one of the language. It will delete all information and content of this  language.</p>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                        <button type="button" class="btn btn-danger">Yes, remove this language!</button>
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
