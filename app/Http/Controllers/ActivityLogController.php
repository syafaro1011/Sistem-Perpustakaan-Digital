<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $query = Activity::with('causer', 'subject')
            ->latest();

        // Filter by log name (modul)
        if ($request->filled('log_name')) {
            $query->where('log_name', $request->log_name);
        }

        // Filter by causer (user)
        if ($request->filled('causer_id')) {
            $query->where('causer_id', $request->causer_id)
                ->where('causer_type', \App\Models\User::class);
        }

        // Filter by event
        if ($request->filled('event')) {
            $query->where('event', $request->event);
        }

        // Filter by tanggal
        if ($request->filled('dari')) {
            $query->whereDate('created_at', '>=', $request->dari);
        }
        if ($request->filled('sampai')) {
            $query->whereDate('created_at', '<=', $request->sampai);
        }

        $logs = $query->paginate(20)->withQueryString();
        $users = \App\Models\User::all();

        // Ambil semua log_name unik untuk filter
        $logNames = Activity::distinct()->pluck('log_name')->filter()->sort()->values();

        return view('activity-log.index', compact('logs', 'users', 'logNames'));
    }

    public function destroy(Activity $activity)
    {
        $activity->delete();
        return back()->with('success', 'Log berhasil dihapus.');
    }

    public function destroyAll()
    {
        Activity::query()->delete();
        return back()->with('success', 'Semua log berhasil dihapus.');
    }
}