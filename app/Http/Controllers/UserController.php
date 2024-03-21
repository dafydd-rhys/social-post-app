<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function show($userId)
    {
        $user = User::find($userId);
    
        if (!$user) {
            abort(404);
        }
    
        return view('user', ['user' => $user]);
    }
}