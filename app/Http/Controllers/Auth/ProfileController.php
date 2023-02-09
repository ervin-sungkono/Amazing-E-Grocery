<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

use App\Models\User;
use App\Models\Role;
use App\Models\Gender;

class ProfileController extends Controller
{
    public function index(){
        $genders = Gender::all();
        $user = Auth::user();

        return view('profile', compact('genders', 'user'));
    }

    public function update(UpdateUserRequest $request){
        $credentials = $request->validated();

        $user = User::findOrFail(Auth::user()->user_id);

        $storage = Storage::disk('public');

        $storage->delete($user->display_picture_link);

        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();
        $name = $file->getClientOriginalName();
        $filename = str_replace(" ", "", $name).'_'.now()->timestamp.$extension;

        $imageUrl = $storage->putFileAs('images', $file, $filename);

        $newUser = $user->update([
            'first_name' => $credentials['first_name'],
            'last_name' => $credentials['last_name'],
            'email' => $credentials['email'],
            'gender_id' => $credentials['gender'],
            'display_picture_link' => $imageUrl,
            'password' => Hash::make($credentials['password']),
        ]);

        $status = $newUser ? 'success' : 'fail';
        $message = $newUser ? __('messages.update_profile_success') : __('messages.update_profile_fail');

        return view('saved')->with($status, $message);
    }
}
