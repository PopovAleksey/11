@extends('dashboard.base')

@section('title', 'Configuration | Menu')
@section('page-title')
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">Menu Name:</span>
        </div>
        <input type="text" class="form-control" placeholder="Enter Theme Name..." id="menu-name"
               value="{{ $data->getName() }}"/>

        <div class="input-group-prepend">
            <span class="input-group-text">Template:</span>
        </div>
        <select class="form-control" id="menu-template">
            <option disabled>Choose Template...</option>
            @foreach($templates as $template)
                <option value="{{ $template->getId() }}"{{ $template->getId() === $data->getTemplateId() ? 'selected' : ''}}>
                    {{$template->getTheme()?->getName()}}: {{ $template->getName() }}
                    / {{ $template->getLanguage()?->getName() ?? 'General' }}
                </option>
            @endforeach
        </select>
        <div class="input-group-append">
            <button type="button" class="btn btn-warning" id="save-button">
                <i class="fas fa-circle-notch fa-spin" style="display: none;"></i>&nbsp;Save
            </button>
        </div>
    </div>
@stop

@section('css')
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
    <style>
        .list-group-sortable-connected {
            min-height: 100px;
            border: dashed #d3d3d3;
        }

        .list-group-item {
            cursor: move;
        }

        button.left-button {
            margin-right: 20px;
        }

        .right-area button.right-button {
            display: none;
        }

        .left-area button.left-button {
            display: none;
        }
    </style>
@stop

@section('js')
    <!-- SweetAlert2 -->
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- Toastr -->
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('plugins/sortable/jquery.sortable.js') }}"></script>

    <script>
        $(function () {
            $('.list-group-sortable-connected').sortable({
                placeholderClass: 'list-group-item',
                connectWith: '.connected'
            });

            let Toast = Swal.mixin({
                toast: true,
                position: 'bottom',
                showConfirmButton: false,
                timer: 3000
            });

            $('button#save-button').click(function () {
                $('button#save-button').prop("disabled", true);
                $('button#save-button i').show();

                let dataList = [];
                let orderIndex = 1;

                $('ul.right-area li').each(function () {
                    let contentId = parseInt($(this).attr('data-id'));
                    dataList.push({
                        contentId: contentId,
                        order: orderIndex++
                    })
                });

                let menuName = $('input#menu-name').val();
                let menuTemplate = $('select#menu-template').val();

                $.ajax({
                    url: '{{ route('dashboard_configuration_menu_update', $id) }}',
                    type: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: {
                        name: menuName,
                        template_id: menuTemplate,
                        items: dataList
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

            $('button.left-button, button.right-button').click(function () {
                let item = $(this).parent('li.list-group-item');

                if ($(this).hasClass('right-button')) {
                    item.appendTo('ul.list-group.right-area');
                    return;
                }

                item.appendTo('ul.list-group.left-area');
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
                    <div class="col-12">
                        <section>
                            <div class="row">
                                <div class="col-sm-6">
                                    <h4>Available Links</h4>
                                    <ul class="list-group list-group-sortable-connected left-area">
                                        @foreach($list as $item)
                                            <li data-id="{{ $item->getContentId() }}"
                                                class="list-group-item list-group-item-secondary">
                                                <button class="btn bg-light btn-xs float-left left-button">
                                                    &nbsp;<i class="fas fa-angle-left"></i>&nbsp;
                                                </button>
                                                {{ $item->getName() }}
                                                <button class="btn bg-light btn-xs float-right right-button">
                                                    &nbsp;<i class="fas fa-angle-right"></i>&nbsp;
                                                </button>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="col-sm-6">
                                    <h4>Links in Menu List</h4>
                                    <ul class="list-group list-group-sortable-connected right-area">
                                        @foreach($data->getItems() as $item)
                                            <li data-id="{{ $item->getContentId() }}"
                                                class="list-group-item list-group-item-secondary">
                                                <button class="btn bg-light btn-xs float-left left-button">
                                                    &nbsp;<i class="fas fa-angle-left"></i>&nbsp;
                                                </button>
                                                {{ $item->getName() }}
                                                <button class="btn bg-light btn-xs float-right right-button">
                                                    &nbsp;<i class="fas fa-angle-right"></i>&nbsp;
                                                </button>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </section>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button id="save-button" class="btn btn-success float-right">
                    <i class="fas fa-circle-notch fa-spin" style="display: none;"></i>&nbsp;Save
                </button>
            </div>
        </div>

    </div>
@endsection
