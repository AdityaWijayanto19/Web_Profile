@extends('layouts.auth', ['illustration' => 'Illustration-4.svg'])

@section('title', 'Reset Password - Admin Portal')
@section('side_title', 'Reset Password')
@section('side_description', 'Create a new password for your account.')

@section('content')
    <div class="mb-10 text-center lg:text-left">
        <h2 class="text-4xl font-extrabold text-gray-900 tracking-tight">Reset Password</h2>
        <p class="text-gray-500 mt-2">Create a new password for your account.</p>
    </div>

    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl text-red-700 text-sm">
            @foreach ($errors->all() as $error)
                <p>• {{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('password.update') }}" method="POST" class="space-y-6">
        @csrf
        <input type="hidden" name="email" value="{{ $email }}">
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="space-y-2">
            <label class="text-xs font-bold text-gray-400 uppercase tracking-widest ml-1">New Password</label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                    <i class="fa-solid fa-lock"></i>
                </span>
                <input type="password" id="password" name="password" required
                    class="w-full pl-12 pr-12 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-4 focus:ring-pink-50 focus:border-pink-main outline-none transition-all duration-300"
                    placeholder="••••••••">
                <button type="button" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-pink-main toggle-password" data-target="password">
                    <i class="fa-solid fa-eye"></i>
                </button>
            </div>
        </div>

        <div class="space-y-2">
            <label class="text-xs font-bold text-gray-400 uppercase tracking-widest ml-1">Confirm Password</label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                    <i class="fa-solid fa-lock"></i>
                </span>
                <input type="password" id="password_confirmation" name="password_confirmation" required
                    class="w-full pl-12 pr-12 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-4 focus:ring-pink-50 focus:border-pink-main outline-none transition-all duration-300"
                    placeholder="••••••••">
                <button type="button" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-pink-main toggle-password" data-target="password_confirmation">
                    <i class="fa-solid fa-eye"></i>
                </button>
            </div>
        </div>

        <button type="submit" class="w-full bg-pink-main text-white font-bold py-4 rounded-2xl shadow-xl shadow-pink-200 hover:bg-[#ca0000] hover:-translate-y-1 transition-all duration-300 uppercase tracking-widest text-sm">
            Reset Password
        </button>
    </form>

    <div class="mt-8 text-center">
        <a href="{{ route('login') }}" class="font-bold text-pink-main hover:underline">Back to Login</a>
    </div>
@endsection
