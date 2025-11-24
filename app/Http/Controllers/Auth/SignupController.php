<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SignupController extends Controller
{
    public function index() {
        if (Auth::check()) {
            return redirect()->route("dashboard.home");
        }

        // Aman kalau baris di site_settings belum ada
        $enable_registration = optional(
            SiteSetting::select('enable_registration')->first()
        )->enable_registration ?? true;

        return view("auth.signup", compact("enable_registration"));
    }

    public function signup(Request $request) {
        if (Auth::check()) {
            return redirect()->route("frontend.home");
        }

        $enable_registration = optional(
            SiteSetting::select('enable_registration')->first()
        )->enable_registration ?? true;

        if (!$enable_registration) {
            return back();
        }

        $validated = $request->validate([
            "name"      => ["required", "string", "min:3", "max:100"],
            "username"  => ["required", "string", "regex:/^\w+$/", "unique:users,username", "max:100"],
            "email"     => ["required", "email:rfc", "unique:users,email", "max:255"],
            "password"  => ["required", "confirmed", "min:6", "max:100"],
            "password_confirmation" => ["required"],
            "agree"     => ["required", "accepted"],
        ]);

        $user = User::create([
            'name'      => $validated['name'],
            'username'  => $validated['username'],
            'email'     => $validated['email'],
            'password'  => Hash::make($validated['password']), // <-- HASH
            'status'    => 1,                                   // <-- AKTIF
            // 'email_verified_at' => now(), // aktifkan kalau perlu
            // set kolom lain default di sini bila ada (role, dll.)
        ]);

        Auth::loginUsingId($user->id);
        return redirect()->route("dashboard.home");
    }
}
