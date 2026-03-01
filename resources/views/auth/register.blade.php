@extends('layout.app')

@section('content')

<div class="mt-[64px] h-[calc(100vh-64px)] w-full flex overflow-hidden bg-gray-50">

    {{-- LEFT BOOK PAGE --}}
    <div class="hidden md:flex md:w-1/2 bg-gradient-to-br from-[#0f711c] via-[#0c5f17] to-[#083d10]
                text-white flex-col justify-center items-center px-12 relative">

        <div class="absolute inset-0 opacity-10 pointer-events-none"
             style="background-image: radial-gradient(#fff 1px, transparent 1px); background-size: 28px 28px;">
        </div>

        <div class="relative z-10 text-center max-w-sm">
            <div class="w-14 h-14 bg-white/10 backdrop-blur-md rounded-2xl
                        flex items-center justify-center text-xl mb-4 mx-auto shadow-xl">
                <i class="fas fa-leaf"></i>
            </div>

            <h1 class="text-3xl font-black mb-3 tracking-tight">Join EcoBite</h1>

            <p class="text-green-100 text-xs leading-relaxed mb-6">
                Rescue meals. Reduce waste. Create impact.
            </p>

            <div class="space-y-2">
                <a href="/auth/google" class="w-full bg-white text-gray-800 py-2 rounded-xl flex items-center justify-center gap-2 hover:shadow-lg transition-all">
                    <i class="fab fa-google text-red-500 text-xs"></i>
                    <span class="text-[10px] font-bold">Continue with Google</span>
                </a>
                <a href="/auth/facebook" class="w-full bg-white text-gray-800 py-2 rounded-xl flex items-center justify-center gap-2 hover:shadow-lg transition-all">
                    <i class="fab fa-facebook text-blue-600 text-xs"></i>
                    <span class="text-[10px] font-bold">Continue with Facebook</span>
                </a>
            </div>

            <p class="mt-6 text-[10px] opacity-70">
                Already registered? <a href="{{ route('login') }}" class="underline font-bold">Sign In</a>
            </p>
        </div>
    </div>

    {{-- RIGHT BOOK PAGE --}}
    <div class="w-full md:w-1/2 bg-white flex items-center justify-center px-8">

        <form action="{{ route('register') }}" method="POST" class="w-full max-w-md space-y-4">
            @csrf

            <h2 class="text-xl font-black text-gray-900 mb-2">Create Account</h2>

            <div class="grid grid-cols-2 gap-3">
                {{-- Username --}}
                <div class="col-span-2">
                    <label for="name" class="sr-only">Username</label>
                    <input type="text" id="name" name="name" placeholder="Username" value="{{ old('name') }}" required
                           oninput="this.value=this.value.replace(/[^a-zA-Z0-9_-]/g,'')"
                           class="w-full py-2 px-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#0f711c] focus:ring-2 focus:ring-[#0f711c]/10 outline-none text-sm {{ $errors->has('name') ? 'border-red-500 bg-red-50' : '' }}">
                    @error('name') <p class="text-red-500 text-[10px] mt-1 font-semibold">{{ $message }}</p> @enderror
                </div>

                {{-- Email --}}
                <div class="col-span-2">
                    <label for="email" class="sr-only">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="Email Address" value="{{ old('email') }}" required
                           class="w-full py-2 px-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#0f711c] focus:ring-2 focus:ring-[#0f711c]/10 outline-none text-sm {{ $errors->has('email') ? 'border-red-500 bg-red-50' : '' }}">
                    @error('email') <p class="text-red-500 text-[10px] mt-1 font-semibold">{{ $message }}</p> @enderror
                </div>

                {{-- Password --}}
                <div class="relative group">
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" id="password" name="password" placeholder="Password" required
                           oninput="checkPasswordStrength(this.value)"
                           class="w-full py-2 px-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#0f711c] focus:ring-2 focus:ring-[#0f711c]/10 outline-none text-sm {{ $errors->has('password') ? 'border-red-500 bg-red-50' : '' }}">
                    <button type="button" onclick="togglePassword('password', this)" class="absolute right-3 top-2.5 text-gray-400 hover:text-[#0f711c]">
                        <i class="fas fa-eye text-xs"></i>
                    </button>
                </div>

                {{-- Confirm Password --}}
                <div class="relative group">
                    <label for="password_confirmation" class="sr-only">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" required
                           class="w-full py-2 px-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#0f711c] focus:ring-2 focus:ring-[#0f711c]/10 outline-none text-sm">
                    <button type="button" onclick="togglePassword('password_confirmation', this)" class="absolute right-3 top-2.5 text-gray-400 hover:text-[#0f711c]">
                        <i class="fas fa-eye text-xs"></i>
                    </button>
                </div>

                {{-- FULL WIDTH PASSWORD METER --}}
                <div class="col-span-2 -mt-1">
                    <div class="flex gap-1 px-1">
                        <div id="strength-1" class="h-1 flex-1 rounded-full bg-gray-200 transition-all duration-300"></div>
                        <div id="strength-2" class="h-1 flex-1 rounded-full bg-gray-200 transition-all duration-300"></div>
                        <div id="strength-3" class="h-1 flex-1 rounded-full bg-gray-200 transition-all duration-300"></div>
                        <div id="strength-4" class="h-1 flex-1 rounded-full bg-gray-200 transition-all duration-300"></div>
                    </div>
                    <div class="flex justify-between items-center mt-1 px-1">
                        <p id="strength-text" class="text-[9px] font-bold text-gray-400 uppercase tracking-widest">Too Short</p>
                    </div>
                </div>

                {{-- Phone --}}
                <div class="col-span-2">
                    <label for="phone" class="sr-only">Phone Number</label>
                    <input type="tel" id="phone" name="phone" placeholder="03XXXXXXXXX" value="{{ old('phone') }}"
                           oninput="if(this.value.length>11)this.value=this.value.slice(0,11)"
                           class="w-full py-2 px-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#0f711c] focus:ring-2 focus:ring-[#0f711c]/10 outline-none text-sm {{ $errors->has('phone') ? 'border-red-500 bg-red-50' : '' }}">
                    @error('phone') <p class="text-red-500 text-[10px] mt-1 font-semibold">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- Role Selector --}}
            <div class="bg-gray-50 border border-gray-200 rounded-lg p-2.5">
                <p class="text-[10px] text-gray-500 mb-1.5 font-bold uppercase tracking-wider">Select Role</p>
                <div class="flex justify-between text-xs">
                    @foreach(['customer','supplier','rider'] as $role)
                        <label class="flex items-center gap-2 cursor-pointer hover:text-[#0f711c] transition-colors">
                            <input type="radio" name="role" value="{{ $role }}" class="accent-[#0f711c] w-3 h-3" {{ old('role','customer')==$role?'checked':'' }}>
                            {{ ucfirst($role) }}
                        </label>
                    @endforeach
                </div>
            </div>

            <button type="submit" class="w-full bg-gradient-to-r from-[#0f711c] to-[#52c234] text-white py-2.5 rounded-xl font-bold hover:shadow-lg transition-all active:scale-[0.98] uppercase text-[11px] tracking-widest shadow-md">
                Sign Up
            </button>
        </form>
    </div>
