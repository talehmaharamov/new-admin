<div class="modal fade" id="editModal{{ $value->id }}" tabindex="-1" role="dialog"
     aria-labelledby="editModalLabel{{ $value->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel{{ $value->id }}">@lang('backend.edit'): #{{ $value->id }}</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('system.settings.update',$value->id) }}" method="POST"
                      class="needs-validation" novalidate="" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label style="text-align: left;display: block;">@lang('backend.name') <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" required=""
                               value="{{ $value->name }}">
                        {!! validationResponse('backend.name') !!}
                    </div>
                    <div class="mb-3">
                        <label style="text-align: left;display: block;">@lang('backend.link') <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="link" rows="5"
                                  required>{{ $value->link }}</textarea>
                        {!! validationResponse('backend.link') !!}
                    </div>
                    <div class="mb-3">
                        <label style="text-align: left;display: block;">@lang('backend.type') <span class="text-danger">*</span></label>
                        <select class="form-control" name="type">
                            <option @if($value->type == \App\Http\Enums\SettingEnum::OTHER) selected @endif
                                value="{{ \App\Http\Enums\SettingEnum::OTHER }}">@lang('backend.other')</option>
                            <option @if($value->type == \App\Http\Enums\SettingEnum::SOSIAL) selected @endif
                                value="{{ \App\Http\Enums\SettingEnum::SOSIAL }}">@lang('backend.sosial')</option>
                        </select>
                        {!! validationResponse('backend.name') !!}
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
