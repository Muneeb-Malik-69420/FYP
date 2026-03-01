@extends('layout.app')

@section('content')

{{-- Updated wrapper: Removed mt-[64px] and used flex-1 for natural alignment --}}
<div class="flex-1 min-h-[calc(100vh-64px)] w-full flex bg-gray-50 overflow-hidden">

    {{-- LEFT SIDE --}}
    <div class="hidden md:flex md:w-1/2 bg-gradient-to-br from-[#0f711c] via-[#0c5f17] to-[#083d10]
                text-white flex-col justify-center items-center px-10 relative">

        <div class="absolute inset-0 opacity-10 pointer-events-none"
             style="background-image: radial-gradient(#fff 1px, transparent 1px); background-size: 28px 28px;">
        </div>

        <div class="relative z-10 text-center max-w-sm">
            <div class="w-12 h-12 bg-white/10 backdrop-blur-md rounded-2xl
                        flex items-center justify-center text-lg mb-3 mx-auto shadow-xl">
                <i class="fas fa-leaf"></i>
            </div>

            <h1 class="text-2xl font-black mb-2">Join EcoBite</h1>

            <p class="text-green-100 text-xs mb-5">
                Rescue meals. Reduce waste. Create impact.
            </p>

            <div class="space-y-2">
                <a href="/auth/google"
                   class="w-full bg-white text-gray-800 py-2 rounded-xl flex items-center justify-center gap-2">
                    <i class="fab fa-google text-red-500 text-xs"></i>
                    <span class="text-[10px] font-bold">Continue with Google</span>
                </a>

                <a href="/auth/facebook"
                   class="w-full bg-white text-gray-800 py-2 rounded-xl flex items-center justify-center gap-2">
                    <i class="fab fa-facebook text-blue-600 text-xs"></i>
                    <span class="text-[10px] font-bold">Continue with Facebook</span>
                </a>
            </div>

            <p class="mt-5 text-[10px] opacity-70">
                Already registered?
                <a href="{{ route('login') }}" class="underline font-bold">Sign In</a>
            </p>
        </div>
    </div>

    {{-- RIGHT SIDE --}}
    <div class="w-full md:w-1/2 bg-white flex items-center justify-center px-8">

        <form action="{{ route('register') }}" method="POST"
              class="w-full max-w-md space-y-4">
            @csrf

            <h2 class="text-lg font-black text-gray-900">Create Account</h2>

            <div class="grid grid-cols-2 gap-3">

                <div class="col-span-2">
                    <input type="text" name="name" placeholder="Username"
                           value="{{ old('name') }}" required
                           class="w-full py-2.5 px-4 rounded-xl bg-gray-50 border border-gray-200 text-sm focus:outline-none focus:border-[#0f711c]">
                </div>

                <div class="col-span-2">
                    <input type="email" name="email" placeholder="Email Address"
                           value="{{ old('email') }}" required
                           class="w-full py-2.5 px-4 rounded-xl bg-gray-50 border border-gray-200 text-sm focus:outline-none focus:border-[#0f711c]">
                </div>

                <div class="relative">
                    <input type="password" id="password" name="password"
                           placeholder="Password" required
                           oninput="checkPasswordStrength(this.value)"
                           class="w-full py-2.5 px-4 rounded-xl bg-gray-50 border border-gray-200 text-sm focus:outline-none focus:border-[#0f711c]">
                </div>

                <div class="relative">
                    <input type="password" name="password_confirmation"
                           placeholder="Confirm Password" required
                           class="w-full py-2.5 px-4 rounded-xl bg-gray-50 border border-gray-200 text-sm focus:outline-none focus:border-[#0f711c]">
                </div>

                {{-- Password Rules --}}
                <div class="col-span-2">
                    <p class="text-[9px] text-gray-500 flex flex-wrap gap-x-3">
                        <span>• 8+ characters</span>
                        <span>• 1 uppercase</span>
                        <span>• 1 number</span>
                        <span>• 1 symbol</span>
                    </p>
                </div>

                {{-- Strength Meter --}}
                <div class="col-span-2">
                    <div class="flex gap-1">
                        <div id="strength-1" class="h-[3px] flex-1 rounded-full bg-gray-200"></div>
                        <div id="strength-2" class="h-[3px] flex-1 rounded-full bg-gray-200"></div>
                        <div id="strength-3" class="h-[3px] flex-1 rounded-full bg-gray-200"></div>
                        <div id="strength-4" class="h-[3px] flex-1 rounded-full bg-gray-200"></div>
                    </div>
                </div>

                <div class="col-span-2">
                    <input type="tel" name="phone" placeholder="03XXXXXXXXX"
                           class="w-full py-2.5 px-4 rounded-xl bg-gray-50 border border-gray-200 text-sm focus:outline-none focus:border-[#0f711c]">
                </div>
            </div>

            {{-- Role --}}
            <div class="bg-gray-50 border border-gray-200 rounded-xl p-3">
                <div class="flex justify-between text-xs">
                    @foreach(['customer','supplier','rider'] as $role)
                        <label class="flex items-center gap-1 cursor-pointer">
                            <input type="radio" name="role"
                                   value="{{ $role }}"
                                   class="accent-[#0f711c]"
                                   {{ old('role','customer')==$role?'checked':'' }}>
                            {{ ucfirst($role) }}
                        </label>
                    @endforeach
                </div>
            </div>

            <button type="submit"
                    class="w-full bg-gradient-to-r from-[#0f711c] to-[#52c234]
                           text-white py-2.5 rounded-xl font-bold text-sm transform transition hover:scale-[1.02] active:scale-[0.98]">
                Sign Up
            </button>

        </form>
    </div>
</div>

<script>
function checkPasswordStrength(password) {
    let strength = 0;
    if (password.length >= 8) strength++;
    if (/[A-Z]/.test(password)) strength++;
    if (/[0-9]/.test(password)) strength++;
    if (/[^A-Za-z0-9]/.test(password)) strength++;

    const bars = [1,2,3,4].map(i => document.getElementById(`strength-${i}`));
    bars.forEach(bar => bar.className = "h-[3px] flex-1 rounded-full bg-gray-200 transition-colors duration-300");

    const colors = ['bg-red-500','bg-orange-400','bg-yellow-400','bg-[#0f711c]'];
    for (let i = 0; i < strength; i++) {
        bars[i].classList.remove('bg-gray-200');
        bars[i].classList.add(colors[strength-1] || colors[0]);
    }
}
</script>

@endsection