@extends('master.backend')
@section('title',__('backend.languages'))
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="col-12 d-flex justify-content-between">
                                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                        <h4 class="mb-sm-0">@lang('backend.creation')</h4>
                                    </div>
                                    <div>
                                        <div>
                                            <label class="checkbox">
                                                <input type="checkbox" class="is-invalid" id="check-all">
                                                <span></span>
                                                @lang('backend.check-uncheck')
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <form action="{{ route('system.creationStore') }}" method="POST"
                                      class="needs-validation" novalidate="" enctype="multipart/form-data">
                                    @csrf
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="col-12">
                                            <label>@lang('backend.name') <span class="text-danger">*</span></label>
                                            <input type="text" name="name" class="form-control" required=""
                                                   placeholder="News">
                                            {!! validation_response('backend.name') !!}
                                        </div>
                                    </div>
                                    <div class="d-flex mb-4">
                                        <div class="col-4 mb-3">
                                            <div class="form-group ">
                                                <label class="text-dark">@lang('system.controllers') <span
                                                        class="text-danger">*</span></label>
                                                <div>
                                                    <div>
                                                        <input type="checkbox" name="backendController" value="1">
                                                        <label>Backend Controller</label>
                                                    </div>
                                                    <div>
                                                        <input type="checkbox" name="frontendController" value="1">
                                                        <label>Frontend Controller</label>
                                                    </div>
                                                    <div class="align-items-center">
                                                        <input type="checkbox" name="apiController" value="1">
                                                        <label>Api Controller</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label class="text-dark">@lang('system.models') <span
                                                        class="text-danger">*</span></label>
                                                <div>
                                                    <div>
                                                        <input type="checkbox" name="translationModel" value="1">
                                                        <label>Translation Model</label>
                                                    </div>
                                                    <div>
                                                        <input type="checkbox" name="photoModel" value="1">
                                                        <label>Photo Model</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group ">
                                                <label class="text-dark">@lang('system.routes') <span
                                                        class="text-danger">*</span></label>
                                                <div class="">
                                                    <div>
                                                        <input type="checkbox" name="backendRoute" value="1">
                                                        <label>Backend Route</label>
                                                    </div>
                                                    <div>
                                                        <input type="checkbox" name="backendRoute"  value="1">
                                                        <label>Delete Route</label>
                                                    </div>
                                                    <div class="align-items-center">
                                                        <input type="checkbox" name="statusRoute" value="1">
                                                        <label>Status Route</label>
                                                    </div>
                                                    <div class="align-items-center">
                                                        <input type="checkbox" name="frontendRoute" value="1">
                                                        <label>Frontend Route</label>
                                                    </div>
                                                    <div class="align-items-center">
                                                        <input type="checkbox" name="apiRoute" value="1">
                                                        <label>Api Route</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-0 text-center">
                                        <div>
                                            <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                                                @lang('backend.submit')
                                            </button>
                                            <a href="{{url()->previous()}}" type="button"
                                               class="btn btn-secondary waves-effect">
                                                @lang('backend.cancel')
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
