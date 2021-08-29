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
Route::get('/pagination', function(){   return view('dashboard.base.pagination'); });
Route::group(['middleware' => ['get.menu']], function () {
    Route::prefix('admin')->group(function () {
        Route::get('login', 'Auth\AdminController@showLoginForm')->name('admin.login');
        Route::post('login', 'Auth\AdminController@login');
        Route::post('logout', 'Auth\AdminController@logout')->name('admin.logout');

        Route::get('/', function () {           return view('dashboard.homepage'); })->middleware('admin')->name('admin');

//        Route::group(['middleware' => ['role:user']], function () {
            Route::get('/colors', function () {     return view('dashboard.colors'); });
            Route::get('/typography', function () { return view('dashboard.typography'); });
            Route::get('/charts', function () {     return view('dashboard.charts'); });
            Route::get('/widgets', function () {    return view('dashboard.widgets'); });
            Route::get('/404', function () {        return view('dashboard.404'); });
            Route::get('/500', function () {        return view('dashboard.500'); });
            Route::prefix('base')->group(function () {
                Route::get('/breadcrumb', function(){   return view('dashboard.base.breadcrumb'); });
                Route::get('/cards', function(){        return view('dashboard.base.cards'); });
                Route::get('/carousel', function(){     return view('dashboard.base.carousel'); });
                Route::get('/collapse', function(){     return view('dashboard.base.collapse'); });

                Route::get('/forms', function(){        return view('dashboard.base.forms'); });
                Route::get('/jumbotron', function(){    return view('dashboard.base.jumbotron'); });
                Route::get('/list-group', function(){   return view('dashboard.base.list-group'); });
                Route::get('/navs', function(){         return view('dashboard.base.navs'); });

                Route::get('/pagination', function(){   return view('dashboard.base.pagination'); });
                Route::get('/popovers', function(){     return view('dashboard.base.popovers'); });
                Route::get('/progress', function(){     return view('dashboard.base.progress'); });
                Route::get('/scrollspy', function(){    return view('dashboard.base.scrollspy'); });

                Route::get('/switches', function(){     return view('dashboard.base.switches'); });
                Route::get('/tables', function () {     return view('dashboard.base.tables'); });
                Route::get('/tabs', function () {       return view('dashboard.base.tabs'); });
                Route::get('/tooltips', function () {   return view('dashboard.base.tooltips'); });
            });
            Route::prefix('buttons')->group(function () {
                Route::get('/buttons', function(){          return view('dashboard.buttons.buttons'); });
                Route::get('/button-group', function(){     return view('dashboard.buttons.button-group'); });
                Route::get('/dropdowns', function(){        return view('dashboard.buttons.dropdowns'); });
                Route::get('/brand-buttons', function(){    return view('dashboard.buttons.brand-buttons'); });
            });
            Route::prefix('icon')->group(function () {  // word: "icons" - not working as part of adress
                Route::get('/coreui-icons', function(){         return view('dashboard.icons.coreui-icons'); });
                Route::get('/flags', function(){                return view('dashboard.icons.flags'); });
                Route::get('/brands', function(){               return view('dashboard.icons.brands'); });
            });
            Route::prefix('notifications')->group(function () {
                Route::get('/alerts', function(){   return view('dashboard.notifications.alerts'); });
                Route::get('/badge', function(){    return view('dashboard.notifications.badge'); });
                Route::get('/modals', function(){   return view('dashboard.notifications.modals'); });
            });
            Route::resource('notes', 'admin\NotesController');
            Route::resource('customer', 'admin\CustomerController');
            Route::post('customer/search','admin\CustomerController@search')->name('customer.search');
        Route::post('user/search','admin\UsersController@search')->name('user.search');
        Route::post('product/search','admin\ProductsController@search')->name('product.search');
//        Route::get('customer/search','admin\CustomerController@search')->name('customer.search');
            Route::resource('products', 'admin\ProductsController');
            Route::resource('makers', 'admin\MakersController');
            Route::post('makers/list', 'admin\MakersController@list');


            Route::get('estimates','admin\EstimatesController@index');

            Route::prefix('estimates')->group(function () {
                Route::post('/list', 'admin\EstimatesController@list');
            });

            Route::get('estimate/pdf_{id}', 'admin\EstimatesController@showPdf')->name('showpdf');
            Route::get('estimate/{id}', 'admin\EstimatesController@detail')->name('customerDetail');
//        });


        Route::resource('resource/{table}/resource', 'admin\ResourceController')->names([
            'index'     => 'resource.index',
            'create'    => 'resource.create',
            'store'     => 'resource.store',
            'show'      => 'resource.show',
            'edit'      => 'resource.edit',
            'update'    => 'resource.update',
            'destroy'   => 'resource.destroy'
        ]);

//        Route::group(['middleware' => ['role:admin']], function () {
            Route::resource('bread',  'admin\BreadController');   //create BREAD (resource)
            Route::resource('adminusers',        'admin\UsersController')->except( ['create', 'store'] );

            Route::resource('roles',        'admin\RolesController');
            Route::resource('mail',        'admin\MailController');
            Route::get('prepareSend/{id}',        'admin\MailController@prepareSend')->name('prepareSend');
            Route::post('mailSend/{id}',        'admin\MailController@send')->name('mailSend');
            Route::get('/roles/move/move-up',      'admin\RolesController@moveUp')->name('roles.up');
            Route::get('/roles/move/move-down',    'admin\RolesController@moveDown')->name('roles.down');
            Route::prefix('menu/element')->group(function () {
                Route::get('/',             'admin\MenuElementController@index')->name('menu.index');
                Route::get('/move-up',      'admin\MenuElementController@moveUp')->name('menu.up');
                Route::get('/move-down',    'admin\MenuElementController@moveDown')->name('menu.down');
                Route::get('/create',       'admin\MenuElementController@create')->name('menu.create');
                Route::post('/store',       'admin\MenuElementController@store')->name('menu.store');
                Route::get('/get-parents',  'admin\MenuElementController@getParents');
                Route::get('/edit',         'admin\MenuElementController@edit')->name('menu.edit');
                Route::post('/update',      'admin\MenuElementController@update')->name('menu.update');
                Route::get('/show',         'admin\MenuElementController@show')->name('menu.show');
                Route::get('/delete',       'admin\MenuElementController@delete')->name('menu.delete');
            });
            Route::prefix('menu/menu')->group(function () {
                Route::get('/',         'admin\MenuController@index')->name('menu.menu.index');
                Route::get('/create',   'admin\MenuController@create')->name('menu.menu.create');
                Route::post('/store',   'admin\MenuController@store')->name('menu.menu.store');
                Route::get('/edit',     'admin\MenuController@edit')->name('menu.menu.edit');
                Route::post('/update',  'admin\MenuController@update')->name('menu.menu.update');
                Route::get('/delete',   'admin\MenuController@delete')->name('menu.menu.delete');
            });
            Route::prefix('media')->group(function () {
                Route::get('/',                 'admin\MediaController@index')->name('media.folder.index');
                Route::get('/folder/store',     'admin\MediaController@folderAdd')->name('media.folder.add');
                Route::post('/folder/update',   'admin\MediaController@folderUpdate')->name('media.folder.update');
                Route::get('/folder',           'admin\MediaController@folder')->name('media.folder');
                Route::post('/folder/move',     'admin\MediaController@folderMove')->name('media.folder.move');
                Route::post('/folder/delete',   'admin\MediaController@folderDelete')->name('media.folder.delete');;

                Route::post('/file/store',      'admin\MediaController@fileAdd')->name('media.file.add');
                Route::get('/file',             'admin\MediaController@file');
                Route::post('/file/delete',     'admin\MediaController@fileDelete')->name('media.file.delete');
                Route::post('/file/update',     'admin\MediaController@fileUpdate')->name('media.file.update');
                Route::post('/file/move',       'admin\MediaController@fileMove')->name('media.file.move');
                Route::post('/file/cropp',      'admin\MediaController@cropp');
                Route::get('/file/copy',        'admin\MediaController@fileCopy')->name('media.file.copy');
            });
//        });
    });
});

