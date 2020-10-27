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

Route::get('/', function () {
    return redirect('admin/login');
});

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
    Route::get('add-categoey-product','CategoryProductController@viewAddCategoryProduct')->name('viewAddCategoryProduct');
    Route::get('list-categoey-product','CategoryProductController@viewListCategoryProduct')->name('viewListCategoryProduct');
    Route::post('add-category-product', 'CategoryProductController@handleAddCategoryProduct')->name('handleAddCategoryProduct');
    Route::get('del-category-product/{category_id}', 'CategoryProductController@handleDelCategoryProduct')->name('handleDelCategoryProduct');
    Route::get('edit-category-product/{category_id}', 'CategoryProductController@viewEditCategoryProduct')->name('viewEditCategoryProduct');
    Route::post('handle-edit-category-product/{category_id}', 'CategoryProductController@handleEditCategoryProduct')->name('handleEditCategoryProduct');
    
    
});
 

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
