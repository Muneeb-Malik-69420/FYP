@extends('layout.app')

@section('content')
<div class="min-h-[calc(100vh-64px)] w-full bg-gray-50 flex items-center justify-center p-4">
    <div class="w-full max-w-md bg-white shadow-2xl rounded-2xl overflow-hidden my-8">
        <form action="{{ route('register') }}" method="POST"
            class="flex flex-col items-center px-10 py-10 text-center w-full">
            @csrf
            
            <div class="w-16 h-16 bg-[#007821] rounded-full flex items-center justify-center text-white text-2xl mb-5 shadow-md flex-shrink-0">
                <i class="fas fa-leaf"></i>
            </div>

            <h1 class="font-bold text-3xl m-0 text-gray-800">Create Account</h1>

            <div class="flex w-full gap-2 my-5">
                <a href="/auth/google" class="flex-1 border border-gray-300 rounded-md py-2 px-4 flex items-center justify-center gap-2 hover:bg-gray-50 transition group">
                    <i class="fab fa-google text-red-500 text-lg"></i>
                    <span class="text-sm font-medium text-gray-600 group-hover:text-gray-800">Google</span>
                </a>
                <a href="/auth/github" class="flex-1 border border-gray-300 rounded-md py-2 px-4 flex items-center justify-center gap-2 hover:bg-gray-50 transition group">
                    <i class="fab fa-github text-gray-900 text-lg"></i>
                    <span class="text-sm font-medium text-gray-600 group-hover:text-gray-800">GitHub</span>
                </a>
            </div>

            <span class="text-xs mb-2 text-gray-500">or use your email for registration</span>

            <input type="text" name="name" placeholder="Username" required value="{{ old('name') }}"
                class="bg-gray-100 border-none p-3 mt-2 w-full rounded-sm outline-none focus:ring-2 focus:ring-[#007821] transition-shadow @error('name') ring-2 ring-red-500 @enderror" />
            @error('name')
                <span class="text-red-500 text-xs text-left w-full pl-1 mb-2">{{ $message }}</span>
            @enderror

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

            <input type="password" name="password_confirmation" placeholder="Confirm Password" required
                class="bg-gray-100 border-none p-3 my-2 w-full rounded-sm outline-none focus:ring-2 focus:ring-[#007821] transition-shadow" />

            <input type="text" name="phone" placeholder="Phone Number" value="{{ old('phone') }}"
                class="bg-gray-100 border-none p-3 mt-2 w-full rounded-sm outline-none focus:ring-2 focus:ring-[#007821] transition-shadow @error('phone') ring-2 ring-red-500 @enderror" />
            @error('phone')
                <span class="text-red-500 text-xs text-left w-full pl-1 mb-2">{{ $message }}</span>
            @enderror

            <div class="w-full text-left mt-2 mb-1">
                <p class="text-xs text-gray-500 mb-2 ml-1">Select Role:</p>
                <div class="flex justify-between items-center bg-gray-100 p-3 rounded-sm @error('role') ring-2 ring-red-500 @enderror">
                    <label class="flex items-center cursor-pointer">
                        <input type="radio" name="role" value="customer" class="w-4 h-4 accent-[#007821]" {{ old('role', 'customer') == 'customer' ? 'checked' : '' }}>
                        <span class="ml-2 text-sm text-gray-600">Customer</span>
                    </label>
                    <label class="flex items-center cursor-pointer">
                        <input type="radio" name="role" value="supplier" class="w-4 h-4 accent-[#007821]" {{ old('role') == 'supplier' ? 'checked' : '' }}>
                        <span class="ml-2 text-sm text-gray-600">Supplier</span>
                    </label>
                    <label class="flex items-center cursor-pointer">
                        <input type="radio" name="role" value="rider" class="w-4 h-4 accent-[#007821]" {{ old('role') == 'rider' ? 'checked' : '' }}>
                        <span class="ml-2 text-sm text-gray-600">Rider</span>
                    </label>
                </div>
            </div>

            <button type="submit"
                class="w-full rounded-full border border-[#007821] bg-[#007821] text-white text-xs font-bold py-3 mt-4 uppercase tracking-widest transition-transform transform active:scale-95 hover:bg-opacity-90 shadow-lg">
                Sign Up
            </button>

            <p class="mt-6 text-sm text-gray-500">
                Already have an account? 
                <a href="{{ route('login') }}" class="text-[#007821] font-bold hover:underline">Sign In</a>
            </p>
        </form>
    </div>
</div>
@endsection