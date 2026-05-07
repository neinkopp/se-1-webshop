<?php

use App\Http\Controllers\ProductListController;
use Illuminate\Support\Facades\Route;
use App\Models\Product;

Route::get('/', [ProductListController::class, "show"]);

Route::get('/products', [ProductListController::class, "show"]);

Route::get('/products/{productHandle}', function ($productHandle) {

    $products = [
        [
            'productHandle' => 'mockup_product_1',
            'productDisplayName' => 'Mertens\'s Sack',
            'productDisplayPrice' => rand(0,9).rand(0,9).','.rand(0,9).rand(0,9),
            'productDescription' => 'Hier passt viel rein und bequem fühlt er sich auch an. Frauen lieben ihn!',
            'productImagePath' => 'resources/images/mockup_product_1.png',
        ],
        [
            'productHandle' => 'mockup_product_2',
            'productDisplayName' => 'Mertens\'s T-Shirt mit extra Ehre',
            'productDisplayPrice' => rand(0,9).rand(0,9).','.rand(0,9).rand(0,9),
            'productDescription' => 'Du brauchst Aura-Punkte auf schnelle-welle? Dieses T-Shirt ist absolut ehrenhaft und gibt dir den Look, den ein wahrer Löwe braucht. Rawr!',
            'productImagePath' => 'resources/images/mockup_product_2.png',
        ],
        [
            'productHandle' => 'mockup_product_3',
            'productDisplayName' => 'Magischer Teppich des Mertens',
            'productDisplayPrice' => rand(0,9).rand(0,9).','.rand(0,9).rand(0,9),
            'productDescription' => 'Kann er fliegen? Wer weiß das schon? Er sieht schick aus und ist leicht zu reinigen!',
            'productImagePath' => 'resources/images/mockup_product_3.png',
        ],
        [
            'productHandle' => 'mockup_product_4',
            'productDisplayName' => 'Bettwäsche und Kissen mit dem Gesicht von Mertens',
            'productDisplayPrice' => rand(0,9).rand(0,9).','.rand(0,9).rand(0,9),
            'productDescription' => 'Stell dir vor, du wachst auf und wirst begrüßt vom göttlichen Anblick Mertens. Zu einem guten Schlaf gehört immer auch ein Professor!',
            'productImagePath' => 'resources/images/mockup_product_4.png',
        ],
        [
            'productHandle' => 'mockup_product_5',
            'productDisplayName' => 'X-Streme Mertens Energy Drink',
            'productDisplayPrice' => rand(0,9).rand(0,9).','.rand(0,9).rand(0,9),
            'productDescription' => 'Für den X-Stremen Kick in die Nacht. Dieser Schmackofatz liefert dir die Energie, die du während deiner Fortnite-Runde brauchst. Auf den Sieg! Auf Mertens\'s X-Streme!',
            'productImagePath' => 'resources/images/mockup_product_5.png',
        ]
    ];

    $product = collect($products)->firstWhere('productHandle', $productHandle);

    if (!$product) {
        abort(404);
    }

    return view('product', compact('product'));

});
