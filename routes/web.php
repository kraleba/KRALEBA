<?php

use App\Helpers\CustomerHelper;
use App\Http\Controllers\BillsController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\CustomerWaresControler;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductMarketController;
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
    Route::get('admin/find_market_product', [CustomerHelper::class, 'find_market_product']);
    Route::get('admin/bills_autocomplete', [CustomerHelper::class, 'bills_autocomplete']);
    Route::get('admin/search_ware_name', [CustomerHelper::class, 'search_ware_name']);
    Route::get('admin/template_child_validator', [CustomerHelper::class, 'template_child_validator']);
    Route::get('admin/take_customer_categories_by_customer_id', [CustomerHelper::class, 'take_customer_categories_by_customer_id']);

//    Route::get('admin/customer/helper_add_subcategory', [CustomerHelper::class, 'helper_add_subcategory']);

    //ware
    Route::resource('admin/wares', CustomerWaresControler::class);
//    Route::get('admin/wares', [CustomerWaresControler::class, 'index']);

    //ware-textile
    Route::get('admin/textile', [CustomerWaresControler::class, 'customers_textile'])->name('textile');


    //bils
    Route::resource('admin/bills', BillsController::class);
//    Route::get('admin/bills', [BillsController::class, 'index']);
//    Route::get('admin/customers/{id}/create_bill', [BillsController::class, 'generate_bill'])->name('create_bill');
    Route::get("/admin/get_customer_coin", [CustomerHelper::class, 'get_customer_coin']);

    /*product template*/
    Route::resource('admin/templates', ProductTemplateController::class);
    Route::post('admin/templates/create_child_templates', [CustomerHelper::class, 'create_child_templates']);

    /*product market route*/
    Route::resource('admin/market', ProductMarketController::class);


});

/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:manager'])->group(function () {

    Route::get('/manager/home', [HomeController::class, 'managerHome'])->name('manager.home');
});

