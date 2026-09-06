<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

// USUARIOS
Route::group(['middleware' => 'App\Http\Middleware\Authenticate'], function () {
    Route::get('/', 'HomeController@index')->name('home');
});

// USUARIOS
Route::group(['middleware' => 'App\Http\Middleware\Authenticate'], function () {
    Route::get('usuarios/verDatos', 'User\UserController@verDatos')->name('usuarios.verDatos');
    Route::get('/usuarios/cambioEstado/{id}', 'User\UserController@cambioEstado')->name('usuarios.cambioEstado');
    Route::get('usuarios/indexData', 'User\UserController@indexData')->name('indexData');
    Route::get('/usuarios/darUsername/{nombre}/{apellido}', 'User\UserController@darUsername')->name('usuarios.darUsername');
    Route::get('usuarios/profile', 'User\UserController@profile')->name('profile');
    Route::resource('usuarios', 'User\UserController');
    Route::post('usuarios/actualizarPassword', 'User\UserController@actualizarPassword')->name('usuarios.actualizarPassword');
});

// MENU
Route::group(['middleware' => 'App\Http\Middleware\Authenticate'], function () {
    Route::resource('menu', 'Menu\MenuController');
    Route::get('menu/create', 'Menu\MenuController@create')->name('crear_menu');
    Route::get('menu/{id}/edit', 'Menu\MenuController@edit')->name('editar_menu');
    Route::get('menu/{id}/destroy', 'Menu\MenuController@destroy')->name('eliminar_menu');
    Route::post('menu/guardar-orden', 'Menu\MenuController@guardarOrden')->name('guardar_orden');
    Route::post('menu/guardar-nuevo', 'Menu\MenuController@guardarNuevo')->name('guardarNuevo');
    Route::post('menu/update-nemu', 'Menu\MenuController@updateNemu')->name('updateNemu');
    Route::get('menu/datos-menu/{id}', 'Menu\MenuController@datosMenu')->name('datosMenu');
});

// ROL
Route::group(['middleware' => 'App\Http\Middleware\Authenticate'], function () {
    Route::resource('rol', 'Rol\RolController');
    Route::get('editRolModal', 'Rol\RolController@editRolModal')->name('rol.editRolModal');
});

// MENU ROL
Route::group(['middleware' => 'App\Http\Middleware\Authenticate'], function () {
    Route::resource('menu-rol', 'MenuRol\MenuRolController');
    Route::post('menu-rol', 'MenuRol\MenuRolController@guardar')->name('guardar_menu_rol');
});

// COMPANY
Route::group(['middleware' => 'App\Http\Middleware\Authenticate'], function () {
    Route::delete('company/desactivarCompany/{id}', 'Company\CompanyController@desactivarCompany')->name('company.desactivarCompany');
    Route::get('/company/conexionCompanies', 'Company\CompanyController@conexionCompanies')->name('company.conexionCompanies');
    Route::get('/company/changeCompany/{id}', 'Company\CompanyController@changeCompany')->name('company.changeCompany');
    Route::resource('company', 'Company\CompanyController');
});

//PRODUCTOS
Route::group(['middleware' => 'App\Http\Middleware\Authenticate'], function () {
    Route::resource('product', 'Product\ProductController');
    Route::post('product/saveCateLayapa', 'Product\ProductController@saveCateLayapa')->name('product.saveCateLayapa');
});

/// CATEGORY
Route::group(['middleware' => 'App\Http\Middleware\Authenticate'], function () {
    Route::resource('category', 'Category\CategoryController');
});

//CUSTOMER 
Route::group(['middleware' => 'App\Http\Middleware\Authenticate'], function () {
    Route::get('customer/cartilla/{code}', 'Customer\CustomerController@cartilla')->name('customer.cartilla');
    Route::get('customer/cartilla/imprimir/{code}', 'Customer\CustomerController@cartillaImprimir')->name('customer.cartillaImprimir');
    Route::resource('customer', 'Customer\CustomerController');
});

//ARBOL
Route::group(['middleware' => 'App\Http\Middleware\Authenticate'], function () {
    Route::put('arbolrole/cambioMenu/{id}', 'Arbol\ArbolController@cambioMenu')->name('arbol.cambioMenu');
    Route::get('/arbolrole/tree/{rol_id}', 'Arbol\ArbolController@tree')->name('general.tree');
    Route::resource('arbolrole', 'Arbol\ArbolController');
});

//COUNTRIES
Route::group(['middleware' => 'App\Http\Middleware\Authenticate'], function () {
    Route::resource('country', 'Country\CountryController');
});

//CITIES
Route::group(['middleware' => 'App\Http\Middleware\Authenticate'], function () {
    Route::resource('city', 'City\CityController');
});

//REGIONS
Route::group(['middleware' => 'App\Http\Middleware\Authenticate'], function () {
    Route::resource('region', 'Region\RegionController');
});
