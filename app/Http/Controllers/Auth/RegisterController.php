<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Models\Role;
use App\Models\Gender;

class RegisterController extends Controller
{
    public function index(){
        $roles = Role::all();
        $genders = Gender::all();

        return view('auth.register', compact('roles','genders'));
    }

    public function store(UserRequest $request){
        $credentials = $request->validated();

        $file = $request->file('image');
        $name = $file->getClientOriginalName();
        $filename = now()->timestamp.'_'.str_replace(" ","",$name);

        $imageUrl = Storage::disk('public')->putFileAs('images', $file, $filename);

        $user = User::create([
            'first_name' => $credentials['first_name'],
            'last_name' => $credentials['last_name'],
            'email' => $credentials['email'],
            'role_id' => $credentials['role'],
            'gender_id' => $credentials['gender'],
            'display_picture_link' => $imageUrl,
            'password' => Hash::make($credentials['password']),
        ]);

        Auth::login($user);

        return redirect()->route('home');
    }
}
