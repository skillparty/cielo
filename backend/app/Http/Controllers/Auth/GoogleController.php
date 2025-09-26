<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\GoogleProfileCompletionRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\Response;

class GoogleController extends Controller
{
    public function redirect(): RedirectResponse
    {
        return Socialite::driver('google')
            ->scopes(['openid', 'profile', 'email'])
            ->redirect();
    }

    public function callback(Request $request): RedirectResponse
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
        } catch (\Throwable $exception) {
            Log::warning('Google OAuth callback failed', ['message' => $exception->getMessage()]);
            return redirect()->route('login')->withErrors([
                'email' => __('No se pudo autenticar con Google. Inténtalo nuevamente.'),
            ]);
        }

        $existingUser = User::query()
            ->where('google_id', $googleUser->getId())
            ->orWhere('email', $googleUser->getEmail())
            ->first();

        if ($existingUser) {
            $existingUser->forceFill([
                'google_id' => $googleUser->getId(),
                'google_token' => $googleUser->token ?? null,
                'google_refresh_token' => $googleUser->refreshToken ?? null,
                'avatar_url' => $googleUser->avatar,
            ])->save();

            if (!$existingUser->hasVerifiedEmail() && $googleUser->getEmail()) {
                $existingUser->forceFill([
                    'email' => $existingUser->email ?? $googleUser->getEmail(),
                    'email_verified_at' => Carbon::now(),
                ])->save();
            }

            Auth::login($existingUser, true);

            return redirect()->intended(route('dashboard'));
        }

        Session::put('google_onboarding', [
            'id' => $googleUser->getId(),
            'name' => $googleUser->getName(),
            'email' => $googleUser->getEmail(),
            'token' => $googleUser->token ?? null,
            'refresh_token' => $googleUser->refreshToken ?? null,
            'avatar' => $googleUser->avatar,
            'expires_in' => $googleUser->expiresIn ?? null,
        ]);

        return redirect()->route('auth.google.complete.form');
    }

    public function completeProfileForm(Request $request): Response|RedirectResponse
    {
        if (!Session::has('google_onboarding')) {
            return redirect()->route('login');
        }

        $data = Session::get('google_onboarding');

        return response()->view('auth.google-complete', [
            'name' => $data['name'] ?? '',
            'email' => $data['email'] ?? '',
        ]);
    }

    public function completeProfile(GoogleProfileCompletionRequest $request): RedirectResponse
    {
        $onboarding = Session::pull('google_onboarding');

        if (!$onboarding) {
            return redirect()->route('login');
        }

        $user = User::create([
            'name' => $request->string('name'),
            'email' => $request->filled('email') ? $request->string('email')->lower() : null,
            'phone' => $request->string('phone'),
            'address_line1' => $request->string('address_line1'),
            'address_line2' => $request->string('address_line2'),
            'city' => $request->string('city'),
            'state' => $request->string('state'),
            'postal_code' => $request->string('postal_code'),
            'accepted_terms_at' => Carbon::now(),
            'password' => bcrypt(Str::random(32)),
            'google_id' => $onboarding['id'],
            'google_token' => $onboarding['token'],
            'google_refresh_token' => $onboarding['refresh_token'],
            'avatar_url' => $onboarding['avatar'],
            'email_verified_at' => Carbon::now(),
        ]);

        event(new Registered($user));

        Auth::login($user, true);

        return redirect()->intended(route('dashboard'));
    }
}
