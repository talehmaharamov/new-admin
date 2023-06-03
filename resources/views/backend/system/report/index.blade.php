@extends('master.backend')
@section('title',__('backend.report'))
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
                                <h4 class="mb-sm-0">@lang('backend.report'):</h4>
                                @can('report delete')
                                    <a href="{{ route('system.cleanAllReport') }}"
                                       onclick="return {{ (count($reports) > 0 ? 'true' : 'false') }}"
                                       class="btn btn-{{ (count($reports) > 0 ? 'danger' : 'secondary') }} mb-3"><i
                                            class="fas fa-trash-alt"></i>
                                        &nbsp;@lang('backend.clean-all')
                                    </a>
                                @endcan
                            </div>
                        </div>
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                               style="border-collapse: collapse; border-spacing: 0; width: 100%; word-break: break-all">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>@lang('backend.subject-type'):</th>
                                <th>@lang('backend.event'):</th>
                                <th>@lang('backend.causer'):</th>
                                <th>@lang('backend.content'):</th>
                                <th>@lang('backend.time'):</th>
                                @can('report delete')
                                    <th class="text-center">@lang('backend.actions'):</th>
                                @endcan
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($reports as $report)
                                <tr>
                                    <td>{{ $report->id }}</td>
                                    <td>{{$report->subject_type}}</td>
                                    <td>{{ __('backend.'.$report->event)}}</td>
                                    <td>{{\App\Models\User::where('id',$report->causer_id)->value('name')}}</td>
                                    <td>
                                        <textarea disabled rows="4"
                                                  cols="50">{{ ($report->properties)->toJson(JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) }}</textarea>
                                    </td>
                                    <td>{{date('d.m.Y H:i:s',strtotime($report->created_at)) }}</td>
                                    @can('report delete')
                                        <td class="text-center">
                                            <a class="btn btn-danger"
                                               href="{{ route('system.reportsDelete',['id'=>$report->id]) }}">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    @endcan
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @include('backend.templates.components.dt-scripts')
@endsection
