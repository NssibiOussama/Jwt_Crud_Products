<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Product\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware("jwtAuth");
Route::post('/refresh', [AuthController::class, 'refresh'])->middleware("jwtAuth");
Route::get('/user-profile', [AuthController::class, 'getUser'])->middleware("jwtAuth");



// Using named routes for product-related actions
Route::get('/products/data', [ProductController::class, 'data'])->middleware('jwtAuth')->name('products.data');
Route::resource('products', ProductController::class)->middleware('jwtAuth');