</div>

{{-- Keep the script from previous response --}}
<script>
    function togglePassword(inputId, btn) {
        const input = document.getElementById(inputId);
        const icon = btn.querySelector('i');
        input.type = input.type === 'password' ? 'text' : 'password';
        icon.classList.toggle('fa-eye');
        icon.classList.toggle('fa-eye-slash');
    }

    function checkPasswordStrength(password) {
        let strength = 0;
        const text = document.getElementById('strength-text');
        const bars = [1, 2, 3, 4].map(i => document.getElementById(`strength-${i}`));

        if (password.length >= 6) strength++;
        if (password.length >= 10) strength++;
        if (/[A-Z]/.test(password) && /[0-9]/.test(password)) strength++;
        if (/[^A-Za-z0-9]/.test(password)) strength++;

        bars.forEach(bar => {
            bar.className = 'h-1 flex-1 rounded-full bg-gray-200 transition-all duration-300';
        });

        const configs = [
            { label: 'Weak', color: 'bg-red-500', text: 'text-red-500' },
            { label: 'Fair', color: 'bg-orange-400', text: 'text-orange-400' },
            { label: 'Good', color: 'bg-yellow-400', text: 'text-yellow-400' },
            { label: 'Strong', color: 'bg-[#0f711c]', text: 'text-[#0f711c]' }
        ];

        if (password.length > 0) {
            const config = configs[strength - 1] || configs[0];
            for (let i = 0; i < strength; i++) {
                bars[i].classList.replace('bg-gray-200', config.color);
            }
            text.innerText = config.label;
            text.className = `text-[9px] font-bold uppercase tracking-widest ${config.text}`;
        } else {
            text.innerText = 'Too Short';
            text.className = 'text-[9px] font-bold text-gray-400 uppercase tracking-widest';
        }
    }
</script>

@endsection