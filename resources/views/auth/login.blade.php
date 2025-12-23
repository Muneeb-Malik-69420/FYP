@extends('layout.app')

@section('content')
<div class="min-h-[calc(100vh-64px)] w-full bg-gray-50 flex items-center justify-center p-4">
    <div class="w-full max-w-md bg-white shadow-2xl rounded-2xl overflow-hidden">
        <form action="{{ route('login') }}" method="POST"
            class="flex flex-col items-center px-10 py-12 text-center w-full">
            @csrf
            
            <div class="w-16 h-16 bg-[#007821] rounded-full flex items-center justify-center text-white text-2xl mb-5 shadow-md flex-shrink-0">
                <i class="fas fa-leaf"></i>
            </div>
            
            <h1 class="font-bold text-3xl m-0 text-gray-800">Sign in</h1>
            
            <div class="flex w-full gap-2 my-5">
                <a href="/auth/google" class="flex-1 border border-gray-300 rounded-md py-2 px-4 flex items-center justify-center gap-2 hover:bg-gray-50 transition group">
                    <i class="fab fa-google text-red-500 text-lg"></i>
                    <span class="text-sm font-medium text-gray-600 group-hover:text-gray-800">Google</span>
                </a>
                <a href="/auth/facebook" class="flex-1 border border-gray-300 rounded-md py-2 px-4 flex items-center justify-center gap-2 hover:bg-gray-50 transition group">
                    <i class="fab fa-facebook text-gray-900 text-lg"></i>
                    <span class="text-sm font-medium text-gray-600 group-hover:text-gray-800">Facebook</span>
                </a>
            </div>

            <span class="text-xs mb-2 text-gray-500">or use your account</span>
            
            <input type="email" name="email" placeholder="Email" required value="{{ old('email') }}"
                class="bg-gray-100 border-none p-3 mt-2 w-full rounded-sm outline-none focus:ring-2 focus:ring-[#007821] transition-shadow @error('email') ring-2 ring-red-500 @enderror" />
            @error('email')
                <span class="text-red-500 text-xs text-left w-full pl-1 mb-2">{{ $message }}</span>
            @enderror

            <input type="password" name="password" placeholder="Password" required
                class="bg-gray-100 border-none p-3 mt-2 w-full rounded-sm outline-none focus:ring-2 focus:ring-[#007821] transition-shadow @error('password') ring-2 ring-red-500 @enderror" />
            @error('password')
                <span class="text-red-500 text-xs text-left w-full pl-1 mb-2">{{ $message }}</span>
            @enderror

            <a href="{{ route('password.request') }}" class="text-gray-600 text-sm no-underline my-4 hover:underline hover:text-[#007821]">Forgot your password?</a>
            
            <button type="submit"
                class="w-full rounded-full border border-[#007821] bg-[#007821] text-white text-xs font-bold py-3 uppercase tracking-widest transition-transform transform active:scale-95 hover:bg-opacity-90 shadow-lg">
                Sign In
            </button>

            <p class="mt-8 text-sm text-gray-500">
                Don't have an account? 
                <a href="{{ route('register') }}" class="text-[#007821] font-bold hover:underline">Sign Up Now</a>
            </p>
        </form>
    </div>
</div>
@endsection