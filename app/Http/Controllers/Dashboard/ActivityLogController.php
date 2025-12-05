<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
<<<<<<< Updated upstream

class ActivityLogController extends Controller
{
    public function index()
    {
        $logs = ActivityLog::orderBy('id', 'DESC')->paginate(50);
=======
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $logs = ActivityLog::with('user')
            ->orderBy('id', 'DESC')
            ->paginate(20);
>>>>>>> Stashed changes

        return view('dashboard.activity_logs.index', compact('logs'));
    }
}
