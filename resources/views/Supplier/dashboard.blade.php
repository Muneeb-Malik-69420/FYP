<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-50">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecobite - Supplier Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="h-full">

    <div class="min-h-full flex">
        <div class="hidden md:flex md:w-64 md:flex-col md:fixed md:inset-y-0 bg-[#007821]">
            <div class="flex flex-col flex-grow pt-5 pb-4 overflow-y-auto">
                <div class="flex items-center flex-shrink-0 px-4 mb-8">
                    <i class="fas fa-leaf text-white text-2xl mr-2"></i>
                    <span class="text-white font-bold text-xl tracking-wider">ECOBITE</span>
                </div>
                <nav class="flex-1 px-2 space-y-1">
                    <a href="#"
                        class="bg-black/10 text-white group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <i class="fas fa-home mr-3 text-white/80"></i> Supplier Dashboard
                    </a>
                    <a href="#"
                        class="text-white/70 hover:bg-white/10 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <i class="fas fa-utensils mr-3"></i> My Food Items
                    </a>
                    <a href="#"
                        class="text-white/70 hover:bg-white/10 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <i class="fas fa-user-shield mr-3"></i> Security
                    </a>
                </nav>
            </div>
            <div class="flex-shrink-0 flex bg-black/10 p-4">
                <button onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    class="flex items-center text-white/70 hover:text-white text-sm font-medium">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </button>
            </div>
        </div>

        <div class="md:pl-64 flex flex-col flex-1">
            <main class="flex-1 pb-8">
                <div
                    class="py-6 px-4 sm:px-6 lg:px-8 bg-white border-b border-gray-200 flex justify-between items-center">
                    <h1 class="text-2xl font-bold text-gray-900">Account Security</h1>
                    <span class="text-sm text-gray-500">Welcome, {{ auth()->user()->username }}</span>
                </div>

                <div class="max-w-4xl mx-auto mt-8 px-4 sm:px-6 lg:px-8 space-y-8">

                    <div class="bg-white shadow sm:rounded-lg overflow-hidden border border-gray-100">
                        <div class="px-4 py-5 sm:p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">Two-Factor Authentication
                                    </h3>
                                    <p class="mt-1 text-sm text-gray-500">Add an extra layer of security to your account
                                        using an authenticator app.</p>
                                </div>
                                @if (auth()->user()->two_factor_confirmed_at)
                                    <span
                                        class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                        Active
                                    </span>
                                @endif
                            </div>

                            <div class="mt-6">
                                @if (!auth()->user()->two_factor_secret)
                                    <form method="POST" action="{{ url('user/two-factor-authentication') }}">
                                        @csrf
                                        <button type="submit"
                                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-bold rounded-md shadow-sm text-white bg-[#007821] hover:bg-[#00631b] focus:outline-none transition">
                                            Enable 2FA
                                        </button>
                                    </form>
                                @else
                                    <div class="flex items-center gap-4">
                                        <form method="POST" action="{{ url('user/two-factor-authentication') }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center px-4 py-2 border border-red-300 text-sm font-bold rounded-md text-red-700 bg-white hover:bg-red-50 focus:outline-none transition">
                                                Disable 2FA
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    @if (auth()->user()->two_factor_secret && !auth()->user()->two_factor_confirmed_at)
                        <div class="bg-white shadow sm:rounded-lg border-2 border-dashed border-[#007821]/30">
                            <div class="px-4 py-5 sm:p-6 text-center">
                                <h3 class="text-md font-bold text-[#007821] uppercase tracking-wider">Finalize Setup
                                </h3>
                                <div class="mt-4 inline-block p-4 bg-gray-50 rounded-xl">
                                    {!! auth()->user()->twoFactorQrCodeSvg() !!}
                                </div>

                                <form method="POST" action="{{ route('two-factor.confirm') }}"
                                    class="mt-6 max-w-xs mx-auto">
                                    @csrf
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Authenticator
                                        Code</label>
                                    <input type="text" name="code" placeholder="000 000" required
                                        class="block w-full text-center text-xl tracking-widest border-gray-300 rounded-md shadow-sm focus:ring-[#007821] focus:border-[#007821]">
                                    <button type="submit"
                                        class="mt-4 w-full bg-[#007821] text-white py-2 rounded-md font-bold hover:bg-[#00631b] transition">
                                        Confirm Activation
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endif

                    @if (session('status') == 'two-factor-authentication-confirmed' || auth()->user()->two_factor_confirmed_at)
                        <div class="bg-white shadow sm:rounded-lg" x-data="{ show: false }">
                            <div class="px-4 py-5 sm:p-6">
                                <h3 class="text-lg font-medium text-gray-900">Recovery Codes</h3>
                                <div class="mt-2 text-sm text-gray-500">
                                    <p>Store these codes in a safe place. If you lose your phone, they are the only way
                                        back in.</p>
                                </div>

                                <div class="mt-5">
                                    <button @click="show = !show"
                                        class="text-sm font-bold text-[#007821] hover:text-[#00631b]">
                                        <span x-show="!show">View Recovery Codes</span>
                                        <span x-show="show">Hide Recovery Codes</span>
                                    </button>

                                    <div x-show="show" x-transition
                                        class="mt-4 grid grid-cols-2 gap-4 p-4 bg-gray-50 rounded-md font-mono text-sm">
                                        @foreach (auth()->user()->recoveryCodes() as $code)
                                            <div class="text-gray-600 bg-white p-2 rounded border border-gray-200">
                                                {{ $code }}</div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            </main>
        </div>
    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
        @csrf
    </form>

</body>

</html>
