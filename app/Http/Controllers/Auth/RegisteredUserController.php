<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $tampid = mt_rand(10, 99); // Adjust the range as needed

        session()->put('tampid',$tampid);
    
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'usertype' => $request->is_admin ?? false,
            'password' => Hash::make($request->password),
            'tampid' => $tampid,
            
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('showcategories', absolute: false));
    }
}
