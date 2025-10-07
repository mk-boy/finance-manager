<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $user_info = Auth::user();

        return view('profile.main', [
            'user_info' => $user_info
        ]);
    }

    public function editView()
    {
        $user_info = Auth::user();

        return view('profile.edit', [
            'user_info' => $user_info
        ]);
    }

    public function edit(Request $request)
    {
        $user = Auth::user();

        $name = $request->name;
        $email = $request->email;

        $user->update([
            'name' => $name,
            'email' => $email
        ]);

        return redirect(route('profile'));
    }
}