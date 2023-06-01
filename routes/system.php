<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth:admin', 'as' => 'system.'], function () {
//General
    Route::get('change-language/{lang}', [App\Http\Controllers\Backend\LanguageController::class, 'switchLang'])->name('switchLang');
    Route::get('/', [App\Http\Controllers\Backend\HomeController::class, 'index'])->name('index');
    Route::get('dashboard', [App\Http\Controllers\Backend\HomeController::class, 'index'])->name('dashboard');
    Route::get('reports', [\App\Http\Controllers\Backend\System\ReportController::class, 'index'])->name('report');
    Route::get('give-permission', [\App\Http\Controllers\Backend\System\PermissionController::class, 'givePermission'])->name('givePermission');
    Route::get('give-permission-to-user/{user}', [\App\Http\Controllers\Backend\System\PermissionController::class, 'giveUserPermission'])->name('giveUserPermission');
    Route::get('contact-us/{id}/read', [App\Http\Controllers\Backend\ContactController::class, 'readContact'])->name('readContact');
    Route::post('give-permission-to-user-update', [\App\Http\Controllers\Backend\System\PermissionController::class, 'giveUserPermissionUpdate'])->name('givePermissionUserUpdate');
    Route::get('slider/{id}/change-order', [App\Http\Controllers\Backend\SliderController::class, 'sliderOrder'])->name('sliderOrder');
    Route::get('newsletter/history', [App\Http\Controllers\Backend\NewsletterController::class, 'newsletterHistory'])->name('newsletterHistory');
    Route::get('delete/photo/{model}/{id}', [\App\Http\Controllers\Backend\HomeController::class, 'deletePhoto'])->name('deletePhoto');
    Route::group(['name' => 'status'], function () {
        Route::get('general/{id}/change-status', [App\Http\Controllers\Backend\GeneralController::class, 'status'])->name('generalStatus');
        Route::get('/site-language/{id}/change-status', [\App\Http\Controllers\Backend\System\SiteLanguageController::class, 'siteLanStatus'])->name('site-languagesStatus');
        Route::get('/settings/{id}/change-status', [App\Http\Controllers\Backend\SettingController::class, 'status'])->name('settingsStatus');
        Route::get('/seo/{id}/change-status', [App\Http\Controllers\Backend\MetaController::class, 'seoStatus'])->name('seoStatus');
        Route::get('/permissions/{id}/change-status', function () {
            return redirect()->back();
        })->name('permissionsStatus');
    });
    Route::group(['name' => 'delete'], function () {
        Route::get('/site-languages/{id}/delete', [\App\Http\Controllers\Backend\System\SiteLanguageController::class, 'delSiteLang'])->name('site-languagesDelete');
        Route::get('/contact-us/{id}/delete', [App\Http\Controllers\Backend\ContactController::class, 'delContactUS'])->name('delContactUS');
        Route::get('/settings/{id}/delete', [App\Http\Controllers\Backend\SettingController::class, 'delete'])->name('settingsDelete');
        Route::get('/users/{id}/delete', [App\Http\Controllers\Backend\AdminController::class, 'delAdmin'])->name('delAdmin');
        Route::get('/seo/{id}/delete', [App\Http\Controllers\Backend\MetaController::class, 'delSeo'])->name('delSeo');
        Route::get('/report/{id}/delete', [\App\Http\Controllers\Backend\System\ReportController::class, 'delReport'])->name('delReport');
        Route::get('/report/clean-all', [\App\Http\Controllers\Backend\System\ReportController::class, 'cleanAllReport'])->name('cleanAllReport');
        Route::get('/permission/{id}/delete', [\App\Http\Controllers\Backend\System\PermissionController::class, 'delete'])->name('permissionsDelete');
        Route::get('/newsletter/{id}/delete', [App\Http\Controllers\Backend\NewsletterController::class, 'delNewsletter'])->name('delNewsletter');
    });
    Route::group(['name' => 'resource'], function () {
        Route::resource('/site-languages', \App\Http\Controllers\Backend\System\SiteLanguageController::class);
        Route::resource('/contact-us', App\Http\Controllers\Backend\ContactController::class);
        Route::resource('/about', App\Http\Controllers\Backend\AboutController::class);
        Route::resource('/settings', App\Http\Controllers\Backend\SettingController::class);
        Route::resource('/users', App\Http\Controllers\Backend\AdminController::class);
        Route::resource('/informations', \App\Http\Controllers\Backend\System\InformationController::class);
        Route::resource('/seo', App\Http\Controllers\Backend\MetaController::class);
        Route::resource('/newsletter', App\Http\Controllers\Backend\NewsletterController::class);
        Route::resource('/permissions', \App\Http\Controllers\Backend\System\PermissionController::class);
    });
});
Route::fallback(function () {
    return view('backend.errors.404');
});
Route::group(['name' => 'auth'], function () {
    Route::get('/login', [\App\Http\Controllers\Backend\System\AuthController::class, 'showLoginForm'])->name('login');
    Route::post('loginAdmin', [\App\Http\Controllers\Backend\System\AuthController::class, 'login'])->name('loginPost');
    Route::get('logout', [\App\Http\Controllers\Backend\System\AuthController::class, 'logout'])->name('logout');
});
