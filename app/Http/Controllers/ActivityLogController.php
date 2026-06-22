<?php
namespace App\Http\Controllers;

use Spatie\Activitylog\Models\Activity;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $logs = Activity::with('causer')
            ->when($request->log_name, fn($q) => $q->inLog($request->log_name))
            ->latest()
            ->paginate(20);

        $logNames = Activity::distinct()->pluck('log_name')->filter()->sort()->values();

        return view('activity-log.index', compact('logs', 'logNames'));
    }
}
