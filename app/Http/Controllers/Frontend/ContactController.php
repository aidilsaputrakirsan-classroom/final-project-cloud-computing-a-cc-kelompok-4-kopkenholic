<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index() {
        return view('frontend.contact.index');
    }

    public function store(Request $r) {
        $data = $r->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email',
            'subject' => 'nullable|string|max:150',
            'message' => 'required|string'
        ]);

        ContactMessage::create($data);

        return back()->with('success','Message Sent, Thank You!');
    }
}
