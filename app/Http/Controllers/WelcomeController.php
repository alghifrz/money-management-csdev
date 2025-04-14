<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class WelcomeController extends Controller
{
    /**
     * Tampilkan halaman welcome jika user pertama kali login
     */
    public function index()
    {
        // Cek apakah user sudah memiliki profil
        $profile = UserProfile::getActive();

        // Jika sudah ada username dan bukan first time login, redirect ke dashboard
        if ($profile && $profile->username && !$profile->first_time_login) {
            return Redirect::route('dashboard');
        }

        return view('welcome', ['profile' => $profile]);
    }

    /**
     * Menyimpan username dari halaman welcome
     */
    public function saveUsername(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255',
        ]);

        // Cek apakah sudah ada profil
        $profile = UserProfile::getActive();

        if ($profile) {
            $profile->update([
                'username' => $validated['username'],
                'first_time_login' => false,
            ]);
        } else {
            UserProfile::create([
                'username' => $validated['username'],
                'first_time_login' => false,
            ]);
        }

        return Redirect::route('dashboard')->with('success', 'Selamat datang, ' . $validated['username'] . '!');
    }
}