Auth::routes();

Route::get('/findWine', 'HomeController@findWine')->name('findWine');
Route::post('/findWine', 'HomeController@findWine')->name('findWine');
Route::get('productexport', [\App\Http\Controllers\ProductsController::class, 'productexport'])->name('productexport');
Route::get('makerexport', [\App\Http\Controllers\ProductsController::class, 'makerexport'])->name('makerexport');
Route::get('/makerRanking', 'HomeController@makerRanking')->name('makerRanking');
Route::get('/productRanking', 'HomeController@productRanking')->name('productRanking');
Route::get('/productdetail/{id}', 'ProductsController@detail');
Route::get('/makerdetail/{id}', 'ProductsController@makerdetail');

Route::get('/','HomeController@home')->name('home');
Route::get('/product/ajaxavailableproduct/{page}','HomeController@ajaxAvailableProduct')->name('ajaxAvailableProduct');
Route::get('/cart','CartController@cart')->name('cart');
Route::post('range/refreshajax','HomeController@refreshAjax');

Route::get('/advancedSearch', 'HomeController@advancedSearch')->name('advancedSearch');
Route::get('/rangeSearch', 'HomeController@rangeSearch')->name('rangeSearch');

Route::post('/totalfind', 'ProductsController@totalFind')->name('totalFind');
Route::get('/totalfind', 'ProductsController@totalFind')->name('totalFind');

