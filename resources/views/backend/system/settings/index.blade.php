@extends('master.backend')
@section('title',__('backend.settings'))
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
                                <h4 class="mb-sm-0">@lang('backend.settings'):</h4>
                                <button data-bs-toggle="modal" data-bs-target="#exampleModalScrollable"
                                        class="btn btn-primary"><i class="fas fa-plus"></i>
                                    &nbsp;@lang('backend.add-new')</button>
                            </div>
                        </div>
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                               style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>@lang('backend.name'):</th>
                                <th>@lang('backend.link'):</th>
                                <th>@lang('backend.actions'):</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($settings as $setting)
                                <tr>
                                    <td class="text-center">{{ $setting->id }}</td>
                                    <td class="text-center">{{ $setting->name }}</td>
                                    <td class="text-center">{{ $setting->link }}</td>
                                    @include('backend.templates.components.dt-system-settings',['variable' => 'settings','value' => $setting])
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('backend.system.settings.create')
@endsection
@section('scripts')
    @include('backend.templates.components.dt-scripts')
@endsection
