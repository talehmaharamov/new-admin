@extends('master.backend')
@section('title',__('backend.languages'))
@section('styles')
    @include('backend.templates.components.dt-styles')
@endsection
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">@lang('backend.languages'):</h4>
                                <a href="{{ route('system.site-languages.create')}}" class="btn btn-primary mb-3"><i
                                        class="fas fa-plus"></i>
                                    &nbsp;@lang('backend.add-new')
                                </a>
                            </div>
                        </div>
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                               style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>@lang('backend.icon'):</th>
                                <th>@lang('backend.code'):</th>
                                <th>@lang('backend.name'):</th>
                                <th>@lang('backend.actions'):</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($siteLanguages as $sl)
                                <tr>
                                    <td class="text-center">{{ $sl->id }}</td>
                                    <td class="text-center"><img src="{{ asset($sl->icon) }}" width="32" height="24">
                                    <td class="text-center">{{ $sl->code }}</td>
                                    <td class="text-center">{{ $sl->name }}</td>
                                    </td>
                                    @include('backend.templates.components.dt-system-settings',['variable' => 'site-languages','value' => $sl])
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @include('backend.templates.components.dt-scripts')
@endsection
