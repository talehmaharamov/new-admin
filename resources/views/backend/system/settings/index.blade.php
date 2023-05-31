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
    <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">@lang('backend.add-new')
                        : @lang('backend.settings')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('system.settings.store') }}" method="POST"
                          class="needs-validation" novalidate="" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label>@lang('backend.name') <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" required=""
                                   placeholder="instagram">
                            {!! validation_response('backend.name') !!}
                        </div>
                        <div class="mb-3">
                            <label>@lang('backend.link') <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="link" rows="5" required
                                      placeholder="https://www.instagram.com/@username"></textarea>
                            {!! validation_response('backend.link') !!}
                        </div>
                        <div class="mb-3">
                            <label>@lang('backend.type') <span class="text-danger">*</span></label>
                            <select class="form-control" name="type">
                                <option
                                    value="{{ \App\Http\Enums\SettingEnum::OTHER }}">@lang('backend.other')</option>
                                <option
                                    value="{{ \App\Http\Enums\SettingEnum::SOSIAL }}">@lang('backend.sosial')</option>
                            </select>
                            {!! validation_response('backend.name') !!}
                        </div>
                        @include('backend.templates.components.modal-button')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @include('backend.templates.components.dt-scripts')
@endsection
