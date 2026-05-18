<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('partials.head')

    <body class="bg-gray-50 text-gray-800 min-h-screen flex flex-col overflow-x-hidden">
        <div x-data="{mobileMenuOpen: false}" class="flex flex-col min-h-screen">

            {{-- Header --}}
            <x-header>
                <x-slot:actionsSlot>
                    <x-header-actions />
                </x-slot:actionsSlot>

                <x-slot:behaviorSlot>
                    <x-header-actions-mobile />
                </x-slot:behaviorSlot>
            </x-header>

            {{-- Main Content --}}
            <div class="flex pt-24 flex-1 items-center justify-center px-5 lg:px-10 pb-20">

                <main class="w-full max-w-md">

                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">

                        {{-- Title --}}
                        <div class="text-center mb-8">
                            <h1 class="text-3xl font-bold text-gray-900">
                                Verwaltungsansicht
                            </h1>

                            <p class="text-gray-500 mt-2">
                                Logge dich über deinen GitLab-Account ein.
                            </p>
                        </div>

                        {{-- Session Status --}}
                        @if (session('status'))
                            <div class="mb-6 rounded-lg bg-green-100 border border-green-200 text-green-700 px-4 py-3 text-sm">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{-- Login Form --}}
                        <form method="POST" action="/manage/performLogin" class="space-y-6">
                            @csrf

                            {{-- Email --}}
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                    GitLab E-Mail
                                </label>

                                <input
                                    id="email"
                                    type="email"
                                    name="email"
                                    value="Gitlab E-Mail"
                                    required
                                    autofocus
                                    autocomplete="email"
                                    class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition"
                                />

                                @error('email')
                                    <p class="mt-2 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            {{-- Password --}}
                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <label for="password" class="block text-sm font-medium text-gray-700">Passwort</label>
                                </div>
                                <input
                                    id="password"
                                    type="password"
                                    name="password"
                                    required
                                    autocomplete="current-password"
                                    class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition"
                                    placeholder="••••••••"
                                />

                                @error('password')
                                    <p class="mt-2 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            {{-- Remember Me --}}
                            <div class="flex items-center justify-between">
                                <label class="flex items-center gap-3 cursor-pointer">
                                    <input type="checkbox" name="remember" class="rounded border-gray-300 text-gray-900 focus:ring-gray-900">
                                    <span class="text-sm text-gray-600">
                                        Login speichern
                                    </span>
                                </label>
                            </div>

                            {{-- Submit Button --}}
                            <button
                                type="submit"
                                class="w-full bg-gray-900 hover:bg-black text-white font-semibold py-3 rounded-xl transition duration-200 shadow-sm"
                            >
                                Einloggen
                            </button>
                        </form>
                    </div>
                </main>
            </div>

            {{-- Footer --}}
            <x-footer />
        </div>
    </body>
</html>