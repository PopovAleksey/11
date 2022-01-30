@extends('constructor.base')

@section('title', 'Page Types | Simple Page | ' . $data->getName())
@section('page-title', 'Simple Page | ' . $data->getName())

@section('css')
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
    <style>
        .bootstrap-switch-container {
            display: contents;
        }
    </style>
@stop

@section('js')

    <!-- Toastr -->
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>

    <script>
        $(function () {
            var nextTab = 3;

            $('button#add-element').on('click', function () {
                //var nextTab = $('#vert-tabs-tab a').size()+1;
                // create the tab
                $('<a class="nav-link" id="vert-tabs-settings-tab" data-toggle="pill" \
                href="#vert-tabs-field-' + nextTab + '" role="tab" aria-controls="vert-tabs-settings" \
                aria-selected="false"><strong>Tab ' + nextTab + '</strong></a>').appendTo('#vert-tabs-tab');

                // create the tab content
                $('<div class="tab-pane fade show active" id="vert-tabs-field-' + nextTab + '" role="tabpanel" \
                aria-labelledby="vert-tabs-settings-tab">Test Tab ' + nextTab + '</div>').appendTo('.tab-content');

                // make the new tab active
                $('#vert-tabs-tab a:last').tab('show');

                nextTab++;
            });
        });
    </script>
@stop

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active"><a href="{{route('constructor_page_index')}}">Page Types</a></li>
    <li class="breadcrumb-item active">Simple Page</li>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5 col-sm-3">
                                <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist"
                                     aria-orientation="vertical">
                                    <a class="nav-link active" id="vert-tabs-settings-tab" data-toggle="pill"
                                       href="#vert-tabs-field-1" role="tab" aria-controls="vert-tabs-settings"
                                       aria-selected="false">Input: <strong>Name</strong></a>
                                    <a class="nav-link" id="vert-tabs-settings-tab" data-toggle="pill"
                                       href="#vert-tabs-field-2" role="tab" aria-controls="vert-tabs-settings"
                                       aria-selected="false">Textarea: <strong>Content</strong></a>
                                </div>
                                <button type="button" class="btn btn-block btn-info btn-sm" id="add-element">Add element</button>
                            </div>
                            <div class="col-7 col-sm-9">
                                <div class="tab-content" id="vert-tabs-tabContent">
                                    <div class="tab-pane fade show active" id="vert-tabs-field-1" role="tabpanel"
                                         aria-labelledby="vert-tabs-settings-tab">
                                        wqipoepjoiwejqriewjj
                                    </div>
                                    <div class="tab-pane fade" id="vert-tabs-field-2" role="tabpanel"
                                         aria-labelledby="vert-tabs-settings-tab">
                                        lksdnfaklsndg;lnasdf
                                    </div>
                                </div>
                            </div>
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
