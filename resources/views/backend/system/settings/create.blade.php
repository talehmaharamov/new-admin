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
                        {!! validationResponse('backend.name') !!}
                    </div>
                    <div class="mb-3">
                        <label>@lang('backend.link') <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="link" rows="5" required
                                  placeholder="https://www.instagram.com/@username"></textarea>
                        {!! validationResponse('backend.link') !!}
                    </div>
                    <div class="mb-3">
                        <label>@lang('backend.type') <span class="text-danger">*</span></label>
                        <select class="form-control" name="type">
                            <option
                                value="{{ \App\Http\Enums\SettingEnum::OTHER }}">@lang('backend.other')</option>
                            <option
                                value="{{ \App\Http\Enums\SettingEnum::SOSIAL }}">@lang('backend.sosial')</option>
                        </select>
                        {!! validationResponse('backend.name') !!}
                    </div>
                    @include('backend.templates.components.modal-button')
                </form>
            </div>
        </div>
    </div>
</div>
