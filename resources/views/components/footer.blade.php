<footer class="bg-gradient-to-r from-blue-900 to-blue-700 text-white mt-auto">

    <div class="max-w-7xl mx-auto px-6 py-12">

        <div class="grid grid-cols-1 md:grid-cols-4 gap-10">

            {{-- LOGO / ABOUT --}}
            <div>

                <img
                    src="{{ Vite::asset('resources/images/bhh.png') }}"
                    alt="Logo"
                    class="h-12 mb-4"
                >

                <p class="text-sm text-blue-100 leading-relaxed">
                    Der offizielle Shop der Beruflichen Hochschule Hamburg.
                </p>

            </div>

            {{-- SHOP --}}
            <div>

                <h3 class="font-bold text-lg mb-4">
                    BHH
                </h3>

                <div class="space-y-2 text-blue-100">

                    <a href="/" class="block hover:text-white">
                        Webshop-Startseite
                    </a>

                    <a href="https://bhh.de/" class="block hover:text-white">
                        Offizielle BHH-Webseite
                    </a>

                    <a href="/manage" class="block hover:text-white">
                        Verwaltungsübersicht
                    </a>

                </div>

            </div>

            {{-- SUPPORT --}}
            <div>

                <h3 class="font-bold text-lg mb-4">
                    Support
                </h3>

                <div class="space-y-2 text-blue-100">

                    <a href="#" class="block hover:text-white">
                        Kontakt
                    </a>

                    <a href="#" class="block hover:text-white">
                        Versand
                    </a>

                    <a href="#" class="block hover:text-white">
                        Rückgabe
                    </a>

                </div>

            </div>

            {{-- LEGAL --}}
            <div>

                <h3 class="font-bold text-lg mb-4">
                    Rechtliches
                </h3>

                <div class="space-y-2 text-blue-100">

                    <a href="#" class="block hover:text-white">
                        Impressum
                    </a>

                    <a href="#" class="block hover:text-white">
                        Datenschutz
                    </a>

                    <a href="#" class="block hover:text-white">
                        AGB
                    </a>

                </div>

            </div>

        </div>

        {{-- BOTTOM --}}
        <div class="border-t border-blue-500 mt-10 pt-6 text-sm text-blue-200 text-center">

            © {{ date('Y') }} Berufliche Hochschule Hamburg — Alle Rechte vorbehalten

        </div>

    </div>

</footer>