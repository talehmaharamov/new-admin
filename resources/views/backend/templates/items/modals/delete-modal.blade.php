<div class="modal fade" id="deleteModal{{ $value->id }}" tabindex="-1" role="dialog"
     aria-labelledby="deleteModalLabel{{ $value->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel{{ $value->id }}">@lang('backend.confirm-delete')</h5>
            </div>
            <div class="modal-body">
                <p style="text-align: left;">@lang('backend.are-sure-delete')</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary cancel-button"
                        data-dismiss="modal">@lang('backend.cancel')</button>
                <a href="{{ route('backend.'.$variable.'Delete',['id'=> $value->id]) }}"
                   class="btn btn-danger">@lang('backend.confrim')</a>
            </div>
        </div>
    </div>
</div>
