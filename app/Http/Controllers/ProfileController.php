<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function create()
    {
        return view('pages.profile');
    }

    public function update()
    {

        $user = request()->user();
        $attributes = request()->validate([
            'email' => 'required|email|unique:users,email,' . $user->id,
            'name' => 'required',
            'phone' => 'required|max:10',
            'about' => 'required:max:150',
            'location' => 'required'
        ]);

        auth()->user()->update($attributes);
        return back()->withStatus('Profile successfully updated.');
    }
    public function post_user_profile(Request $request){
        $oldData = User::where('id',auth()->user()->id)->first();
        if($request->password){
            $password = Hash::make($request->password);
        } else {
            $password = $oldData->password;
        }
        User::where('id',auth()->user()->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $password
        ]);
        return redirect()->route('backoffice.dashboard');

    }
}
