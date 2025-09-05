<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function posts(User $user)
    {
        $user->load([
            'posts' => function ($query) {
                $query->orderBy('uploaded_at', 'desc');
            }
        ]);

        return view('user.posts', compact('user'));
    }
}
