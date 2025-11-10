<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    use HasFactory;

    // nama tabel (opsional kalau sudah sesuai konvensi)
    protected $table = 'contact_messages';

    // kolom yang boleh diisi (mass assignable)
    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'ip_address',
        'status'
    ];
}
