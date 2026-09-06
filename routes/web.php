<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

// USUARIOS
Route::group(['middleware' => 'App\Http\Middleware\Authenticate'], function () {
    Route::get('home/graficaAgenteSupervisor', 'HomeController@graficaAgenteSupervisor')->name('home.graficaAgenteSupervisor');
    Route::get('home/graficaAgente', 'HomeController@graficaAgente')->name('home.graficaAgente');
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
    Route::put('company/updateSede/{id}', 'Company\CompanyController@updateSede')->name('company.updateSede');
    Route::get('/company/knowInstance/{company}', 'Company\CompanyController@knowInstance')->name('company.knowInstance');
    Route::delete('company/desactivarCompany/{id}', 'Company\CompanyController@desactivarCompany')->name('company.desactivarCompany');
    Route::get('/company/conexionCompanies', 'Company\CompanyController@conexionCompanies')->name('company.conexionCompanies');
    Route::get('/company/showCompanies', 'Company\CompanyController@showCompanies')->name('company.showCompanies');
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

//PRUEBAS DE CONEXION
Route::group(['middleware' => 'App\Http\Middleware\Authenticate'], function () {
    Route::get('envios/showApis/{code}/{service}', 'Whatsapp\WhatsappController@showApis')->name('envios.showApis');
    Route::get('envios/traficoApis', 'Whatsapp\WhatsappController@traficoApis')->name('envios.traficoApis');
    Route::get('envios/newApis/{id}', 'Whatsapp\WhatsappController@newApis')->name('envios.newApis');
    Route::post('envios/sendWhatsapp', 'Whatsapp\WhatsappController@sendWhatsapp')->name('envios.sendWhatsapp');
    Route::resource('envios', 'Whatsapp\WhatsappController');
});

//GRAFICOS HOME
Route::group(['middleware' => 'App\Http\Middleware\Authenticate'], function () {
    Route::get('/home/contarMensajes', 'HomeController@contarMensajes')->name('home.contarMensajes');
    Route::get('/home/drawGraph', 'HomeController@drawGraph')->name('home.drawGraph');
});

//PLANES
Route::group(['middleware' => 'App\Http\Middleware\Authenticate'], function () {
    Route::resource('planes', 'Plan\PlanController');
});

//SUSCRIPCIONES
Route::group(['middleware' => 'App\Http\Middleware\Authenticate'], function () {
    Route::resource('suscription', 'Suscription\SuscriptionController');
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

//TYPEAFFILIATION
Route::group(['middleware' => 'App\Http\Middleware\Authenticate'], function () {
    Route::resource('typeaffiliation', 'Affiliation\TypeAffiliationController');
});

//AFFILIATION
Route::group(['middleware' => 'App\Http\Middleware\Authenticate'], function () {
    Route::resource('affiliation', 'Affiliation\AffiliationController');
});

//PROCEDURES
Route::group(['middleware' => 'App\Http\Middleware\Authenticate'], function () {
    Route::resource('procedures', 'Procedures\ProceduresController');
});

//DOCTOR
Route::group(['middleware' => 'App\Http\Middleware\Authenticate'], function () {
    Route::resource('doctor', 'Doctor\DoctorController');
});

//SEDE
Route::group(['middleware' => 'App\Http\Middleware\Authenticate'], function () {
    Route::resource('sede', 'Sede\SedeController');
});

//DEPARTAMENT
Route::group(['middleware' => 'App\Http\Middleware\Authenticate'], function () {
    Route::resource('departament', 'Departament\DepartamentController');
});

//ATENTION
Route::group(['middleware' => 'App\Http\Middleware\Authenticate'], function () {
    Route::get('atention/showProcedures/{ID}', 'Atention\AtentionController@showProcedures')->name('atention.showProcedures');
    Route::resource('atention', 'Atention\AtentionController');
});

//BOT
Route::group(['middleware' => 'App\Http\Middleware\Authenticate'], function () {
    Route::post('bot/saveFileModal/{id}', 'Bot\BotHeaderController@saveFileModal')->name('bot.saveFileModal');
    Route::get('bot/addDetalles/{id}', 'Bot\BotHeaderController@addDetalles')->name('bot.addDetalles');
    Route::get('bot/showHistorialApi/{id}', 'Bot\BotHeaderController@showHistorialApi')->name('bot.showHistorialApi');
    Route::get('bot/showIntenciones/{id}', 'Bot\BotHeaderController@showIntenciones')->name('bot.showIntenciones');
    Route::get('bot/showHistorial/{id}', 'Bot\BotHeaderController@showHistorial')->name('bot.showHistorial');
    Route::post('bot/crearProximoMensaje', 'Bot\BotHeaderController@crearProximoMensaje')->name('bot.crearProximoMensaje');
    Route::post('bot/verIntencionSeleccionada', 'Bot\BotHeaderController@verIntencionSeleccionada')->name('bot.verIntencionSeleccionada');
    Route::post('bot/verDetalleIntencion', 'Bot\BotHeaderController@verDetalleIntencion')->name('bot.verDetalleIntencion');
    Route::post('bot/createPagoKushki', 'Bot\BotHeaderController@createPagoKushki')->name('bot.createPagoKushki');
    Route::post('bot/createEnvioInmediato', 'Bot\BotHeaderController@createEnvioInmediato')->name('bot.createEnvioInmediato');
    Route::post('bot/createFechaAgenda', 'Bot\BotHeaderController@createFechaAgenda')->name('bot.createFechaAgenda');
    Route::get('bot/showDetail/{id}', 'Bot\BotHeaderController@showDetail')->name('bot.showDetail');
    Route::post('bot/saveFile/{detail}', 'Bot\BotHeaderController@saveFile')->name('bot.saveFile');
    Route::post('bot/createSmartLinkHistorialApi', 'Bot\BotHeaderController@createSmartLinkHistorialApi')->name('bot.createSmartLinkHistorialApi');
    Route::get('bot/showHeader/{id}', 'Bot\BotHeaderController@showHeader')->name('bot.showHeader');
    Route::get('bot/showParametersApi/{id}', 'Bot\BotHeaderController@showParametersApi')->name('bot.showParametersApi');
    Route::delete('bot/desactivarBot/{id}', 'Bot\BotHeaderController@desactivarBot')->name('bot.desactivarBot');
    Route::post('bot/createHistorialResponsePersonal', 'Bot\BotHeaderController@createHistorialResponsePersonal')->name('bot.createHistorialResponsePersonal');
    Route::post('bot/createHistorialMSP', 'Bot\BotHeaderController@createHistorialMSP')->name('bot.createHistorialMSP');
    Route::delete('bot/deleteHistorialMSP/{id}', 'Bot\BotHeaderController@deleteHistorialMSP')->name('bot.deleteHistorialMSP');
    Route::put('bot/editHistorialMSP/{id}', 'Bot\BotHeaderController@editHistorialMSP')->name('bot.editHistorialMSP');
    Route::post('bot/createHeader', 'Bot\BotHeaderController@createHeader')->name('bot.createHeader');
    Route::put('bot/updateHeader', 'Bot\BotHeaderController@updateHeader')->name('bot.updateHeader');
    Route::post('bot/createDisabledHistorialApi', 'Bot\BotHeaderController@createDisabledHistorialApi')->name('bot.createDisabledHistorialApi');
    Route::get('bot/showApis/{company}/{api}', 'Bot\BotHeaderController@showApis')->name('bot.showApis');
    Route::post('bot/updateOption', 'Bot\BotHeaderController@updateOption')->name('bot.updateOption');
    Route::post('bot/mensajeCierre', 'Bot\BotHeaderController@mensajeCierre')->name('bot.mensajeCierre');
    Route::post('bot/envioAgent', 'Bot\BotHeaderController@envioAgent')->name('bot.envioAgent');
    Route::post('bot/envioBack', 'Bot\BotHeaderController@envioBack')->name('bot.envioBack');
    Route::post('bot/envioHomePrincipal', 'Bot\BotHeaderController@envioHomePrincipal')->name('bot.envioHomePrincipal');
    Route::post('bot/envioHome', 'Bot\BotHeaderController@envioHome')->name('bot.envioHome');
    Route::post('bot/envioInmediato', 'Bot\BotHeaderController@envioInmediato')->name('bot.envioInmediato');
    Route::post('bot/createHistorialApi', 'Bot\BotHeaderController@createHistorialApi')->name('bot.createHistorialApi');
    Route::post('bot/createHistorial', 'Bot\BotHeaderController@createHistorial')->name('bot.createHistorial');
    Route::delete('bot/deleteHistorial/{id}', 'Bot\BotHeaderController@deleteHistorial')->name('bot.deleteHistorial');
    Route::put('bot/editHistorial/{id}', 'Bot\BotHeaderController@editHistorial')->name('bot.editHistorial');
    Route::get('bot/showOption/{id}', 'Bot\BotHeaderController@showOption')->name('bot.showOption');
    Route::resource('bot', 'Bot\BotHeaderController');
});

//CHATBOT
Route::group(['middleware' => 'App\Http\Middleware\Authenticate'], function () {
    Route::get('chatbot/showMapa/{id}', 'ChatBot\ChatBotController@showMapa')->name('chatbot.showMapa');
    Route::get('chatbot/showConversation/{code}', 'ChatBot\ChatBotController@showConversation')->name('chatbot.showConversation');
    Route::resource('chatbot', 'ChatBot\ChatBotController');
});

//APIHEADER
Route::group(['middleware' => 'App\Http\Middleware\Authenticate'], function () {
    Route::post('apiheader/updateApi/{id}', 'ApiHeader\ApiHeaderController@updateApi')->name('apiheader.updateApi');
    Route::get('apiheader/showApi/{id}', 'ApiHeader\ApiHeaderController@showApi')->name('apiheader.showApi');
    Route::post('apiheader/saveIntention', 'ApiHeader\ApiHeaderController@saveIntention')->name('apiheader.saveIntention');
    Route::get('apiheader/showIntention/{api}/{compa}', 'ApiHeader\ApiHeaderController@showIntention')->name('apiheader.showIntention');
    Route::delete('apiheader/deleteApi/{id}', 'ApiHeader\ApiHeaderController@deleteApi')->name('apiheader.deleteApi');
    Route::delete('apiheader/deleteCol/{id}', 'ApiHeader\ApiHeaderController@deleteCol')->name('apiheader.deleteCol');
    Route::delete('apiheader/deleteParam/{id}', 'ApiHeader\ApiHeaderController@deleteParam')->name('apiheader.deleteParam');
    Route::post('apiheader/agregarParameters', 'ApiHeader\ApiHeaderController@agregarParameters')->name('apiheader.agregarParameters');
    Route::post('apiheader/agregarCampo', 'ApiHeader\ApiHeaderController@agregarCampo')->name('apiheader.agregarCampo');
    Route::get('apiheader/agregarApis/{company}/{sistema}', 'ApiHeader\ApiHeaderController@agregarApis')->name('apiheader.agregarApis');
    Route::get('apiheader/showParameters/{code}/{compa}', 'ApiHeader\ApiHeaderController@showParameters')->name('apiheader.showParameters');
    Route::resource('apiheader', 'ApiHeader\ApiHeaderController');
});

//INTENTION
Route::group(['middleware' => 'App\Http\Middleware\Authenticate'], function () {
    Route::resource('intention', 'BotIntention\BotIntentionController');
});

//PAGOS
Route::group(['middleware' => 'App\Http\Middleware\Authenticate'], function () {
    Route::resource('pagos', 'Pagos\PagosController');
});

//MENSAJERIA MASIVA
Route::group(['middleware' => 'App\Http\Middleware\Authenticate'], function () {
    Route::post('massive/cargarArchivo', 'Masivo\MasivoController@cargarArchivo')->name('masivo.cargarArchivo');
    Route::resource('massive', 'Masivo\MasivoController');
});

//AGENT
Route::group(['middleware' => 'App\Http\Middleware\Authenticate'], function () {
    Route::put('agent/aceptarPedido/{id}', 'Agent\AgentController@aceptarPedido')->name('agent.aceptarPedido');
    Route::get('agent/cargarTabla', 'Agent\AgentController@cargarTabla')->name('agent.cargarTabla');
    Route::put('agent/updateCategory/{id}', 'Agent\AgentController@updateCategory')->name('agent.updateCategory');
    Route::get('agent/countMenssage/{id}', 'Agent\AgentController@countMenssage')->name('agent.countMenssage');
    Route::put('agent/updateConfig', 'Agent\AgentController@updateConfig')->name('agent.updateConfig');
    Route::post('agent/sendWhatsappAgente', 'Agent\AgentController@sendWhatsappAgente')->name('agent.sendWhatsappAgente');
    Route::get('agent/showConversation/{code}', 'Agent\AgentController@showConversation')->name('agent.showConversation');
    Route::resource('agent', 'Agent\AgentController');
});

//CATEGORY MESSAGE
Route::group(['middleware' => 'App\Http\Middleware\Authenticate'], function () {
    Route::resource('categorychat', 'CategoryChat\CategoryChatController');
});

//****** WEBHOOKS ******//
Route::post('webhooks', 'Webhook\WebhooksController@webhooks');
Route::post('webhookstwilio', 'Webhook\WebhooksTwilioController@webhookstwilio');
Route::post('webhookskushki', 'Webhook\WebhooksKushkiController@webhookskushki');
//**** FIN WEBHOOKS ****//

//Webhook test orion
Route::post('webhookorion', 'Webhook\WebhooksOrionController@webhookorion');
