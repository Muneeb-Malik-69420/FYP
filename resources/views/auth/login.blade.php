@extends('layout.app')

@section('content')

{{-- Updated wrapper: Removed 'fixed' and hardcoded margins for seamless sticky nav alignment --}}
<div class="flex-1 min-h-[calc(100vh-64px)] w-full flex bg-white overflow-hidden">
    
    {{-- LEFT PANEL --}}
    <div class="hidden md:flex md:w-1/2 flex-col justify-center items-center bg-gradient-to-br from-[#0f711c] via-[#0c5f17] to-[#083d10] p-12 text-white relative">
        
        {{-- Pattern Overlay --}}
        <div class="absolute inset-0 opacity-10 pointer-events-none" 
             style="background-image: radial-gradient(#fff 1px, transparent 1px); background-size: 28px 28px;">
        </div>

        <div class="relative z-10 text-center max-w-sm">
            
            {{-- Floating Icon --}}
            <div class="w-16 h-16 bg-white/10 backdrop-blur-md rounded-2xl flex items-center justify-center text-2xl mb-6 mx-auto border border-white/20 shadow-xl animate-[float_4s_ease-in-out_infinite]">
                <i class="fas fa-leaf"></i>
            </div>

            <h2 class="text-4xl font-black mb-4 tracking-tight">
                Welcome Back!
            </h2>

            <p class="text-green-100 text-base font-light leading-relaxed mb-8">
                Every meal you rescue saves the planet. Log in and continue your impact.
            </p>
            
            <div class="pt-8 border-t border-white/10 w-full">
                <p class="text-[10px] uppercase tracking-[0.4em] opacity-60 mb-5">
                    First time here?
                </p>
                <a href="{{ route('register') }}" 
                   class="inline-block px-10 py-3 border-2 border-white rounded-full text-xs font-black hover:bg-white hover:text-[#0f711c] transition-all duration-300 transform hover:scale-105">
                    Create an Account
                </a>
            </div>
        </div>
    </div>

    {{-- RIGHT PANEL --}}
    <div class="w-full md:w-1/2 flex flex-col justify-center items-center px-6 md:px-16 bg-white">
        <div class="w-full max-w-[380px]">

            {{-- Title --}}
            <div class="mb-8">
                <h1 class="text-3xl font-black text-gray-900 tracking-tight">
                    Sign In
                </h1>
                <div class="h-1 w-10 bg-gradient-to-r from-[#0f711c] to-[#52c234] mt-2 rounded-full"></div>
            </div>

            {{-- Social Buttons --}}
            <div class="flex gap-3 mb-6">
                <a href="/auth/google" 
                   class="flex-1 py-2.5 border border-gray-200 rounded-xl flex items-center justify-center gap-2 bg-white hover:shadow-md transition-all duration-300 hover:scale-[1.02]">
                    <img src="https://www.svgrepo.com/show/355037/google.svg" class="w-4 h-4" alt="Google">
                    <span class="text-xs font-bold text-gray-700">Google</span>
                </a>

                <a href="/auth/facebook" 
                   class="flex-1 py-2.5 border border-gray-200 rounded-xl flex items-center justify-center gap-2 bg-white hover:shadow-md transition-all duration-300 hover:scale-[1.02]">
                    <i class="fab fa-facebook text-blue-600 text-lg"></i>
                    <span class="text-xs font-bold text-gray-700">Facebook</span>
                </a>
            </div>

            {{-- Divider --}}
            <div class="relative flex py-2 items-center mb-6">
                <div class="flex-grow border-t border-gray-200"></div>
                <span class="flex-shrink mx-3 text-gray-400 text-[9px] uppercase tracking-[0.4em] font-black">OR</span>
                <div class="flex-grow border-t border-gray-200"></div>
            </div>

            {{-- Form --}}
            <form action="{{ route('login') }}" method="POST" class="space-y-4">
                @csrf
                
                {{-- Email --}}
                <div class="group">
                    <label for="login_email" class="sr-only">Email Address</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400 group-focus-within:text-[#0f711c] transition-colors">
                            <i class="fas fa-envelope text-sm"></i>
                        </span>

                        <input type="email" id="login_email" name="email" placeholder="Email Address" required value="{{ old('email') }}"
                            class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl outline-none transition-all duration-300 text-sm
                            focus:bg-white focus:border-[#0f711c] focus:ring-4 focus:ring-[#0f711c]/10
                            {{ $errors->has('email') ? 'border-red-500 bg-red-50' : '' }}" />
                    </div>
                </div>

                {{-- Password --}}
                <div class="group">
                    <label for="login_password" class="sr-only">Password</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400 group-focus-within:text-[#0f711c] transition-colors">
                            <i class="fas fa-lock text-sm"></i>
                        </span>

                        <input type="password" id="login_password" name="password" placeholder="Password" required
                            class="w-full pl-11 pr-12 py-3 bg-gray-50 border border-gray-200 rounded-xl outline-none transition-all duration-300 text-sm
                            focus:bg-white focus:border-[#0f711c] focus:ring-4 focus:ring-[#0f711c]/10
                            {{ $errors->has('password') ? 'border-red-500 bg-red-50' : '' }}" />

                        {{-- Toggle Button --}}
                        <button type="button" onclick="toggleVisibility('login_password', this)" 
                                class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 hover:text-[#0f711c] transition-colors">
                            <i class="fas fa-eye text-sm" id="eye_icon"></i>
                        </button>
                    </div>
                </div>

                {{-- Remember + Forgot --}}
                <div class="flex items-center justify-between px-1">
                    <label class="flex items-center text-xs text-gray-500 cursor-pointer group">
                        <input type="checkbox" name="remember"
                            class="w-3.5 h-3.5 rounded border-gray-300 text-[#0f711c] focus:ring-[#0f711c]/30">
                        <span class="ml-2 group-hover:text-gray-700 transition-colors">Stay logged in</span>
                    </label>

                    <a href="{{ route('password.request') }}"
                       class="text-[#0f711c] text-xs font-bold hover:underline hover:text-[#083d10] transition">
                        Forgot?
                    </a>
                </div>

                {{-- Submit --}}
                <button type="submit"
                    class="w-full bg-gradient-to-r from-[#0f711c] to-[#52c234] text-white font-bold py-3.5 rounded-xl 
                    shadow-lg shadow-green-900/10 hover:shadow-green-900/20 
                    transition-all duration-300 transform hover:-translate-y-0.5 active:scale-[0.97] 
                    uppercase tracking-widest text-xs">
                    LOGIN
                </button>
            </form>

        </div>
    </div>
</div>

<style>
@keyframes float {
    0%,100% { transform: translateY(0px); }
    50% { transform: translateY(-6px); }
}
</style>

<script>
    function toggleVisibility(id, btn) {
        const input = document.getElementById(id);
        const icon = btn.querySelector('i');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    }
</script>

@endsection