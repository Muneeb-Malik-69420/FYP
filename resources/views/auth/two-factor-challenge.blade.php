@extends('layout.app')

@section('content')
<div class="bg-[#007821] h-16 w-full"></div>

<div class="min-h-[calc(100vh-64px)] w-full bg-white flex items-center justify-center p-4">
    <div class="w-full max-w-md bg-white p-8 shadow-2xl rounded-xl">
        <div x-data="{ recovery: false }">
            <form action="{{ route('two-factor.login') }}" method="POST" class="flex flex-col items-center text-center">
                @csrf
                
                <div class="w-16 h-16 bg-[#007821] rounded-full flex items-center justify-center text-white text-2xl mb-5 shadow-md">
                    <i class="fas fa-shield-alt"></i>
                </div>
                
                <h1 class="font-bold text-2xl mb-4 text-gray-800">Two-Factor Verification</h1>
                
                <p class="text-sm text-gray-500 mb-6 leading-relaxed" x-show="!recovery">
                    Please confirm access to your account by entering the authentication code provided by your authenticator application.
                </p>

                <p class="text-sm text-gray-500 mb-6 leading-relaxed" x-show="recovery" style="display: none;">
                    Please confirm access to your account by entering one of your emergency recovery codes.
                </p>

                {{-- Code Input --}}
                <div x-show="!recovery">
                    <input type="text" name="code" placeholder="000000" autofocus
                        class="bg-gray-100 border-none p-4 w-full rounded-sm outline-none focus:ring-2 focus:ring-[#007821] text-center text-xl tracking-[0.5em] font-bold" />
                </div>

                {{-- Recovery Code Input --}}
                <div x-show="recovery" style="display: none;">
                    <input type="text" name="recovery_code" placeholder="Recovery Code"
                        class="bg-gray-100 border-none p-4 w-full rounded-sm outline-none focus:ring-2 focus:ring-[#007821] text-center font-mono" />
                </div>

                @error('code')
                    <span class="text-red-500 text-xs mt-2">{{ $message }}</span>
                @enderror

                <button type="submit"
                    class="w-full rounded-full border border-[#007821] bg-[#007821] text-white text-xs font-bold py-3 px-12 mt-8 uppercase tracking-widest transition-transform transform active:scale-95 hover:bg-opacity-90 shadow-lg">
                    Verify Code
                </button>

                <button type="button" class="mt-4 text-xs text-gray-500 hover:text-[#007821] underline"
                        x-show="!recovery" x-on:click="recovery = true">
                    Use a recovery code
                </button>

                <button type="button" class="mt-4 text-xs text-gray-500 hover:text-[#007821] underline"
                        x-show="recovery" x-on:click="recovery = false" style="display: none;">
                    Use an authentication code
                </button>
            </form>
        </div>
    </div>
</div>
@endsection