<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalScrollableTitle">@lang('backend.add-new')
                    : @lang('backend.permissions')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('system.permissions.store') }}" method="POST" class="needs-validation"
                      novalidate="" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label>@lang('backend.name') <span class="text-danger">*</span></label>
                        <input type="text" name="permissionName" class="form-control" required=""
                               placeholder="permissions">
                        {!! validationResponse('backend.name') !!}
                    </div>

                    <div class="mb-3">
                        <label>@lang('backend.guard-name') <span class="text-danger">*</span></label>
                        <select name="guardName" class="form-control">
                            <option value="admin">Admin</option>
                            <option value="web">Web</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>@lang('backend.permissions') <span class="text-danger">*</span></label>
                        <div class="d-flex justify-content-around">
                            <label class="d-flex align-items-center" for="name">
                                @lang('backend.permission-index')
                                <input style="margin-left: 5px" type="checkbox" name="name[]" value="index">
                            </label>
                            <label class="d-flex align-items-center" for="name">
                                @lang('backend.permission-create')
                                <input style="margin-left: 5px" type="checkbox" name="name[]" value="create">
                            </label>
                            <label class="d-flex align-items-center" for="name">
                                @lang('backend.permission-edit')
                                <input style="margin-left: 5px" type="checkbox" name="name[]" value="edit">
                            </label>
                            </label>
                            <label class="d-flex align-items-center" for="name">
                                @lang('backend.permission-delete')
                                <input style="margin-left: 5px" type="checkbox" name="name[]" value="delete">
                            </label>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
