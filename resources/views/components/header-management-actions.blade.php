<div class="flex items-center gap-10 text-white">
    <form action="/logout" method="post">
        <button type="submit" href="/logout" class="flex flex-col items-center group">
            <img src="{{ Vite::asset("resources/images/userIcon.svg") }}" alt="Abmelden" class="w-10">
            <span class="text-sm mt-1 group-hover:text-blue-100">Abmelden</span>
        </button>
    </form>
</div>