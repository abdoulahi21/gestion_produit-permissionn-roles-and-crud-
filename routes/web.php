<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});
Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::resources([
    'roles' => RoleController::class,
    'users' => UserController::class,
    'produit'=>\App\Http\Controllers\ProduitsController::class,
    'client'=>\App\Http\Controllers\ClientsController::class,
    'categorie'=>\App\Http\Controllers\CategoriesController::class,
    'commande'=>\App\Http\Controllers\CommandesController::class,
]);
Route::get('/produit-export', [App\Http\Controllers\ProduitsController::class,'export'])->name('produit.export');
Route::post('/produit-import',  [App\Http\Controllers\ProduitsController::class,'import'])->name('produit.import');

Route::get('/client-export', [App\Http\Controllers\ClientsController::class,'export'])->name('client.export');
Route::post('/client-import',  [App\Http\Controllers\ClientsController::class,'import'])->name('client.import');
Route::get('/dashbord',[App\Http\Controllers\DashbordController::class,'index'])->name('dashbord');
