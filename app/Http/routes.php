<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/', 'HomeController@index');


Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);





//Route::get('/', 'DashboardController@index');


Route::group(['prefix'=>'admin', 'namespace'=>'Admin'], function() {
    Route::pattern('id', '[0-9]+');

    Route::get('/', 'DashboardController@index');

    # Category
    Route::get('category', 'CategoryController@index');
    Route::get('category/create', 'CategoryController@getCreate');
    Route::post('category/create', 'CategoryController@postCreate');
    Route::get('category/{id}/edit', 'CategoryController@getEdit');
    Route::post('category/edit', 'CategoryController@postEdit');
    Route::post('category/delete', 'CategoryController@postDelete');
    Route::post('category/reorder', 'CategoryController@postReorder');
    Route::post('category/deleteall', 'CategoryController@postDeleteAll');

    # Conjobs
    Route::get('cronone', 'CronjobController@getCronOne');
    Route::post('cronone', 'CronjobController@postCronOne');
    Route::get('cronjob', 'CronjobController@getCronJob');
    Route::post('cronjob', 'CronjobController@postCronJob');
    Route::post('cronsession', 'CronjobController@postCronSession');

    Route::get('download', 'CronjobController@getCronDownload');
    Route::post('download', 'CronjobController@postCronDownload');
    Route::post('downloadsession', 'CronjobController@postCronDownloadSession');



    Route::get('downloadftp', 'CronjobController@getCronDownloadFTP');
     Route::post('downloadsftp', 'CronjobController@postCronDownloadFTP');
     Route::post('downloadsessionftp', 'CronjobController@postCronDownloadSessionFTP');


    Route::get('checkversion', 'CronjobController@getCheckVersion');
    Route::post('checkversion', 'CronjobController@postCheckVersion');
    Route::post('checkversionsession', 'CronjobController@postCheckVersionSession');


    Route::get('checkversion2', 'CronjobController@getCheckVersion2');
    Route::post('checkversion2', 'CronjobController@postCheckVersion2');
    Route::post('checkversionsession2', 'CronjobController@postCheckVersionSession2');

    Route::get('similar', 'CronjobController@getCronSimilar');
    Route::post('similar', 'CronjobController@postCronSimilar');
    Route::post('similarsession', 'CronjobController@postCronSimilarSession');



    # Facebook
    Route::get('facebook', 'FacebookController@index');
    Route::post('facebook', 'FacebookController@postSaveFacebook');
    Route::get('facebook/getfbtoken', 'FacebookController@getFacebookToken');


    # No Download Link
    Route::get('nodllink', 'VersionController@getNoDownloadLink');

    # App
    Route::get('app', 'AppController@index');
    Route::get('app/create', 'AppController@getCreate');
    Route::post('app/create', 'AppController@postCreate');
    Route::get('app/{id}/edit', 'AppController@getEdit');
    Route::post('app/edit', 'AppController@postEdit');
    Route::post('app/delete', 'AppController@postDelete');
    Route::post('app/deleteall', 'AppController@postDeleteAll');
    
    Route::get('user', 'UserController@index');
    Route::get('user/create', 'UserController@getCreate');
    Route::post('user/create', 'UserController@postCreate');
    Route::get('user/{id}/edit', 'UserController@getEdit');
    Route::get('user/getReferral/{id}', 'UserController@getReferral');
    Route::post('user/edit', 'UserController@postEdit');
    Route::post('user/delete', 'UserController@postDelete');
    Route::post('user/deleteall', 'UserController@postDeleteAll');

    # Version
    Route::get('app/{id}/version', 'VersionController@index');
    Route::get('app/{id}/version/create', 'VersionController@getCreate');
    Route::post('app/{id}/version/create', 'VersionController@postCreate');
    Route::get('app/{id}/version/{versionid}/edit', 'VersionController@getEdit');
    Route::post('app/{id}/version/edit', 'VersionController@postEdit');
    Route::post('app/{id}/version/delete', 'VersionController@postDelete');
    Route::post('app/version/delete', 'VersionController@postDelete');
    Route::post('app/{id}/version/deleteall', 'VersionController@postDeleteAll');
    Route::post('app/version/fix', 'VersionController@postFix');
    Route::post('app/active', 'AppController@postActive');



    Route::post('api/publish', 'ApiController@postPublish');

    Route::get('settings/config', 'SettingController@index');
    Route::post('settings/config', 'SettingController@postSave');


    # Report
    Route::get('report', 'VersionController@showReport');

    # Page
    Route::get('pages', 'PageController@index');
    Route::get('pages/create', 'PageController@getCreate');
    Route::post('pages/create', 'PageController@postCreate');
    Route::get('pages/{id}/edit', 'PageController@getEdit');
    Route::post('pages/edit', 'PageController@postEdit');
    Route::post('pages/delete', 'PageController@postDelete');
    Route::post('pages/deleteall', 'PageController@postDeleteAll');

    # Contact
    Route::get('contact', 'ContactController@index');
    Route::get('contact/{id}', 'ContactController@showContact');
    Route::post('contact/delete', 'ContactController@postDelete');
    Route::post('contact/deleteall', 'ContactController@postDeleteAll');

});

