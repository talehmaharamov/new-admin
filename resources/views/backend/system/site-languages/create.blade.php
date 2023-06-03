<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalScrollableTitle">@lang('backend.add-new')
                    : @lang('backend.languages')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('system.site-languages.store') }}" method="POST" class="needs-validation" novalidate="" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label>@lang('backend.name') <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" required=""  placeholder="Azərbaycan,English,Русский">
                        <div class="valid-feedback">
                            @lang('backend.name') @lang('messages.is-correct')
                        </div>
                        <div class="invalid-feedback">
                            @lang('backend.name') @lang('messages.not-correct')
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>@lang('backend.code') <span class="text-danger">*</span></label>
                        <input type="text" name="code" class="form-control" required=""  placeholder="az,en,ru">
                        <div class="valid-feedback">
                            @lang('backend.code') @lang('messages.is-correct')
                        </div>
                        <div class="invalid-feedback">
                            @lang('backend.code') @lang('messages.not-correct')
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>@lang('backend.icon') <span class="text-danger">*</span></label>
                        <input type="file" name="icon" class="form-control" required="">
                        <div class="valid-feedback">
                            @lang('backend.icon') @lang('messages.is-correct')
                        </div>
                        <div class="invalid-feedback">
                            @lang('backend.icon') @lang('messages.not-correct')
                        </div>
                    </div>
                    <div class="mb-0 text-center">
                        <div>
                            <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                                @lang('backend.submit')
                            </button>
                            <a href="{{url()->previous()}}" type="button" class="btn btn-secondary waves-effect">
                                @lang('backend.cancel')
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
