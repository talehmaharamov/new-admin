@extends('master.backend')
@section('title',__('backend.settings'))
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-xl-6 ">
                        <div class="card">
                            <div class="card-body">
                                <div class="col-12">
                                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                        <h4 class="mb-sm-0">@lang('backend.settings'): @lang('backend.add-new')</h4>
                                    </div>
                                </div>
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
                                    @include('backend.templates.components.buttons')
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
