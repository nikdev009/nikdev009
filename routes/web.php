<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontProductListController;
use App\Http\Controllers\cartcontroller;
use App\Http\Controllers\productcontroller;


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

Route::get('/',[FrontProductListController::class, 'index'])->name('page');
Route::get('product/{id}',[FrontProductListController::class, 'show'])->name('product.view');
Route::get('/category/{name}',[FrontProductListController::class, 'allproduct'])->name('produt.list');
Route::get('/addTocart/{product}',[cartcontroller::class, 'addtocart'])->name('add.cart');
Route::get('/cart',[cartcontroller::class, 'showcart'])->name('show.cart');
Route::get('/product/{product}',[cartcontroller::class, 'updatecart'])->name('update.cart');
Route::get('/products/{product}',[cartcontroller::class, 'removecart'])->name('remove.cart');
Route::get('/checkout/{amount}',[cartcontroller::class, 'checkout'])->name('caheckout.cart')->middleware('auth');
Route::get('/charge',[cartcontroller::class, 'charge'])->name('charge.cart');
Route::get('/order',[cartcontroller::class, 'order'])->name('order')->middleware('auth');
Auth::routes();

Route::get('all/products',[FrontProductListController::class, 'moreProducts'])->name('more.product');
Route::get('/home', 'HomeController@index')->name('home');
Route::group(['prefix'=>'auth','middleware'=>['auth','is_admin']],function(){
	Route::get('/dashboard', function () {
		return view('admin.dashboard');
	});
	Route::resource('category','CategoryController');
	Route::resource('subcategory','SubCategoryController');
	Route::resource('product','ProductController');
	Route::get('product/subcategories/{id}','ProductController@loadSubCategories');

	Route::get('slider/create','SliderController@create')->name('slider.create');
	Route::get('slider','SliderController@index')->name('slider.index');
	Route::post('slider','SliderController@store')->name('slider.store');
	Route::delete('slider/{id}','SliderController@destroy')->name('slider.destroy');
	Route::get('users','UserController@index')->name('user.index');

	//order
	Route::get('/order','cartcontroller@userorder')->name('order.index');
	Route::get('/orders/{userid}/{orderid}','CartController@viewUserOrder')->name('user.order');


});
    