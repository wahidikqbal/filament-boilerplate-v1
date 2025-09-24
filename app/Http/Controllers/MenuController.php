<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function show(User $user)
    {
        return view('form', ['user' => $user]);
    }
}
