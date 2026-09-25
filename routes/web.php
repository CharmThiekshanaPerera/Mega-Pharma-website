<?php

use App\Http\Controllers\Admin\ContactMessageController as AdminContactMessageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController as PublicProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/collections', [CollectionController::class, 'index'])->name('collections.index');
Route::get('/collections/{slug}', [CollectionController::class, 'show'])->name('collections.show');

Route::get('/products/{product:slug}', [PublicProductController::class, 'show'])->name('products.show');

// Admin-uploaded product photos (see Admin\ProductController::applyImage) live
// on the storage/ volume, not public/ — nginx's static file root is a
// separate, build-time-baked image with no visibility into that volume, so
// these are served through Laravel instead. nginx's `try_files … /index.php`
// already falls through here for any path it doesn't recognise as a static
// file, so this needs no nginx/compose changes to work. Filename is
// constrained to a safe charset (no `/`), so no path-traversal concern.
Route::get('/product-images/{filename}', function (string $filename) {
    $disk = Storage::disk('public');
    $path = "products/{$filename}";
    abort_unless($disk->exists($path), 404);

    return response()->file($disk->path($path), [
        'Cache-Control' => 'public, max-age=31536000, immutable',
    ]);
})->where('filename', '[A-Za-z0-9._-]+')->name('product-images.show');

Route::post('/contact', [ContactMessageController::class, 'store'])
    ->middleware('throttle:10,1')
    ->name('contact.store');

// Rule-based assistant (see ChatbotService) — no external API, so this rate
// limit exists purely to stop a scripted hammering, not to protect a quota.
Route::post('/chat', [ChatbotController::class, 'respond'])
    ->middleware('throttle:30,1')
    ->name('chat.respond');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () {
    // Named "dashboard" (not "admin.dashboard") because Breeze's auth
    // controllers redirect to route('dashboard') after login/verification.
    Route::get('/admin', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('products', ProductController::class)->except('show');

        Route::get('messages', [AdminContactMessageController::class, 'index'])->name('messages.index');
        Route::get('messages/{message}', [AdminContactMessageController::class, 'show'])->name('messages.show');
        Route::delete('messages/{message}', [AdminContactMessageController::class, 'destroy'])->name('messages.destroy');
    });
});

require __DIR__.'/auth.php';