Route::post('download-apk/{verslug}', 'HomeController@postDownloadApk');

Route::get('contact-us', 'HomeController@showContactPage');
Route::post('contact-us', 'HomeController@postContactPage');
Route::get('search', 'HomeController@getSearch');
Route::get('search/apprequest', 'HomeController@getAppRequest');
Route::get('sitemap.xml', 'HomeController@sitemap');
Route::get('sitemap-app.xml', 'HomeController@sitemapApp');
Route::get('sitemap-app-apk.xml', 'HomeController@sitemapAppApk');
Route::get('sitemap-download.xml', 'HomeController@sitemapDownload');
Route::get('sitemap-version.xml', 'HomeController@sitemapVersion');
Route::get('sitemap-version-apk.xml', 'HomeController@sitemapVersionApk');
Route::get('sitemap-version-download.xml', 'HomeController@sitemapVersionDownload');
Route::get('sitemap-category.xml', 'HomeController@sitemapCategory');
Route::get('sitemap-developer.xml', 'HomeController@sitemapDeveloper');
Route::get('sitemap-page.xml', 'HomeController@sitemapPage');

Route::get('cron/facebook', 'HomeController@cronFacebook');



Route::get('user/login', 'UserController@loginForm');
Route::post('user/login', 'UserController@login');
Route::get('user/logout', 'UserController@logout');
Route::get('user/login', 'UserController@loginForm');
Route::any('user/register', 'UserController@registerForm');
Route::get('r/{referralKey}', 'UserController@registerForm');
Route::post('user/register/{$referralKey}', 'UserController@register');
Route::get('user/forgot', 'UserController@forgotForm');
Route::post('user/reset', 'UserController@forgotPasswordPost');
Route::get('user/reset', 'UserController@resetPassword');
Route::get('user/profile', 'UserController@profileForm');
Route::post('user/profile', 'UserController@profilePost');
Route::post('user/password', 'UserController@passwordPost');
Route::post('user/forgotPassword', 'UserController@forgotPasswordPost');
Route::get('user/referral', 'UserController@referralForm');






Route::get('{slug1}', 'HomeController@checkAndShow1');
Route::get('manufacture/{devslug}', 'HomeController@showDeveloper');
Route::get('page/{pageslug}', 'HomeController@showPage');
Route::get('android-apps-games/{slug1}/{slug2}', 'HomeController@checkAndShowApp');

Route::get('{slug1}/{slug2}', 'HomeController@checkAndShow2');
Route::get('android-apps-games/{slug1}/{slug2}/{slug3}', 'HomeController@checkAndShow3');

Route::get('page/{pageslug}', 'HomeController@showPage');
Route::post('api/rating', 'HomeController@postRating');
Route::post('api/report', 'HomeController@postReport');

Route::get('contact-us', 'HomeController@showContactPage');
Route::post('contact-us', 'HomeController@postContactPage');





