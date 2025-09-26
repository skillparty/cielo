<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'phone' => ['required', 'string', 'min:8', 'max:20', 'unique:'.User::class],
            'address_line1' => ['required', 'string', 'max:255'],
            'address_line2' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:120'],
            'state' => ['nullable', 'string', 'max:120'],
            'postal_code' => ['nullable', 'string', 'max:30'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'terms' => ['accepted'],
        ]);

        $user = User::create([
            'name' => $request->string('name')->toString(),
            'email' => $request->string('email')->lower()->toString(),
            'phone' => $request->string('phone')->toString(),
            'address_line1' => $request->string('address_line1')->toString(),
            'address_line2' => $request->string('address_line2')->toString(),
            'city' => $request->string('city')->toString(),
            'state' => $request->string('state')->toString(),
            'postal_code' => $request->string('postal_code')->toString(),
            'accepted_terms_at' => Carbon::now(),
            'password' => Hash::make($request->string('password')->toString()),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
