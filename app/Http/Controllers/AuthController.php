<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AuthController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Show login form
     */
    public function showLogin(): RedirectResponse|View
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('auth.login');
    }

    /**
     * Handle login
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        $user = $this->authService->login(
            $request->email,
            $request->password
        );

        if ($user) {
            // Login the user
            Auth::login($user, $request->boolean('remember'));

            // Redirect to dashboard
            return redirect()
                ->route('dashboard')
                ->with('success', 'Login successful! Welcome back.');
        }

        // Login failed
        return back()
            ->withInput($request->only('email'))
            ->with('error', 'Invalid email or password.');
    }

    /**
     * Show forgot password form
     */
    public function showForgotPassword(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle forgot password request
     */
    public function forgotPassword(ForgotPasswordRequest $request): RedirectResponse
    {
        $token = $this->authService->generateResetToken($request->email);

        if (!$token) {
            return back()->with('error', 'Email not found in our system.');
        }

        // Send password reset email
        $emailSent = $this->authService->sendPasswordResetEmail($request->email, $token);

        if (!$emailSent) {
            return back()->with('error', 'Failed to send reset email. Please try again.');
        }

        return back()
            ->with('success', 'Password reset link has been sent to your email. Check your inbox for further instructions.');
    }

    /**
     * Show reset password form
     */
    public function showResetPassword(): RedirectResponse|View
    {
        // Get parameters from URL or request
        $token = request()->query('token');
        $email = request()->query('email');

        if (!$token || !$email) {
            return redirect()
                ->route('password.forgot')
                ->with('error', 'Invalid reset link.');
        }

        // Validate token
        $user = $this->authService->validateResetToken($email, $token);

        if (!$user) {
            return redirect()
                ->route('password.forgot')
                ->with('error', 'This password reset token has expired.');
        }

        return view('auth.reset-password', [
            'token' => $token,
            'email' => $email,
        ]);
    }

    /**
     * Handle password reset
     */
    public function resetPassword(ResetPasswordRequest $request): RedirectResponse
    {
        $success = $this->authService->resetPassword(
            $request->email,
            $request->token,
            $request->password
        );

        if (!$success) {
            return redirect()
                ->route('password.forgot')
                ->with('error', 'This password reset token has expired or is invalid.');
        }

        return redirect()
            ->route('login')
            ->with('success', 'Password has been reset successfully. Please login with your new password.');
    }

    /**
     * Handle logout
     */
    public function logout(): RedirectResponse
    {
        $this->authService->logout();

        return redirect()
            ->route('login')
            ->with('success', 'You have been logged out successfully.');
    }
}

