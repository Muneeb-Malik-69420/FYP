@extends('layout.app')

@section('content')
<div class="bg-[#007821] h-16 w-full"></div>

<div class="min-h-[calc(100vh-64px)] w-full bg-white flex items-center justify-center p-4">
    <div class="w-full max-w-md bg-white p-8 shadow-2xl rounded-xl">
        <form action="{{ route('password.email') }}" method="POST" class="flex flex-col items-center text-center">
            @csrf
            
            <div class="w-16 h-16 bg-[#007821] rounded-full flex items-center justify-center text-white text-2xl mb-5 shadow-md">
                <i class="fas fa-key"></i>
            </div>
            
            <h1 class="font-bold text-3xl m-0 text-gray-800">Forgot Password?</h1>
            <p class="text-sm text-gray-500 my-4 leading-relaxed">
                No problem. Just let us know your email address and we will email you a password reset link.
            </p>

            @if (session('status'))
                <div class="w-full bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded-sm text-xs mb-4">
                    {{ session('status') }}
                </div>
            @endif
            
            <input type="email" name="email" placeholder="Email Address" required value="{{ old('email') }}"
                class="bg-gray-100 border-none p-3 w-full rounded-sm outline-none focus:ring-2 focus:ring-[#007821] transition-shadow @error('email') ring-2 ring-red-500 @enderror" />
            @error('email')
                <span class="text-red-500 text-xs text-left w-full pl-1 mt-1 mb-2">{{ $message }}</span>
            @enderror

            <button type="submit"
                class="w-full rounded-full border border-[#007821] bg-[#007821] text-white text-xs font-bold py-3 px-12 mt-6 uppercase tracking-widest transition-transform transform active:scale-95 hover:bg-opacity-90 shadow-lg">
                Email Password Reset Link
            </button>

            <a href="{{ route('login') }}" class="mt-6 text-sm text-[#007821] font-bold hover:underline">
                <i class="fas fa-arrow-left mr-2"></i>Back to Login
            </a>
        </form>
    </div>
</div>
@endsection