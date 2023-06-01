@extends('master.backend')
@section('title',__('backend.permissions'))
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
                                <h4 class="mb-sm-0">@lang('backend.permissions'):</h4>
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
                                <th class="text-center">@lang('backend.actions'):</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($permissions as $permission)
                                <tr>
                                    <td>{{ $permission->id }}</td>
                                    <td>{{ $permission->name }}</td>
                                    @include('backend.templates.components.dt-system-settings',['variable' => 'permissions','value' => $permission])
                                </tr>
                            @endforeach
                            {{--                            @foreach($permissionGroups as $permission)--}}
                            {{--                                <tr>--}}
                            {{--                                    <td>{{ $permission[0]['id'] }}</td>--}}
                            {{--                                    <td>{{ $permission[0]['group_name'] }}</td>--}}
                            {{--                                    @include('backend.templates.components.dt-system-settings',['variable' => 'permissions','value' => $permission])--}}
                            {{--                                </tr>--}}
                            {{--                            @endforeach--}}
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
                            {!! validation_response('backend.name') !!}
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
                                    index
                                    <input style="margin-left: 5px" type="checkbox" name="name[]" value="index">
                                </label>
                                <label class="d-flex align-items-center" for="name">
                                    create
                                    <input style="margin-left: 5px" type="checkbox" name="name[]" value="create">
                                </label>
                                <label class="d-flex align-items-center" for="name">
                                    edit
                                    <input style="margin-left: 5px" type="checkbox" name="name[]" value="edit">
                                </label>
                                </label>
                                <label class="d-flex align-items-center" for="name">
                                    delete
                                    <input style="margin-left: 5px" type="checkbox" name="name[]" value="delete">
                                </label>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @include('backend.templates.components.dt-scripts')
@endsection
