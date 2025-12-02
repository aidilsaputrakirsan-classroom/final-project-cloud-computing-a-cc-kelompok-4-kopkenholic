<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;

class ActivityLogController extends Controller
{
    public function index()
    {
        $logs = ActivityLog::orderBy('id', 'DESC')->paginate(50);

        return view('dashboard.activity_logs.index', compact('logs'));
    }
}
