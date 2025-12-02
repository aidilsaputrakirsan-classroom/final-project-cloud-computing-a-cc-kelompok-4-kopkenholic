<?php

namespace App\helpers; // <-- SESUAIKAN dengan foldermu: helpers (kecil) / Helpers (besar)

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class ActivityLogger
{
    public static function log($activity, $detail = null, $activityId = null)
    {
        $user = Auth::user();

        ActivityLog::create([
            'user_id'     => $user?->id,
            'username'    => $user?->name,
            'activity_id' => $activityId,
            'activity'    => $activity,
            'detail'      => $detail,
        ]);
    }
}
