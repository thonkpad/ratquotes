<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/user/{user}', [UserController::class, 'posts'])->name('user.posts');

Route::get('/privacy', function () {
    return view('privacy');
})->name('privacy');

Route::get('/login/discord', function () {
    return Socialite::driver('discord')->redirect();
});

Route::get('/login/discord/callback', function (Request $request) {
    try {
        $discordUser = Socialite::driver('discord')->stateless()->user();

        $user = \App\Models\User::where('email', $discordUser->email)->first();

        if (!$user) {
            $user = \App\Models\User::create([
                'discord_id' => $discordUser->id,
                'name' => $discordUser->name ?? $discordUser->nickname,
                'email' => $discordUser->email,
                'avatar' => $discordUser->avatar,
                'password' => bcrypt(Str::random(32)),
            ]);
        } else {
            $user->update([
                'discord_id' => $discordUser->id,
                'avatar' => $discordUser->avatar,
            ]);
        }

        Auth::login($user, true);

        return redirect('/');

    } catch (\Throwable $e) {
        Log::error('Discord OAuth callback failed', [
            'exception' => $e,
            'request_all' => $request->all(),
        ]);

        if (config('app.debug')) {
            return response()->json([
                'error' => 'OAuth failed',
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ], 500);
        }

        return response()->json(['error' => 'OAuth failed', 'message' => 'Check logs.'], 500);
    }
});
require __DIR__ . '/auth.php';
