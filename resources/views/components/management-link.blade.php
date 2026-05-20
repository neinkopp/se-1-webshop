@props(['href', 'label', 'image_source', 'deletion_href', 'image_background_color'])

<div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 hover:bg-gray-100">
    <!-- Removed standard href from <a> to prevent conflicts, using JS navigation instead except when clicking the form -->
    <div onclick="window.location='{{ $href }}'" class="flex items-center gap-5 cursor-pointer">
        <div class="w-16 h-16 rounded-xl bg-{{ $image_background_color }} flex justify-center text-white">
            <img src="{{ $image_source }}" alt="Bild von {{ $label }}" class="w-16">
        </div>
        <div class="flex-1">
            <div class="flex justify-between items-center">
                <p class="text-gray-500 text-xl">{{ $label }}</p>
                @if ($deletion_href !== '')
                    <!-- 
                      Using Alpine.js here to handle the state:
                      @click.stop prevents clicking the form from triggering the parent redirect 
                    -->
                    <form 
                        action="{{ $deletion_href }}" 
                        method="POST"
                        x-data="{
                            async deleteItem(e) {
                                if (!confirm('Bist du sicher, dass du die {{ $label }}-Kategorie löschen möchtest? Diese Aktion kann nicht rückgängig gemacht werden.')) return;

                                try {
                                    const response = await fetch(e.target.action, {
                                        method: 'POST',
                                        body: new FormData(e.target),
                                        headers: {
                                            'X-Requested-With': 'XMLHttpRequest'
                                        }
                                    });

                                    if (response.ok) {
                                        // Successfully deleted! Refresh page or remove element from DOM
                                        window.location.reload();
                                    } else {
                                        const errorData = await response.json();
                                        alert(errorData.message || 'Ein unerwarteter Fehler ist aufgetreten. Versuche es bitte erneut.');
                                    }
                                } catch (error) {
                                    alert('Ein unerwarteter Fehler ist aufgetreten. Versuche es bitte erneut.');
                                }
                            }
                        }"
                        @submit.prevent="deleteItem($event)"
                        @click.stop
                    >
                        @csrf
                        @method('POST') <!-- Best practice for destruction actions in Laravel -->
                        
                        <button type="submit" class="p-1 rounded-xl hover:bg-gray-200">
                            <img src="{{ Vite::asset("resources/images/trashcan.svg") }}" alt="Produkt löschen" class="w-8">
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>