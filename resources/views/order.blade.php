<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('partials.head')
<body class="bg-gray-50 text-gray-800 min-h-screen flex flex-col overflow-x-hidden">

	<div
		x-data="{
        mobileMenuOpen: false,
        sidebarOpen: false
    }"
		class="flex flex-col flex-1">

		{{-- HEADER --}}
		<x-header>
			<x-slot:actionsSlot>
				<x-header-actions />
			</x-slot:actionsSlot>
			<x-slot:behaviorSlot>
				<x-header-actions-mobile />
			</x-slot:behaviorSlot>
		</x-header>

		<div class="flex pt-24 flex-1">

			{{-- MAIN CONTENT --}}
			<main class="w-full max-w-7xl mx-auto px-5 lg:px-10 pb-20">

				{{-- TITLE & TOKEN --}}
				<section class="py-6 space-y-4">
					<h1 class="text-3xl font-bold text-blue-900">
						Bestellung
					</h1>

					{{-- TOKEN FIELD --}}
					<div x-data="{ token: '{{ $invoice->token }}' }" class="flex items-center border border-gray-300 rounded bg-white w-full max-w-xs px-3 py-2">
						<span class="text-gray-600 mr-2 text-sm">Token:</span>
						<input type="text" :value="token" readonly class="outline-none bg-transparent w-full text-gray-800 text-sm">
						<button @click="navigator.clipboard.writeText(token)" class="text-gray-500 hover:text-blue-900 transition" aria-label="Token kopieren">
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
								<path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 0 1 1.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 0 0-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 0 1-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H9.75" />
							</svg>
						</button>
					</div>
				</section>

				{{-- CHECKOUT LAYOUT --}}
				<section class="flex flex-col lg:flex-row gap-8 items-start">

					{{-- LEFT COLUMN: ITEMS BY SUPPLIER --}}
					<div class="flex-1 w-full space-y-6">

						@forelse ($cartItemsBySupplier as $supplierName => $items)
						<div class="bg-white border border-gray-200 rounded-md shadow-sm">
							<div class="bg-gray-50 border-b border-gray-200 px-5 py-3 flex justify-between items-center rounded-t-md">
								<h3 class="font-bold text-blue-900">Anbieter: {{ $supplierName }}</h3>
								<span class="bg-[#e6eff8] text-blue-900 text-xs font-semibold px-2.5 py-1 rounded">{{ $items->count() }} Artikel</span>
							</div>

							<div class="divide-y divide-gray-100">
								@foreach ($items as $item)
								<div class="p-5 flex flex-col sm:flex-row gap-5">
									<div class="w-24 h-24 bg-gray-100 rounded flex-shrink-0 flex items-center justify-center overflow-hidden">
										<img src="{{ $item->product->image ?? 'https://placehold.co/150x150/e2e8f0/475569?text=Bild' }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
									</div>
									<div class="flex-1 flex flex-col justify-between">
										<div>
											<a href="#" class="text-lg font-bold text-blue-900 hover:underline">{{ $item->product->name }}</a>
											@if ($item->selected_options && isset($item->selected_options['properties']))
											@foreach ($item->selected_options['properties'] as $key => $value)
											<div class="mt-2 text-sm text-gray-700 flex items-center gap-2">
												<span>{{ ucfirst($key) }}:</span>
												@if ($key == 'color' || $key == 'Farbe')
												<span class="w-4 h-4 rounded-full shadow-inner border border-gray-300 block" style="background-color: {{ $value }}"></span>
												@endif
												<span>{{ $value }}</span>
											</div>
											@endforeach
											@endif
											<div class="mt-1 text-sm text-gray-700">
												<span>Menge: {{ $item->amount }}</span>
											</div>
										</div>
									</div>
									<div class="flex flex-col items-end justify-between sm:w-24 mt-4 sm:mt-0">
										<span class="text-xl font-bold text-blue-900">{{ number_format($item->price_per_unit * $item->amount, 2) }} $</span>
									</div>
								</div>
								@endforeach
							</div>

							{{-- BUTTON ZUM ANBIETER --}}
							<div class="p-4 border-t border-gray-100 flex justify-end">
								<a href="#" class="inline-flex items-center gap-2 border border-blue-900 text-blue-900 px-5 py-2 rounded hover:bg-gray-50 transition font-medium text-sm">
									Zum Anbieter
									<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
										<path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
									</svg>
								</a>
							</div>
						</div>
						@empty
						<p>Ihre Bestellung ist leer.</p>
						@endforelse

						{{-- BACK BUTTON --}}
						<div class="pt-4">
							<a href="{{ url('/') }}" class="inline-flex items-center gap-2 border border-blue-900 text-blue-900 px-5 py-2.5 rounded hover:bg-gray-100 transition font-medium">
								<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
									<path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
								</svg>
								Weiter einkaufen
							</a>
						</div>
					</div>

					{{-- RIGHT COLUMN: BILLING ADDRESS & INFO --}}
					@if($cartItemsBySupplier->count() > 0)
					<div class="w-full lg:w-[360px] shrink-0 space-y-6">

						{{-- RECHNUNGSADRESSE --}}
						<div class="bg-white border border-gray-200 rounded-md shadow-sm p-6">
							<h2 class="text-lg font-bold text-blue-900 mb-6 flex items-center gap-2">
								<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
									<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
								</svg>
								Rechnungsadresse
							</h2>

							<div class="space-y-5 text-sm text-gray-800">
								<div>
									<p>Max Mustermann</p>
									<p>Öjendorfer Weg 47</p>
									<p>22119 Hamburg</p>
									<p>Deutschland</p>
								</div>

								<div>
									<p class="text-gray-500 mb-1">E-Mail-Adresse</p>
									<p>max.mustermann@beispiel.de</p>
								</div>

								<div>
									<p class="text-gray-500 mb-1">Telefonnummer</p>
									<p>+49 40 12345678</p>
								</div>
							</div>
						</div>

						{{-- INFO BOX --}}
						<div class="bg-[#f0f4f8] border border-blue-100 rounded-md p-5 flex items-start gap-3">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-blue-900 shrink-0 mt-0.5">
								<path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 0 1 .67 1.34l-.04.022c-1.147.573-2.438-.463-2.127-1.706l.71-2.836-.042.02a.75.75 0 1 1-.671-1.34l.041-.022ZM12 9a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
							</svg>
							<p class="text-blue-900 text-sm leading-relaxed">
								Die Daten werden nicht gespeichert und ausschließlich dem jeweiligen Anbieter zur Abwicklung Ihrer Bestellung übermittelt.
							</p>
						</div>

					</div>
					@endif
				</section>
			</main>

		</div>
		<x-footer />

	</div>

</body>

</html>