<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\RolePermissionController;
use Illuminate\Support\Facades\Route;


Route::get('/', [PublicController::class, 'index'])->name('index');
Route::post('customer-query', [PublicController::class, 'CustomerQuery'])->name('CustomerQuery');

Route::get('dashboard', [DashboardController::class, 'Index'])->name('dashboard');
Route::prefix('dashboard')->middleware(['auth', 'verified'])->group(function () {
    //role & permission
    Route::group(['middleware' => ['role:Super Admin']], function () {

        Route::get('create-role', [RolePermissionController::class, 'getRole'])->name('getRole');;
        Route::post('role', [RolePermissionController::class, 'addRole'])->name('addRole');
        Route::post('permission', [RolePermissionController::class, 'addPermission'])->name('addPermission');
        Route::get('assign-role', [RolePermissionController::class, 'getAssignRole'])->name('getAssignRole');
        Route::post('assign-role', [RolePermissionController::class, 'AssignRole'])->name('AssignRole');
        Route::get('assign-permission', [RolePermissionController::class, 'getAssignPermission'])->name('getAssignPermission');
        Route::post('assign-permission', [RolePermissionController::class, 'AssignPermission'])->name('AssignPermission');

        Route::get('ajax-role-lists/{id}', [RolePermissionController::class, 'getRoleAjaxList'])->name('getRoleAjaxList');
        Route::get('ajax-permission-lists/{id}', [RolePermissionController::class, 'getPermissionAjaxList'])->name('getPermissionAjaxList');

        //menu item
        Route::view('/add-menu-item', 'admin/AddMenuItems')->name('GetMenuItems');
        Route::post('add-menu-item', [MenuItemController::class, 'AddMenuItem'])->name('AddMenuItem');

        //sub item in the menu item
        Route::get('add-menu-sub-item-lists', [MenuItemController::class, 'GetMenuSubItems'])->name('GetMenuSubItems');
        Route::post('add-menu-sub-item', [MenuItemController::class, 'AddMenuSubItem'])->name('AddMenuSubItem');

        Route::get('menu-item-list', [MenuItemController::class, 'GetMenuISubtemList'])->name('GetMenuISubtemList');
        Route::get('getMeuSubItmDetail', [MenuItemController::class, 'getMeuSubItmDetail'])->name('getMeuSubItmDetail');
        Route::post('EditMenuItem', [MenuItemController::class, 'EditMenuItem'])->name('EditMenuItem');
        Route::get('mentu-list', [MenuItemController::class, 'getDropdownData'])->name('getDropdownData');




    });


    Route::get('reset-password', [ResetPasswordController::class, 'create'])
        ->name('passwordReset');
    Route::post('/password/change',  [ResetPasswordController::class, 'change'])->name('passwordChange');
});


require __DIR__ . '/auth.php';
