<?php

use Illuminate\Http\Request;


Route::middleware('auth:api')->get('/user', function (Request $request) {
  return $request->user();
});

//API enviar notificaciones
Route::post('/sendInformationIntel/{instance}/{token}', 'Api\ApiController@sendInformationIntel');
//API mostrar Planes
Route::post('/showPlans', 'Api\ApiController@showPlans');
//API apeturar Plan
Route::post('/openPlan', 'Api\ApiController@openPlan');
//API mostrar Campanias
Route::post('/indexCampania', 'Api\ApiController@indexCampania');
//API SEND WHATSAPP EXPRESS
Route::post('/sendWhatsapp/{instance}/{token}', 'Api\ApiWhatsappController@sendWhatsapp');
Route::post('/sendWhatsapp2', 'Api\ApiWhatsappController@sendWhatsapp2');
//API Save customer crm
Route::post('/saveCustomerCrm', 'Api\ApiCustomer@saveCustomerCrm');
//API Save Atention crm
Route::post('/saveAtentionCrm', 'Api\ApiCustomer@saveAtentionCrm');
Route::post('/saveAtentionDetailCrm', 'Api\ApiCustomer@saveAtentionDetailCrm');
Route::post('/saveMedicamentoCrm', 'Api\ApiCustomer@saveMedicamentoCrm');
//Api save Dcotor Schedule from CRM
Route::post('/saveDoctorScheduleCrm', 'Api\ApiCustomer@saveDoctorScheduleCrm');
//Api Hooks recieve whatsapp test
// Route::post('/showWebHookCrm', 'Api\ApiWebhook@showWebHookCrm');

//****************************** Api CRM ******************************//
Route::post('/showApiMaster', 'Api\ApiCRM@showApiMaster');
Route::post('/showApiMasterRefresh', 'Api\ApiCRM@showApiMasterRefresh');
Route::post('/showApiMasterRefreshLocation', 'Api\ApiCRM@showApiMasterRefreshLocation');
Route::post('/showApiMasterCreate', 'Api\ApiCRM@showApiMasterCreate');
//API, para crear clientes coninformacion del MSP o devolver si existe en la base
Route::post('/showApiCustomerCRM', 'Api\ApiCRM@showApiCustomerCRM');
//API, para insertar Datos en una Tabla desde las configuraciones
Route::post('/saveApiInformation', 'Api\ApiCRM@saveApiInformation');
//****************************** Fin Api CRM ******************************//

//****************************** Api TEST ******************************//
Route::post('/showTest', 'Api\ApiCRM@showTest');
//****************************** Api TEST ******************************//


//****************************** Api TEST ******************************//
Route::post('/miPrimerCrud', 'Api\ApiMiPrimerCrud@miPrimerCrud');
//****************************** Api TEST ******************************//

//****************************** Api CREAR PACIENTE ******************************//
Route::post('/createPacientCrm', 'Api\ApiCreatePacientCrm@createPacientCrm');
//****************************** Api TEST ****************************************//

//****************************** Api SIGCENTER CONGIF CRM ******************************//
Route::post('/guardarEmpresa', 'Api\ApiSigcenter@guardarEmpresa');
Route::post('/guardarSede', 'Api\ApiSigcenter@guardarSede');

Route::get('/showCity', 'Api\ApiSigcenter@showCity');
//****************************** Api SIGCENTER CONGIF CRM ******************************//

//****************************** Api Envios ******************************//
Route::post('/showEnviosHeader', 'Api\ApiEnvios@showEnviosHeader');
Route::post('/showEnviosDetail', 'Api\ApiEnvios@showEnviosDetail');
Route::post('/guardarEnvios', 'Api\ApiEnvios@guardarEnvios');
Route::post('/enviosInmediatos', 'Api\ApiEnvios@enviosInmediatos');
Route::post('/refreshStatus', 'Api\ApiEnvios@refreshStatus');
//****************************** Api Envios ******************************//