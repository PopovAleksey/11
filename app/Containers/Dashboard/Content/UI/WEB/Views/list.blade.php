@extends('dashboard.base')

@section('title', 'Page Contents | List')
@section('page-title', 'Page Contents List')

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
            $("#table-list").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false, "order": [[ 0, "desc" ]]
            }).buttons().container().appendTo('#table-list_wrapper .col-md-6:eq(0)');

            var Toast = Swal.mixin({
                toast: true,
                position: 'bottom',
                showConfirmButton: false,
                timer: 3000
            });

            let deleteContentId = null;

            $('button[data-target="#modal-delete"]').on('click', function () {
                deleteContentId = $(this).attr('data-id');
                console.log(deleteContentId);
            });

            $('#delete-page').on('click', function () {
                if (deleteContentId === null) {
                    return;
                }

                $('#delete-page').prop("disabled", true);

                $.ajax({
                    url: '{{ route('dashboard_content_destroy', ':id') }}'.replace(':id', deleteContentId),
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
    <li class="breadcrumb-item active">Page Contents</li>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <button type="button" class="btn bg-gradient-primary btn-sm"
                                onclick="location.href='{{ route('dashboard_content_create', $pageId) }}'">
                            <i class="fas fa-add"></i>
                            Add Content
                        </button>
                        <table id="table-list" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>{{ $field?->getName() }}</th>
                                <th>Created</th>
                                <th class="dt-right">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($contents as $content)
                                @foreach($content->getValues() as $value)
                                    @if($value->getPageFieldId() !== $field->getId())
                                        @continue
                                    @endif
                                    <tr>
                                        <td>{{ $content->getId() }}</td>
                                        <td>{{ $value->getValue() }}</td>
                                        <td>{{ $value->getCreateAt() }}</td>
                                        <td class="dt-right">
                                            <div class="btn-group">
                                                @if ($content->getPage()->getType() === \App\Containers\Constructor\Page\Models\PageInterface::BLOG_TYPE)
                                                    <button type="button" class="btn bg-gradient-warning btn-sm"
                                                            onclick="location.href='{{ route('dashboard_page_show', $content->getPage()->getChildPage()->getId()) }}'">
                                                        <i class="fas fa-folder-open"></i>
                                                        View Content
                                                    </button>
                                                @endif
                                                <button type="button" class="btn bg-gradient-primary btn-sm"
                                                        onclick="location.href='{{ route('dashboard_content_edit', $content->getId()) }}'">
                                                    <i class="fas fa-edit"></i>
                                                    Edit
                                                </button>
                                                <button type="button" class="btn bg-gradient-danger btn-sm"
                                                        data-id="{{ $content->getId() }}"
                                                        data-toggle="modal"
                                                        data-target="#modal-delete">
                                                    <i class="fas fa-trash-alt"></i>
                                                    Delete
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
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
                                        <p>Are you sure that you want to remove one of the contents.</p>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                        <button type="button" class="btn btn-danger" id="delete-page">Yes, remove
                                            this content!
                                        </button>
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
