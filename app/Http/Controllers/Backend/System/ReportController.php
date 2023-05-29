<?php

namespace App\Http\Controllers\Backend\System;

use App\Http\Controllers\Controller;
use App\Http\Helpers\CRUDHelper;
use Exception;
use Illuminate\Support\Facades\Gate;
use Spatie\Activitylog\Models\Activity;
use Symfony\Component\HttpFoundation\Response;

class ReportController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('report index'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $reports = Activity::all();
        return view('backend.system.report.index', get_defined_vars());
    }

    public function cleanAllReport()
    {
        abort_if(Gate::denies('report delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            Activity::truncate();
            alert()->success(__('messages.success'));
            return redirect()->route('system.report');
        } catch (Exception $e) {
            alert()->error(__('backend.error'));
            return redirect()->route('system.report');
        }
    }

    public function delReport($log)
    {
        check_permission('report delete');
        return CRUDHelper::remove_item('\Spatie\Activitylog\Models\Activity', $log);
    }
}
