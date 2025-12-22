@extends('layout.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 p-4">
    <div class="max-w-md w-full bg-white shadow-2xl rounded-2xl p-10 text-center">
        <h1 class="text-2xl font-bold text-gray-800 mb-2">Confirm Password</h1>
        <p class="text-sm text-gray-500 mb-8">For your security, please confirm your password to continue.</p>

        <form method="POST" action="{{ url('/user/confirm-password') }}">
            @csrf
            <input type="password" name="password" required autocomplete="current-password" autofocus
                placeholder="Enter your password"
                class="bg-gray-100 border-none p-4 w-full rounded-lg outline-none focus:ring-2 focus:ring-[#007821] transition-shadow" />
            
            <button type="submit" class="w-full bg-[#007821] text-white font-bold py-3 rounded-full mt-6 uppercase tracking-widest hover:bg-opacity-90 transition shadow-lg">
                Confirm
            </button>
        </form>
    </div>
</div>
@endsection