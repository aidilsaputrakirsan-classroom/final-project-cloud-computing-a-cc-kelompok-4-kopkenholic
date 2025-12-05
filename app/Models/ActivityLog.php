<?php

namespace App\Models;

<<<<<<< Updated upstream
=======
use Illuminate\Database\Eloquent\Factories\HasFactory;
>>>>>>> Stashed changes
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
<<<<<<< Updated upstream
    protected $fillable = [
        'user_id',
        'username',
        'activity_id',
        'activity',
        'detail',
    ];
=======
    use HasFactory;

    protected $fillable = [
        'user_id',
        'action',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
>>>>>>> Stashed changes
}
