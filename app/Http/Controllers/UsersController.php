<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class UsersController extends Controller
{
    //
    public function index() {

        $user = Auth::user()->role;

        if ($user != 0) {
            return abort(404);
        }

        $users = User::whereNotIn('role', [0])->get();

        $users->transform(function ($user) {
            $user->role_name = User::ROLES[$user->role];
            $user->active = User::STATUSES[$user->active];
            return $user;
        });

        return Inertia::render('Users/Index', [
            'users' => $users
        ]);
    }
}
