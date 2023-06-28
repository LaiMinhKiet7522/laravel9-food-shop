<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use App\Notifications\UserRegisterNotification;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:' . User::class],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'captcha_code' => 'captcha',
            'checkbox' => 'accepted'
        ], [
            'username.unique' => 'The user name already exists. Please enter another user name.',
            'email.unique' => 'The email already exists. Please enter another email.',
            'phone.unique' => 'The phone number already exists. Please enter another phone number.',
            'checkbox.accepted' => 'Please agree to our policies to proceed with account registration.'
        ]);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        $new_user = User::where('role','admin')->get();
        //Notification To Admin
        Notification::send($new_user, new UserRegisterNotification($request));

        return redirect(RouteServiceProvider::HOME);
    }

    public function ReloadCaptcha()
    {
        return response()->json(['captcha' => captcha_img('flat')]);
    }
}
