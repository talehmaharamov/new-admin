@extends('master.backend')
@section('title',__('backend.give-permission'))
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-xl-8">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('system.givePermissionUserUpdate') }}" method="POST"
                                      class="custom-validation" novalidate="" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-12">
                                        <div class="d-flex justify-content-between mb-4">
                                            <h4>@lang('backend.give-permission') : {{ $user->name }}</h4>
                                            <div class="form-check">
                                                <label class="checkbox">
                                                    <input type="checkbox" class="form-check-input"
                                                           id="check-all">
                                                    <span></span>
                                                    @lang('backend.check-uncheck')
                                                </label>
                                            </div>
                                        </div>
                                        <input hidden name="id" value="{{ $user->id }}">
                                        <div class="table-responsive">
                                            <table class="table table-flush-spacing">
                                                <tbody>

                                                @foreach($permissionGroups as $pg)
                                                    <tr style="width: 100%">
                                                        <td class="text-nowrap fw-semibold col-5">{{ __('backend.'.$pg[0]['group_name']) }}</td>
                                                        <td class="col-7">
                                                            <div class="d-flex">
                                                                @foreach($pg as $permission)
                                                                    <div class="form-check me-3 me-lg-5">
                                                                        <input class="form-check-input" type="checkbox"
                                                                               name="permissions[]"
                                                                               @if($user->hasPermissionTo($permission->id)) checked
                                                                               @endif
                                                                               value="{{ $permission->id }}"
                                                                               id="userManagementRead">
                                                                        <label class="form-check-label"
                                                                               for="userManagementRead">
                                                                            {{__('backend.permission-'.
                                                                            str_replace($permission->group_name." ",'',$permission->name) )}}
                                                                        </label>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
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
