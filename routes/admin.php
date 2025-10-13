<?php



use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BasicInfoController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ChildCategoryController;
use App\Http\Controllers\Admin\ChinaMigrationController;
use App\Http\Controllers\Admin\CollisionController;
use App\Http\Controllers\Admin\CommunityController;
use App\Http\Controllers\Admin\ContemporaryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GeographyController;
use App\Http\Controllers\Admin\HistoryController;
use App\Http\Controllers\Admin\LiveController;
use App\Http\Controllers\Admin\ModernController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\PoliticalController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\TechnologyController;
use App\Http\Controllers\Admin\TraditionController;

Route::prefix('admin')->name('admin.')->group(function () {
    //Auth
    Route::get('/login', [AdminAuthController::class, 'create'])->name('login');

    Route::post('/login', [AdminAuthController::class, 'store']);
});

Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {

    //Logout
    Route::post('/logout', [AdminAuthController::class, 'destroy'])->name('logout');

    //Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //Admin
    Route::resource('/admins', AdminController::class)->names('admin');
    Route::post('/change-admin-status', [AdminController::class, 'changeAdminStatus'])->name('admin.status');

    //Role
    Route::resource('/roles', RoleController::class)->names('role');
    Route::get('/assign-permission-page/{id}', [RoleController::class, 'assignPermissionsToRolePage'])->name('role.assign-permissions-page');
    Route::put('role/{id}/permission/update', [RoleController::class, 'assignPermissionsToRole'])->name('role.assign-permission-update');

    //Permission
    Route::resource('/permissions', PermissionController::class)->names('permission');

    //Category
    Route::resource('/categories', CategoryController::class)->names('category');
    Route::post('/class/change-status', [CategoryController::class, 'changeCategoryStatus'])->name('category.status');
    Route::post('/class/change-front-status', [CategoryController::class, 'changeFrontCategoryStatus'])->name('front-category.status');

    //slider & banner
    Route::resource('/sliders', SliderController::class)->names('slider');

    //Contents
    Route::resource('/geographies', GeographyController::class)->names('geography');
    Route::resource('/history', HistoryController::class)->names('history');
    Route::resource('/collisions', CollisionController::class)->names('collision');
    Route::resource('/lives', LiveController::class)->names('live');
    Route::resource('/migrations', ChinaMigrationController::class)->names('migration');
    Route::resource('/politicals', PoliticalController::class)->names('political');
    Route::resource('/technologies', TechnologyController::class)->names('technology');
    Route::resource('/communities', CommunityController::class)->names('community');
    Route::resource('/moderns', ModernController::class)->names('modern');
    Route::resource('/traditions', TraditionController::class)->names('tradition');
    Route::resource('/contemporaries', ContemporaryController::class)->names('contemporary');

    //Settings
    Route::resource('/basic-infos', BasicInfoController::class)->names('basic-info');
    Route::resource('/pages', PageController::class)->names('page');




});
