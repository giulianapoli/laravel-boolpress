<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    public function guest() {
        $message = 'Welcome!';

        return view('test', compact('message'));
    }

    public function logged() {
        $user = Auth::user();
        $message = 'Welcome, '.$user->name;

        return view('test', compact('message'));
    }
}
