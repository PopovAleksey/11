@extends('constructor.base')

@section('title', 'SEO | List')
@section('page-title', 'SEO List')

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
                        let type = $(this).attr('data-type');
                        let updateData = {};

                        if (type === 'active') {
                            updateData = {active: state === true ? 1 : 0};
                        } else if (type === 'static') {
                            updateData = {static: state === true ? 1 : 0};
                        }

                        $.ajax({
                            url: '{{ route('constructor_seo_update', ':id') }}'.replace(':id', $(this).attr('data-id')),
                            type: 'PATCH',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            data: updateData,
                            error: function (error) {
                                Toast.fire({
                                    icon: 'error',
                                    title: error.responseJSON.message
                                })
                            }
                        })
                    });
            });

            $('#add-seo-setting').on('click', function () {
                let fieldId = $('.select-field').find(':selected').val();
                let languageId = $('.select-language').find(':selected').val();
                let caseType = $('.select-case-type').find(':selected').val();
                if (fieldId === '' || languageId === '' || caseType === '') {
                    return;
                }

                $.ajax({
                    url: '{{ route('constructor_seo_store') }}',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: {
                        'field_id': fieldId,
                        'language_id': languageId,
                        'case_type': caseType
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

            let showLinksSeoId = null;

            $('button[data-target="#modal-show-links"]').on('click', function () {
                showLinksSeoId = $(this).attr('data-id');
                $('tbody.seo').hide();
                $('tbody.seo#seo-' + showLinksSeoId).show();
            });

            let deleteSeoId = null;

            $('button[data-target="#modal-delete"]').on('click', function () {
                deleteSeoId = $(this).attr('data-id');
            });

            $('#delete-seo').on('click', function () {
                if (deleteSeoId === null) {
                    return;
                }

                $.ajax({
                    url: '{{ route('constructor_seo_destroy', ':id') }}'.replace(':id', deleteSeoId),
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
    <li class="breadcrumb-item active">SEO</li>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <button type="button" class="btn bg-gradient-primary create-seo" data-toggle="modal"
                                data-target="#modal-create">
                            <i class="fas fa-plus-square"></i>&nbsp;
                            Add SEO Setting
                        </button>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Language</th>
                                <th>Page</th>
                                <th>Field</th>
                                <th>Case Type</th>
                                <th class="dt-center">Is Static</th>
                                <th class="dt-center">Is Active</th>
                                <th class="dt-right">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($list as $item)
                                <tr>
                                    <td>{{ $item->getId() }}</td>
                                    <td>{{ $item->getLanguage()?->getName() }}</td>
                                    <td>{{ $item->getPage()?->getName() }}</td>
                                    <td>{{ $item->getField()?->getName() }}</td>
                                    <td>{{ $item->getCaseType() }}</td>
                                    <td class="dt-center">
                                        <div class="bootstrap-switch-container" style="width: 126px; margin-left: 0px;">
                                            <input type="checkbox" name="my-checkbox"
                                                   data-id="{{ $item->getId() }}"
                                                   {{ $item->isStatic() === true ? 'checked=""' : '' }}
                                                   data-bootstrap-switch=""
                                                   data-type="static"
                                                   data-off-color="danger"
                                                   data-on-color="success">
                                        </div>
                                    </td>
                                    <td class="dt-center">
                                        <div class="bootstrap-switch-container" style="width: 126px; margin-left: 0px;">
                                            <input type="checkbox" name="my-checkbox"
                                                   data-id="{{ $item->getId() }}"
                                                   {{ $item->isActive() === true ? 'checked=""' : '' }}
                                                   data-bootstrap-switch=""
                                                   data-type="active"
                                                   data-off-color="danger"
                                                   data-on-color="success">
                                        </div>
                                    </td>
                                    <td class="dt-right">
                                        <div class="btn-group">
                                            <button type="button" class="btn bg-gradient-warning btn-sm"
                                                    data-id="{{ $item->getId() }}"
                                                    data-toggle="modal"
                                                    data-target="#modal-show-links">
                                                <i class="far fa-eye"></i>
                                                Show Example Links
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
                                        <p>Are you sure that you want to remove one of the SEO setting?</p>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                        <button type="button" class="btn btn-danger" id="delete-seo">Yes, remove
                                            this SEO setting!
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
                                            <label>Page Field</label>
                                            <select class="form-control select-field" style="width: 100%;">
                                                @foreach ($pages as $page)
                                                    @foreach($page->getFields() as $field)
                                                        <option value="{{ $field->getId() }}">{{ $page->getName() }}
                                                            : {{ $field->getName() }}</option>
                                                    @endforeach
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Language</label>
                                            <select class="form-control select-language" style="width: 100%;">
                                                @foreach ($languages as $language)
                                                    <option value="{{ $language->getId() }}">{{ $language->getName() }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Case Type</label>
                                            <select class="form-control select-case-type" style="width: 100%;">
                                                @foreach ($caseTypes as $caseType)
                                                    <option value="{{ $caseType }}">{{ $caseType }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel
                                        </button>
                                        <button type="button" class="btn btn-success" id="add-seo-setting">Add</button>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>

                        <div class="modal fade" id="modal-show-links">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">List of Links</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th style="width: 10px">#</th>
                                                <th>Link</th>
                                            </tr>
                                            </thead>
                                            @foreach($list as $item)
                                                <tbody class="seo" id="seo-{{ $item->getId() }}">
                                                @foreach($item->getLinks() as $link)
                                                    <tr>
                                                        <td>{{ $link->getId() }}</td>
                                                        <td>{{ $link->getLink() }}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>

                                            @endforeach
                                        </table>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close
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
