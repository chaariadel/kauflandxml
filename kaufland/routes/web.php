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


//Route::resource('Info-fournisseur','InfoFournisseursController');

 Route::fallback(function ()
{
    return redirect()->route('acceuil'); // or redirect()->url('home')
});
Route::match(['get', 'post'],'/acceuil',"UserAdminController@acceuil")->name('acceuil');

Route::match(['get', 'post'],'Admin/Ajouter_admin', "UserAdminController@Ajoutadmin")->name('Ajoutadmin');
Route::match(['get', 'post'],'Admin/Modifier_admin', "UserAdminController@Modifieradmin")->name('Modifieradmin');
Route::match(['get', 'post'],'Admin/Admin_modifier', "UserAdminController@AdminModifier")->name('AdminModifier');
Route::match(['get', 'post'],'Admin/Admin_view', "UserAdminController@Adminview")->name('Adminview');
Route::match(['get', 'post'],'Admin/Admin_destroy', "UserAdminController@destroyAdmin")->name('destroyAdmin');
Route::match(['get', 'post'],'Admin/Ajout_admin', "UserAdminController@createadmin")->name('createadmin');
Route::match(['get', 'post'],'Admin/liste_admin', "UserAdminController@listadmin")->name('listadmin');


Route::match(['get', 'post'],'Ajout_XML', "XMLController@AjoutXML")->name('AjoutXML');
Route::match(['get', 'post'],'XML', "XMLController@importXml")->name('importXml');
Route::match(['get', 'post'],'XML1', "XMLController@importXml1")->name('importXml1');
Route::match(['get', 'post'],'listexml', "XMLController@listexml")->name('listexml');
Route::match(['get', 'post'],'Source_List', "XMLController@showSources")->name('showSources');
Route::post('/convert-and-download-xml-All', 'XMLController@convertAndDownloadXmlAll')->name('convertAndDownloadXmlAll');
Route::post('/convert-and-download-xml', 'XMLController@convertAndDownloadXml')->name('convertAndDownloadXml');
Route::post('/convert-and-download-csv', 'XMLController@convertAndDownloadCsv')->name('convertAndDownloadCsv');
Route::post('/convert-and-download-pdf', 'XMLController@convertAndDownloadPdf')->name('convertAndDownloadPdf');
Route::match(['get', 'post'],'/show-feed-data', 'XMLController@showFeedData')->name('showFeedData');


Auth::routes();

Route::get('/',"Auth\LoginController@showAdminLoginForm")->name('/');
Route::get('/register/admin',"Auth\RegisterController@showAdminRegisterForm")->name('register/admin');
Route::post('/login/admin',"Auth\LoginController@adminLogin");
Route::post('/register/admin', "Auth\RegisterController@createAdmin");





