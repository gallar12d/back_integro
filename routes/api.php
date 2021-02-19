
<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;



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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::group(['middleware' => ['auth:sanctum', 'cors']], function () {
    Route::resources([
        'users' => UserController::class,
        'articles' => ArticleController::class,
        'categories' => CategoryController::class,

    ]);
    Route::post("/like", [ArticleController::class, 'like']);
    Route::post("/picture", [ArticleController::class, 'picture']);

});
Route::group(['middleware' => 'cors'], function () {
    Route::post("/login", [UserController::class, 'login']);
});
