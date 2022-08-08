<?php

use App\Helpers\CustomerHelper;
use App\Http\Controllers\BillsController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\CustomerWaresControler;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductTemplateController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

/*------------------------------------------
--------------------------------------------
All Normal Users Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:user'])->group(function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:admin'])->group(function () {

    //customers
    Route::resource('admin/customers', CustomersController::class);
    Route::get('admin/customers/{id}/subcategory/{subcategory_id}', [CustomersController::class, 'delete_subcategory']);
    Route::get('admin/customers/subcategory/{subcategory_id}', [CustomersController::class, 'delete_subcategory']);
    Route::get('admin/downloadPDF', [CustomersController::class, 'downloadPDF']);

    //helpers
    Route::get('admin/show_subcategory_by_category_id', [CustomerHelper::class, 'show_subcategory_by_category_id']);
    Route::get('admin/customers/create_edit/helper_add_subcategory', [CustomerHelper::class, 'helper_add_subcategory']);
    Route::get('admin/customers/{id}/create_edit/helper_add_subcategory', [CustomerHelper::class, 'helper_add_subcategory']);
    Route::get('admin/customers_autocomplete', [CustomerHelper::class, 'customers_autocomplete']);
    Route::get('admin/find_textiles_filters', [CustomerHelper::class, 'find_textiles_filters']);

//    Route::get('admin/customer/helper_add_subcategory', [CustomerHelper::class, 'helper_add_subcategory']);

    //ware
    Route::resource('admin/customers/{customer_id}/wares', CustomerWaresControler::class);
    Route::get('admin/wares', [CustomerWaresControler::class, 'index']);

    //ware-textile
    Route::get('admin/textile', [CustomerWaresControler::class, 'customers_textile'])->name('textile');



    //bils
    Route::resource('admin/customers/{customer_id}/bills', BillsController::class);
    Route::get('admin/bills', [BillsController::class, 'index']);
//    Route::get('admin/customers/{id}/create_bill', [BillsController::class, 'generate_bill'])->name('create_bill');

    /*product template*/
    Route::resource('admin/templates', ProductTemplateController::class);
    Route::post('admin/templates/create_child_templates', [CustomerHelper::class, 'create_child_templates']);




});

/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:manager'])->group(function () {

    Route::get('/manager/home', [HomeController::class, 'managerHome'])->name('manager.home');
});

