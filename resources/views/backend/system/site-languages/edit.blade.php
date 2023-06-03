<div class="modal fade" id="editModal{{ $value->id }}" tabindex="-1" role="dialog"
     aria-labelledby="editModalLabel{{ $value->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel{{ $value->id }}">@lang('backend.edit'): #{{ $value->id }}</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('system.site-languages.update',$value->id) }}" method="POST" class="needs-validation" novalidate="" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label style="text-align: left;display: block;">@lang('backend.name') <span class="text-danger">*</span></label>
                        <input type="text" value=" {{ $value->name }}" name="name" class="form-control" required="">
                        <div class="valid-feedback">
                            @lang('backend.name') @lang('messages.is-correct')
                        </div>
                        <div class="invalid-feedback">
                            @lang('backend.name') @lang('messages.not-correct')
                        </div>
                    </div>
                    <div class="mb-3">
                        <label style="text-align: left;display: block;">@lang('backend.code') <span class="text-danger">*</span></label>
                        <input type="text" value="{{ $value->code }}" name="code" class="form-control" required="">
                        <div class="valid-feedback">
                            @lang('backend.code') @lang('messages.is-correct')
                        </div>
                        <div class="invalid-feedback">
                            @lang('backend.code') @lang('messages.not-correct')
                        </div>
                    </div>
                    <div class="mb-3">
                        <label style="text-align: left;display: block;">@lang('backend.icon') <span class="text-danger">*</span></label>
                        <input type="file" name="icon" class="form-control">
                    </div>
                    <div class="mb-0 text-center">
                        <div>
                            <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                                @lang('backend.submit')
                            </button>
                            <button type="button" class="btn btn-secondary cancel-button"
                                    data-dismiss="modal">@lang('backend.cancel')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
