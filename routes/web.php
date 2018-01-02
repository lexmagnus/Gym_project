<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Auth::routes();


Route::group(['middleware' => ['auth']], function(){

    Route::get('/plan', 'PlanController@index')->name('plano');
    Route::get('/plan/{id}', 'PlanController@show')->name('plan');

    Route::group(['prefix' => 'subscribe'], function(){

        Route::post('/', 'PlanController@subscribe')->name('subscribe');
        Route::get('/cancel', 'PlanController@confirmCancellation')->name('confirmCancellation');
        Route::post('/cancel', 'PlanController@cancelSubscription')->name('subscriptionCancel');
        Route::post('/resume', 'PlanController@resumeSubscription')->name('subscriptionResume');

        Route::get('/invoices', 'InvoiceController@index')->name('invoices');
        Route::get('/invoice/{id}', 'InvoiceController@download')->name('downloadInvoice');

    });
});

// Handling Stripe Webhooks
Route::post(
    'stripe/webhook',
    '\Laravel\Cashier\Http\Controllers\WebhookController@handleWebhook'
);




Route::get('/', 'PagesController@index');
Route::get('/home', 'HomeController@index');
Route::get('/home/{username}', 'PerfilController@index');
Route::get('/home/{username}/perfil', 'PerfilController@perfil');
Route::get('/home/{username}/edit', 'PerfilController@show_edit');
Route::get('/home/{username}/addMorada', 'MoradaController@index');
Route::get('/home/{username}/altEmail', 'PerfilController@email');
Route::get('/home/{username}/altPassword', 'PerfilController@pass');
Route::post('/home/{username}/altPassword', 'PerfilController@edit_pass');
Route::post('/home/{username}/altEmail', 'PerfilController@edit_email');
Route::post('/home/{username}/addMorada', 'MoradaController@add');
Route::post('/home/{username}/edit', 'PerfilController@edit');
Route::post('/home/{username}', 'PerfilController@update_avatar');




//Route::get('/', 'HomeController@index');
/*Route::get('/', 'PagesController@index');
Route::get('/home', 'HomeController@index');
Route::group(['prefix' => '/home/{username}'], function(){

    Route::get('/', 'PerfilController@index');
    Route::post('/', 'PerfilController@update_avatar');
    Route::get('/perfil', 'PerfilController@perfil');
    Route::get('/edit', 'PerfilController@show_edit');
    Route::get('/addMorada', 'MoradaController@index');
    Route::get('/altEmail', 'PerfilController@email');
    Route::get('/altPassword', 'PerfilController@pass');
    Route::post('/altPassword', 'PerfilController@edit_pass');
    Route::post('/altEmail', 'PerfilController@edit_email');
    Route::post('/addMorada', 'MoradaController@add');
    Route::post('/edit', 'PerfilController@edit');
});*/

//Route::get('services', 'ServicesController@services');
Route::get('services', 'EventController@index');

Route::post('services', [
    'uses' => 'EventController@addClass',
    'as' => 'class.create',
    'middleware' => 'auth'
    ]);

Route::get('pt', [
    'uses' => 'ChatController@getPT',
    'as' => 'pt',
    'middleware' => 'auth'
    ]);

Route::post('createpost', [
    'uses' => 'ChatController@postCreate',
    'as' => 'post.create',
    'middleware' => 'auth'
    ]);

/*Route::get("/home/{username}", function()
{
   return View::make("perfil");
});*/
//Route::get('verifyEmailFirst', 'Auth\RegisterController@verifyEmailFirst')->name('verifyEmailFirst');
Route::get('verify/{email}/{verifyToken}', 'Auth\RegisterController@sendEmailDone')->name('sendEmailDone');
//Route::get('/about', 'PagesController@about');
//Route::get('/services', 'PagesController@services');
//Route::get('/register', 'PessoaController@index');
//Route::post('/register', 'PessoaController@add');

Route::get('/dadosPessoais', 'DadospessoaisController@dadosP');
Route::get('/pagamentos', 'PagamentosController@pagamentos');

/*Route::get('/admin/', ['middleware' => 'admin', function () {  
    return view('admin.admin');
}]);*/
Route::group(['middleware' => 'admin'], function () {
    Route::get('/admin', 'AdminController@dashboard')->name('dashboard');
    Route::get('/admin/clientes', 'AdminController@clientes')->name('admin');
    Route::post('/admin/clientes/add', 'AdminController@create_client')->name('add_client');
    Route::post('/admin/clientes/update_{id}', 'AdminController@update_client')->name('update_client');
    Route::get('/admin/clientes/find_client', 'AdminController@find_client')->name('find_client');
    Route::get('/admin/cliente/delete', 'AdminController@deleteCliente')->name('deletecliente');
    Route::get('/admin/pt', 'AdminController@pt')->name('admin_pt');
    Route::post('/admin/pt/add', 'AdminController@create_pt')->name('add_pt');
    Route::get('/admin/pt/delete', 'AdminController@deletept')->name('deletept');
    Route::get('/admin/pt/find_pt', 'AdminController@find_pt')->name('find_pt');
    Route::get('/admin/admin', 'AdminController@admin')->name('admin_admin');
    Route::get('/admin/pt/find_admin', 'AdminController@find_admin')->name('find_admin');

    //another routes...
});

Route::group(['middleware' => 'instruct'], function () {
    Route::get('/aulas', 'InstrutorController@index');
    //another routes...
});

/*Route::get('/', function () {
    if(Auth::check()) {
        return redirect('home');
    }
    return view('index');
})->name('home');*/
//limpar cache sem usar command line
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    // return what you want
});
//Auth::routes();

//Route::get('/home', 'HomeController@index');