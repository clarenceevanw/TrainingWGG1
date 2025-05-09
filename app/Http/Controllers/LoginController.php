<?php

namespace App\Http\Controllers;

use App\Models\LevelAkses;
use App\Models\Pegawai;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showLogin()
    {
        return view('auth.login', [
            'title' => 'Login',
        ]);
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            $user = Pegawai::where('email', $googleUser->getEmail())->first();
            if ($user){
                session(['pegawai_id' => $user->id]);
                session(['level_akses_id' => $user->level_akses_id]);
                $levelAkses = LevelAkses::where('id', session('level_akses_id'))->firstOrFail();
                session(['level_akses_name' => $levelAkses->name]);
                return redirect()->route('pegawai.info')->with('success', 'Berhasil login.');
            } else {
                return redirect()->route('login')->with('error', 'Email tidak terdaftar.');
            }
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Gagal login dengan Google.');
        }
    }
    public function logout()
    {
        session()->forget(['pegawai_id', 'level_akses_id', 'level_akses_name']);
        session()->flush();
        return redirect()->route('login')->with('success', 'Berhasil logout.');
    }
}
