<?php

namespace App\Services;

use App\Models\User;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Throwable;

class AuthService
{
    /**
     * Login user with email and password
     */
    public function login($email, $password): ?User
    {
        $user = User::where('email', $email)->first();

        if ($user && Hash::check($password, $user->password)) {
            if (Hash::needsRehash($user->password)) {
                $user->update(['password' => Hash::make($password)]);
            }
            return $user;
        }

        // Authentication failed
        return null;
    }

    /**
     * Generate password reset token
     */
    public function generateResetToken($email): ?string
    {
        $user = User::where('email', $email)->first();

        if (!$user) return null;

        // Generate unique reset token
        $token = Str::random(64);

        // Store token in database with expiration (1 hour)
        $user->update([
            'reset_token' => hash('sha256', $token),
            'reset_token_expires_at' => now()->addMinutes(60)
        ]);

        return $token;
    }

    /**
     * Send password reset email
     */
    public function sendPasswordResetEmail(string $email, string $token): bool
    {
        try {
            // Gunakan queue() agar request user tidak hang/berat
            Mail::to($email)->queue(new ResetPasswordMail($email, $token));
            return true;
        } catch (Throwable $e) {
            Log::error("Email Error: " . $e->getMessage(), ['email' => $email]);
            // Jangan taruh session()->flash di sini, biarkan Controller yang handle
            return false;
        }
    }

    /**
     * Validate reset token
     */
    public function validateResetToken(string $email, string $token): ?User
    {
        // Hash token untuk keamanan
        $hashedToken = hash('sha256', $token);

        $user = User::where('email', $email)
            ->where('reset_token', $hashedToken)
            ->where('reset_token_expires_at', '>', now())
            ->first();

        return $user ?? null;
    }

    /**
     * Reset user password
     */
    public function resetPassword(string $email, string $token, string $password): bool
    {
        // Validate token first
        $user = $this->validateResetToken($email, $token);

        if (!$user) {
            return false;
        }

        try {
            return DB::transaction(function () use ($user, $password) {
                return $user->update([
                    'password' => Hash::make($password),
                    'reset_token' => null,
                    'reset_token_expires_at' => null
                ]);
            });
        } catch (Throwable $e) {
            Log::error("Reset Password Failed: " . $e->getMessage(), ['email' => $email]);
            return false;
        }
    }

    /**
     * Logout user
     */
    public function logout()
    {
        Auth::logout();
    }
}
