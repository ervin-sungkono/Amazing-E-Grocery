<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Role;
use App\Http\Requests\UpdateRoleRequest;

class AdminController extends Controller
{
    public function index(){
        $users = User::paginate(10);

        return view('maintenance', compact('users'));
    }

    public function updateRoleForm($lang, $id){
        $user = User::findOrFail($id);
        $roles = Role::all();

        return view('role_update', compact('user', 'roles'));
    }

    public function updateRole(UpdateRoleRequest $request, $id){
        $validated = $request->validated();

        $user = User::findOrFail($id);

        $newUser = $user->update([
            'role_id' => $validated['role']
        ]);

        $status = $newUser ? 'success' : 'fail';
        $message = $newUser ? __("Role successfully updated") : __("Fail to update role");

        return redirect()->route('account.maintenance', ['lang' => session('locale')])->with($status, $message);
    }

    public function deleteAccount($id){
        $user = User::findOrFail($id);

        Storage::disk('public')->delete($user->display_picture_link);
        $status = $user->delete() ? 'success' : 'fail';
        $message = $status == 'success' ? __('Account deleted successfully') : __('Fail to delete account');

        return redirect()->route('account.maintenance', ['lang' => session('locale')])->with($status, $message);
    }
}