Route::post('/totalAjaxFind', 'ProductsController@totalAjaxFind')->name('totalAjaxFind');
Route::get('/totalAjaxFind', 'ProductsController@totalAjaxFind')->name('totalAjaxFind');

Route::post('/advancedAjaxResult', 'ProductsController@advancedAjaxResult')->name('advancedAjaxResult');

Route::POST('/product/ajaxsearch','ProductsController@ajaxSearch');

Route::POST('/product/ajaxsearch','ProductsController@ajaxSearch');
Route::get('/product/ajaxsearch','ProductsController@ajaxSearch');
//Route::POST('/product/ajaxsearch/{page}','ProductsController@ajaxSearch')->name('ajaxPagination');

Route::POST('/product/ajaxregions','ProductsController@ajaxRegions')->name("ajaxRegions");

Route::POST('/maker/ajaxsearch','ProductsController@ajaxMakerList')->name('ajaxMakerList');
Route::POST('/product/ajaxranking','ProductsController@ajaxProductList')->name('ajaxProductList');

Route::POST('/product/ajaxredvariety','ProductsController@ajaxRedVariety');
Route::POST('/product/ajaxwhitevariety','ProductsController@ajaxWhiteVariety');

Route::POST('/ajaxregion','ProductsController@getRegionByCountry')->name('getRegionByCountry');


Route::patch('update-cart', 'CartController@update');
Route::delete('remove-from-cart', 'CartController@remove');


Route::post('/advancedresult','ProductsController@advancedResult')->name('advancedResult');
Route::get('/advancedresult','ProductsController@advancedResult')->name('advancedResult');



//Route::get('/addToCart/{id}', 'CartController@addToCart');
Route::post('addToCart', 'CartController@addToCart');
Route::post('addCaseToCart', 'CartController@addCaseToCart');
Route::get('pdf', 'CartController@createPDF');
Route::get('cartclear','CartController@clearCart');
Route::get('tmp', 'CartController@tmp');
Route::get('customerinfo','HomeController@customer');
Route::post('getcustomerinfo','HomeController@customerinfo');


