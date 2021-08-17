@extends('constructorSection@site::index')

@section('title', 'Sites List')


@section('content')
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Domain</th>
            <th scope="col">Active</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($data as $site)
            <tr>
                <th scope="row">{{ data_get($site, 'id') }}</th>
                <td>{{ data_get($site, 'name') }}</td>
                <td>{{ data_get($site, 'domain') }}</td>
                <td>
                    @if(data_get($site, 'active') === 1)
                        <button title="Active" type="button" class="btn btn-success">
                            <i class="bi bi-check-all"></i>
                        </button>
                    @else
                        <button title="Disabled" type="button" class="btn btn-warning">
                            <i class="bi bi-x"></i>
                        </button>
                    @endif
                </td>
                <td class="d-flex justify-content-end">
                    <button title="Edit" type="button" class="btn btn-primary" onclick="location.href='{{route('web_site_show', ['id' => data_get($site, 'id')])}}'">
                        <i class="bi bi-gear-wide-connected"></i> Configuration
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection