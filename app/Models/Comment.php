<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    /**
     * Relasi ke Post
     */
    public function post()
    {
        // Post yang bisa saja terhapus (soft delete)
        return $this->belongsTo(\App\Models\Post::class, 'post_id')->withTrashed();
    }

    /**
     * Relasi ke User (jika ada kolom user_id di tabel comments)
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id')->withTrashed();
    }
}
