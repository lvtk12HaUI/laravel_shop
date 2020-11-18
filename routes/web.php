<?php

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

// Route::get('/', function () {
//     return view("frontend.home");
// });

Route::get('/','Frontend\HomeController@index')->name('index');

Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin',
    'middleware' => 'AdminIsLogined'
], function () {
    //Routes login
    Route::get('login','LoginController@viewLogin')->name('viewLogin');
    Route::post('handle-login','LoginController@handleLogin')->name('handleLogin');   
    Route::get('register','LoginController@viewRegister')->name('viewRegister');
    Route::post('handle-register','LoginController@handleRegister')->name('handleRegister');
});

Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin',
    'middleware' => 'CheckAdminLogined'
], function () {
    //Route dashboard
    Route::get('dashboard','AdminController@viewDashboard')->name('viewDashboard');
    Route::post('handle-logout','LoginController@handleLogout')->name('handleLogout');
    //Route category product
    Route::get('add-category-product','CategoryProductController@viewAddCategoryProduct')->name('viewAddCategoryProduct');
    Route::get('list-category-product','CategoryProductController@viewListCategoryProduct')->name('viewListCategoryProduct');
    Route::post('handle-add-category-product', 'CategoryProductController@handleAddCategoryProduct')->name('handleAddCategoryProduct');
    Route::get('del-category-product/{category_id}', 'CategoryProductController@handleDelCategoryProduct')->name('handleDelCategoryProduct');
    Route::get('edit-category-product/{category_id}', 'CategoryProductController@viewEditCategoryProduct')->name('viewEditCategoryProduct');
    Route::post('handle-edit-category-product/{category_id}', 'CategoryProductController@handleEditCategoryProduct')->name('handleEditCategoryProduct');

    //Route brand product
    Route::get('add-brand-product','BrandProductController@viewAddBrandProduct')->name('viewAddBrandProduct');
    Route::get('list-brand-product','BrandProductController@viewListBrandProduct')->name('viewListBrandProduct');
    Route::post('handle-add-brand-product', 'BrandProductController@handleAddBrandProduct')->name('handleAddBrandProduct');
    Route::get('del-brand-product/{brand_id}', 'BrandProductController@handleDelBrandProduct')->name('handleDelBrandProduct');
    Route::get('edit-brand-product/{brand_id}', 'BrandProductController@viewEditBrandProduct')->name('viewEditBrandProduct');
    Route::post('handle-edit-brand-product/{brand_id}', 'BrandProductController@handleEditBrandProduct')->name('handleEditBrandProduct');

    //Route  product
    Route::get('add-product','ProductController@viewAddProduct')->name('viewAddProduct');
    Route::get('list-product','ProductController@viewListProduct')->name('viewListProduct');
    Route::post('handle-add-product', 'ProductController@handleAddProduct')->name('handleAddProduct');
    Route::get('del-product/{product_id}', 'ProductController@handleDelProduct')->name('handleDelProduct');
    Route::get('edit-product/{product_id}', 'ProductController@viewEditProduct')->name('viewEditProduct');
    Route::post('handle-edit-product/{product_id}', 'ProductController@handleEditProduct')->name('handleEditProduct');
    
    
});


 

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
