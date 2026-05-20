<?php

use App\Http\Controllers\HomepageController;
use App\Http\Controllers\ProductListController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\ManagementController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\OrderController;

use App\Models\User;

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

Route::get('/', [HomepageController::class, "show"]);

Route::get('/products', [ProductListController::class, "show"]);

Route::get('/products/{productHandle}', [ProductController::class, "show"]);

Route::get('/basket', [BasketController::class, "show"])->name('basket.show');
Route::post('/putInBasket', [BasketController::class, "put"]);
Route::post('/changeBasketItem', [BasketController::class, "change"]);
Route::post('/basket/remove', [BasketController::class, 'remove'])->name('basket.remove');

Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
Route::get('/orders/{token}', [OrderController::class, 'show'])->name('orders.show');
Route::get('/orders', [OrderController::class, 'showForm']);

Route::redirect('/manage/login', "/auth/redirect")->name("login");

Route::get('/manage', [ManagementController::class, 'show'])->name('manage.show.dashboard')->middleware('auth');
Route::get('/manage/dashboard', [ManagementController::class, 'show'])->name('manage.show.dashboard')->middleware('auth');

Route::get('/manage/categories', [ManagementController::class, 'showCategories'])->name('manage.show.categories')->middleware('auth');
Route::get('/manage/categories/{category}', [ManagementController::class, 'showCategory'])->name('manage.show.category')->middleware('auth');
Route::post('/manage/categories/create', [ManagementController::class, 'createCategory'])->name('manage.create.category')->middleware('auth');
Route::post('/manage/categories/change', [ManagementController::class, 'changeCategory'])->name('manage.change.category')->middleware('auth');
Route::post('/manage/categories/{category}/delete', [ManagementController::class, 'deleteCategory'])->name('manage.delete.category')->middleware('auth');

Route::get('/manage/products', [ManagementController::class, 'showProducts'])->name('manage.show.products')->middleware('auth');
Route::get('/manage/products/{productHandle}', [ManagementController::class, 'showProduct'])->name('manage.show.product')->middleware('auth');
Route::get('/manage/products/attributes/{productHandle}', [ManagementController::class, 'showProductAttributes'])->name('manage.show.product.attributes')->middleware('auth');
Route::get('/manage/products/pictures/{productHandle}', [ManagementController::class, 'showProductPictures'])->name('manage.show.product.pictures')->middleware('auth');
Route::post('/manage/products/create', [ManagementController::class, 'createProduct'])->name('manage.create.product')->middleware('auth');
Route::post('/manage/products/change', [ManagementController::class, 'changeProduct'])->name('manage.change.product')->middleware('auth');
Route::post('/manage/products/changeAttributes', [ManagementController::class, 'changeProductAttributes'])->name('manage.change.product.attributes')->middleware('auth');
Route::post('/manage/products/changePictures', [ManagementController::class, 'changeProductPictures'])->name('manage.change.product.pictures')->middleware('auth');
Route::post('/manage/products/{productHandle}/delete', [ManagementController::class, 'deleteProduct'])->name('manage.delete.product')->middleware('auth');

Route::post("/payment", [PaymentController::class, "initatePayment"])->name("payment");

Route::post('/logout', LogoutController::class)
	->middleware('auth')
	->name('logout');

Route::get('/auth/redirect', function () {

	$driver = Socialite::driver('gitlab');
	return $driver->redirect();
});

Route::get('/auth/callback', function () {
	/** @var \Laravel\Socialite\Two\AbstractProvider $driver */
	$driver = Socialite::driver('gitlab');
	$gitlabUser = $driver->stateless()->user();

	$user = User::updateOrCreate([
		'email' => $gitlabUser->id,
	], [
		'email' => $gitlabUser->email,
		'access_token' => $gitlabUser->token,
		'refresh_token' => $gitlabUser->refreshToken,
	]);

	Auth::login($user);

	return redirect('/manage');
});
