<?php

namespace App\Http\Controllers;

use App\Models\LecturerUser;
use Str;
use Hash;
use Illuminate\Auth\Events\PasswordReset;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash as FacadesHash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Password;

class SessionsController extends Controller
{
    public function create()
    {
        return view('sessions.create');
    }

    public function store()
    {
        // $attributes = request()->validate([
        //     'email' => 'required|email',
        //     'password' => 'required'
        // ]);

        // if (!auth()->attempt($attributes)) {
        //     throw ValidationException::withMessages([
        //         'email' => 'Your provided credentials could not be verified.'
        //     ]);
        // }

        // session()->regenerate();
        $user = User::where('email', request()->email)->first();
        if ($user == NULL) {
            $lecturer_user = LecturerUser::where('nidn',request()->email)->first();
            if ($lecturer_user == NULL) {
                throw ValidationException::withMessages([
                    'email' => 'NIDN or Email not found'
                ]);
            } else {
                $user = User::where('id', $lecturer_user->user_id)->first();
            }
        }
        if (FacadesHash::check(request()->password,$user->password)) {
            Auth::loginUsingId($user->id);
            return redirect(route('backoffice.dashboard'));
        }
        throw ValidationException::withMessages([
            'email' => 'Your provided credentials could not be verified.'
        ]);
    }

    public function show()
    {
        request()->validate([
            'email' => 'required|email',
        ]);

        $status = Password::sendResetLink(
            request()->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function update()
    {

        request()->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            request()->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => ($password)
                ])->setRememberToken(string::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

    public function destroy()
    {
        auth()->logout();

        return redirect('/sign-in');
    }
}
