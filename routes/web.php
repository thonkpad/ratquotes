<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

Route::get('/login/discord', function () {
    return Socialite::driver('discord')->redirect();
});

Route::get('/login/discord/callback', function () {
    try {
        $discordUser = Socialite::driver('discord')->user();

        $user = User::where('email', $discordUser->email)->first();

        if (!$user) {
            // If not found, create a new user
            $user = User::create([
                'discord_id' => $discordUser->id,
                'name' => $discordUser->name ?? $discordUser->nickname,
                'email' => $discordUser->email,
                'avatar' => $discordUser->avatar,
                'password' => bcrypt(Str::random(32)), // Required field
            ]);
        } else {
            // If found, optionally update discord_id or avatar
            $user->update([
                'discord_id' => $discordUser->id,
                'avatar' => $discordUser->avatar,
            ]);
        }

        Auth::login($user);

        return redirect('/');

    } catch (\Exception $e) {
        return response()->json(['error' => 'OAuth failed', 'message' => $e->getMessage()]);
    }
});

require __DIR__ . '/auth.php';
