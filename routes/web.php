<?php

use App\Http\Controllers\Admin\FacilityController;
use App\Http\Controllers\Admin\GallaryController;
use App\Http\Controllers\Admin\SpecilistController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\TestimonialController;
use Illuminate\Support\Facades\Route;


Route::get('/', [PublicController::class, 'index'])->name('index');
Route::get('/about', [PublicController::class, 'aboutUs'])->name('about');
Route::get('/services', [PublicController::class, 'services'])->name('services');
Route::get('/service-details/{id}', [PublicController::class, 'servicesDetails'])->name('service-details');
Route::get('/speciality', [PublicController::class, 'speciality'])->name('speciality');
Route::get('/speciality-details', [PublicController::class, 'specialityDetails'])->name('speciality-details');
Route::get('/contact', [PublicController::class, 'contact'])->name('contact');
Route::get('/teams', [PublicController::class, 'teams'])->name('teams');
Route::get('/team-details/{id}', [PublicController::class, 'teamDetails'])->name('team-details');
Route::get('/gallery', [PublicController::class, 'gallery'])->name('gallery');
Route::get('/booking', [PublicController::class, 'booking'])->name('booking');

Route::post('/book-appointment', [PublicController::class, 'BookAppointment'])->name('BookAppointment');
Route::post('/customerQuery', [PublicController::class, 'customerQuery'])->name('customerQuery');

Route::prefix('dashboard')->middleware(['auth', 'verified'])->group(function () {
Route::get('/', [DashboardController::class, 'Index'])->name('dashboard');
    //role & permission
    Route::group(['middleware' => ['role:Super Admin']], function () {

        Route::get('create-role', [RolePermissionController::class, 'getRole'])->name('getRole');
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

    //specialists
    Route::get('department-lists', [SpecilistController::class, 'indexDepartment'])->name('indexDepartment');
    Route::post('department-lists', [SpecilistController::class, 'storeDepartment'])->name('storeDepartment');
    //specialists

    Route::get('specialist-lists', [SpecilistController::class, 'index'])->name('SpecialistLists');
    Route::get('specialist-details', [SpecilistController::class, 'SpecialistDetails'])->name('SpecialistDetails');
    Route::post('specialist-lists', [SpecilistController::class, 'store'])->name('SubmitSpecialist');
    Route::post('edit-specialist-lists', [SpecilistController::class, 'edit'])->name('EditSpecialist');

    //Facilities
    Route::get('facility-lists', [FacilityController::class, 'index'])->name('FacilityLists');
    Route::post('facility-lists', [FacilityController::class, 'store'])->name('SubmitFacility');
    Route::get('facility-details', [FacilityController::class, 'FacilityDetails'])->name('FacilityDetails');
    Route::post('edit-facility-lists', [FacilityController::class, 'edit'])->name('EditFacility');
    //Facilities

    //Gallary 
    Route::get('add-gallary', [GallaryController::class, 'index'])->name('getGallary');
    Route::post('add-gallary', [GallaryController::class, 'store'])->name('createGallary');
    Route::get('gallary-lists', [GallaryController::class, 'show'])->name('galleryLists');
    Route::post('delete-gallary', [GallaryController::class, 'destroy'])->name('destroyGallery');
    //Gallary 

    //testimonial  
    Route::get('add-testimonials', [TestimonialController::class, 'GetTestimonials'])->name('GetTestimonials');
    Route::post('add-testimonials', [TestimonialController::class, 'AddTestimonials'])->name('AddTestimonials');
    Route::get('testimonial-lists', [TestimonialController::class, 'TestimonialList'])->name('TestimonialList');
    Route::post('close-testimonial-list', [TestimonialController::class, 'closeTestimonialList'])->name('closeTestimonialList');
    //testimonial  

    //faq  
    Route::get('add-faq', [FaqController::class, 'GetFaq'])->name('GetFaq');
    Route::post('add-faq', [FaqController::class, 'AddFaq'])->name('AddFaq');
    Route::get('faq-lists', [FaqController::class, 'FaqList'])->name('FaqList');
    Route::post('close-faq-list', [FaqController::class, 'closeFaq'])->name('closeFaq');
    //faq  

    //change status of the doctors, specialists, speciality...
    Route::post('change-status', [DashboardController::class, 'changeStatus'])->name('changeStatus');

    Route::get('reset-password', [ResetPasswordController::class, 'create'])
        ->name('passwordReset');
    Route::post('/password/change',  [ResetPasswordController::class, 'change'])->name('passwordChange');
});


require __DIR__ . '/auth.php';
