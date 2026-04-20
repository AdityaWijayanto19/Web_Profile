@extends('layouts.auth', ['illustration' => 'Illustration-3.svg'])

@section('title', 'Forgot Password')
@section('side_title', 'Reset Password')
@section('side_description', 'Enter your email address to receive a password reset link.')

@section('content')
    <div class="mb-10 text-center lg:text-left">
        <h2 class="text-4xl font-extrabold text-gray-900 tracking-tight">Reset Your Password</h2>
        <p class="text-gray-500 mt-2">Enter your email address to receive a password reset link.</p>
    </div>

    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl text-red-700 text-sm">
            @foreach ($errors->all() as $error)
                <p>• {{ $error }}</p>
            @endforeach
        </div>
    @endif

    @if (session('error'))
        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl text-red-700 text-sm flex items-center gap-2">
            <i class="fa-solid fa-circle-xmark"></i> {{ session('error') }}
        </div>
    @endif

    @if (session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl">
            <div class="flex items-start gap-3">
                <i class="fa-solid fa-circle-check text-green-600 mt-1"></i>
                <div>
                    <p class="text-green-700 font-bold text-sm mb-3">Password Reset Link Sent</p>
                    <p class="text-green-600 text-sm leading-relaxed mb-3">
                        We've sent a link to <strong>{{ request('email') }}</strong>. Please check your inbox.
                    </p>
                </div>
            </div>
        </div>
        <div class="text-center">
            <a href="{{ route('login') }}" class="text-pink-main hover:underline text-xs font-bold">Back to Login</a>
        </div>
    @else
        <form action="{{ route('password.send-reset') }}" method="POST" class="space-y-6">
            @csrf
            <div class="space-y-2">
                <label class="text-xs font-bold text-gray-400 uppercase tracking-widest ml-1">Email Address</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                        <i class="fa-solid fa-envelope"></i>
                    </span>
                    <input type="email" name="email" required value="{{ old('email') }}"
                        class="w-full pl-12 pr-4 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-4 focus:ring-pink-50 focus:border-pink-main outline-none transition-all duration-300"
                        placeholder="admin@example.com">
                </div>
            </div>
            <button type="submit" class="w-full bg-pink-main text-white font-bold py-4 rounded-2xl shadow-xl shadow-pink-200 hover:bg-[#ca0000] hover:-translate-y-1 transition-all duration-300 uppercase tracking-widest text-sm flex items-center justify-center gap-2">
                <i class="fa-solid fa-paper-plane"></i> Send Reset Link
            </button>
        </form>
        <div class="mt-8 text-center">
            <p class="text-gray-500 text-sm">Remember password? <a href="{{ route('login') }}" class="font-bold text-pink-main hover:underline">Back to Login</a></p>
        </div>
    @endif
@endsection
