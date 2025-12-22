@extends('layout.app')

@section('content')
<div class="bg-[#007821] h-16 w-full"></div>

<div class="min-h-[calc(100vh-64px)] w-full bg-white flex items-center justify-center p-4">
    <div class="w-full max-w-md bg-white p-8 shadow-2xl rounded-xl">
        <form action="{{ route('password.update') }}" method="POST" class="flex flex-col items-center text-center">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">
            {{-- <input type="hidden" name="token" value="{{ $request->route('token') }}"> --}}
            
            <div class="w-16 h-16 bg-[#007821] rounded-full flex items-center justify-center text-white text-2xl mb-5 shadow-md">
                <i class="fas fa-lock"></i>
            </div>
            
            <h1 class="font-bold text-3xl mb-6 text-gray-800">Reset Password</h1>

            <input type="email" name="email" placeholder="Email" required value="{{ old('email', $request->email) }}"
                class="bg-gray-100 border-none p-3 w-full rounded-sm outline-none focus:ring-2 focus:ring-[#007821] transition-shadow @error('email') ring-2 ring-red-500 @enderror" />
            @error('email')
                <span class="text-red-500 text-xs text-left w-full pl-1 mt-1 mb-2">{{ $message }}</span>
            @enderror

            <input type="password" name="password" placeholder="New Password" required
                class="bg-gray-100 border-none p-3 mt-3 w-full rounded-sm outline-none focus:ring-2 focus:ring-[#007821] transition-shadow @error('password') ring-2 ring-red-500 @enderror" />
            
            <input type="password" name="password_confirmation" placeholder="Confirm New Password" required
                class="bg-gray-100 border-none p-3 mt-3 w-full rounded-sm outline-none focus:ring-2 focus:ring-[#007821] transition-shadow" />
            
            @error('password')
                <span class="text-red-500 text-xs text-left w-full pl-1 mt-1">{{ $message }}</span>
            @enderror

            <button type="submit"
                class="w-full rounded-full border border-[#007821] bg-[#007821] text-white text-xs font-bold py-3 px-12 mt-8 uppercase tracking-widest transition-transform transform active:scale-95 hover:bg-opacity-90 shadow-lg">
                Reset Password
            </button>
        </form>
    </div>
</div>
@endsection