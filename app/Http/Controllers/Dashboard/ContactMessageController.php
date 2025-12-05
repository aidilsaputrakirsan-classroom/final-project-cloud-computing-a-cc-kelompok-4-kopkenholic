<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use App\Helpers\ActivityLogger;
class ContactMessageController extends Controller
{
    /**
     * Tampilkan daftar pesan masuk (untuk admin).
     */
    public function index()
    {
        $messages = ContactMessage::orderBy('created_at', 'desc')->paginate(10);

        return view('dashboard.contact.index', compact('messages'));
    }

    /**
     * Hapus pesan tertentu.
     */
    public function destroy($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->delete();

        return back()->with('success', 'Message deleted!.');
    }
}
