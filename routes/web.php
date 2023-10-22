<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'Cache cleared';
});

Route::middleware(['guest'])->group(function () {

    Route::middleware(['revalidate'])->group(function () {
        Route::controller(App\Http\Controllers\Admin\AuthController::class)->group(function () {
            Route::get('/', 'loginPage');
            Route::get('login' , 'loginPage')->name('login');
            Route::post('login' , 'login')->name('login-submit');
        });

        Route::controller(App\Http\Controllers\Admin\PasswordResetLinkController::class)->group(function () {
            Route::get('forgot-password', 'showLinkRequestForm')->name('password.request');
            Route::post('forgot-password-email', 'store')->name('password.email');
        });

        Route::controller(App\Http\Controllers\Admin\ForgotPasswordController::class)->group(function () {
            Route::get('reset-password/{token}', 'showResetPasswordForm')->name('reset.page');
            Route::post('reset-password', 'submitResetPasswordForm')->name('reset.submit');
        });
    });

    Route::group(['prefix'=>'patient','as'=>'patient.'], function(){
        Route::controller(App\Http\Controllers\Patient\AppointmentController::class)->group(function () {
            Route::get('appointment', 'index')->name('appointment.index');
            Route::post('appointment', 'store')->name('appointment.store');
        });
    });
});

Route::middleware(['auth','revalidate'])->group(function () {
    // Dashboard
    Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    // Clinic Routes
    Route::controller(App\Http\Controllers\Admin\ClinicController::class)->group(function () {
        Route::get('clinics/create', 'create')->name('clinics.create')->middleware('permission:can-add-clinic');
        Route::get('clinics', 'index')->name('clinics.index')->middleware('permission:can-view-clinic');
        Route::get('clinics/{clinic}', 'show')->name('clinics.show')->middleware('permission:can-view-clinic');
        Route::post('clinics', 'store')->name('clinics.store')->middleware('permission:can-add-clinic');
        Route::get('clinics/{clinic}/edit', 'edit')->name('clinics.edit')->middleware('permission:can-edit-clinic');
        Route::put('clinics/{clinic}/edit', 'update')->name('clinics.update')->middleware('permission:can-edit-clinic');
        Route::put('clinics/{clinic}/hide', 'hide')->name('clinics.hide')->middleware('permission:can-hide-clinic');
        Route::put('clinics/{clinic}/unhide', 'unHide')->name('clinics.unHide')->middleware('permission:can-hide-clinic');
    });


    // User Routes
    Route::controller(App\Http\Controllers\Admin\UserController::class)->group(function () {
        Route::get('users/create', 'create')->name('users.create')->middleware('permission:can-add-user');
        Route::get('users', 'index')->name('users.index')->middleware('permission:can-view-user');
        Route::get('users/{user}', 'show')->name('users.show')->middleware('permission:can-view-user');
        Route::post('users', 'store')->name('users.store')->middleware('permission:can-add-user');
        Route::get('users/{user}/edit', 'edit')->name('users.edit')->middleware('permission:can-edit-user');
        Route::put('users/{user}/edit', 'update')->name('users.update')->middleware('permission:can-edit-user');
        Route::put('users/{user}/changeStatus', 'changeStatus')->name('users.changeStatus')->middleware('permission:can-edit-user');
        Route::get('users/{id}/changePassword', 'changePasswordPage')->name('users.changePasswordPage')->middleware('permission:can-edit-user');
        Route::put('users/{id}/changePassword', 'changePassword')->name('users.changePassword')->middleware('permission:can-edit-user');
        Route::delete('users/{user}', 'destroy')->name('users.destroy')->middleware('permission:can-delete-user');
    });

    // User Profile Routes
    Route::controller(App\Http\Controllers\Admin\ProfileController::class)->group(function () {
        Route::get('profile', 'index')->name('profile.index')->middleware('permission:can-view-user');
        Route::put('profile/{id}/edit', 'update')->name('profile.update')->middleware('permission:can-edit-user');
        Route::put('profile/{id}/changePassword', 'changePassword')->name('profile.changePassword');
    });

    // Role Routes
    Route::controller(App\Http\Controllers\Admin\RoleController::class)->group(function () {
        Route::get('roles/create', 'create')->name('roles.create')->middleware('permission:can-add-role');
        Route::get('roles', 'index')->name('roles.index')->middleware('permission:can-view-role');
        Route::get('roles/{role}', 'show')->name('roles.show')->middleware('permission:can-view-role');
        Route::post('roles', 'store')->name('roles.store')->middleware('permission:can-add-role');
        Route::get('roles/{role}/edit', 'edit')->name('roles.edit')->middleware('permission:can-edit-role');
        Route::put('roles/{role}/edit', 'update')->name('roles.update')->middleware('permission:can-edit-role');
        Route::delete('roles/{role}', 'destroy')->name('roles.destroy')->middleware('permission:can-delete-role');
    });

    // Appointment Routes
    Route::controller(App\Http\Controllers\Admin\AppointmentController::class)->group(function () {
        Route::get('appointments', 'index')->name('appointments.index')->middleware('permission:can-view-appointment');
        Route::get('appointments/{appointment}', 'show')->name('appointments.show')->middleware('permission:can-view-appointment');
        Route::get('appointments/{appointment}/edit', 'edit')->name('appointments.edit')->middleware('permission:can-edit-appointment');
        Route::put('appointments/{appointment}/edit', 'update')->name('appointments.update')->middleware('permission:can-edit-appointment');
        Route::put('appointments/{id}/approve', 'approveAppointment')->name('appointments.approve')->middleware('permission:can-approve-appointment');
        Route::put('appointments/{id}/cancel', 'cancelAppointment')->name('appointments.cancel')->middleware('permission:can-cancel-appointment');
    });

    //Reset Tokens
    Route::controller(App\Http\Controllers\Admin\PasswordResetTokensController::class)->group(function () {
        Route::delete('tokens/{id}', 'destroy')->name('tokens.destroy')->middleware('permission:can-delete-token');
    });

    // Clinic Alert Routes
    Route::controller(App\Http\Controllers\Admin\ClinicAlertController::class)->group(function () {
        Route::get('clinic-alerts/create', 'create')->name('clinic-alerts.create')->middleware('permission:can-add-clinic-alert');
        Route::get('clinic-alerts', 'index')->name('clinic-alerts.index')->middleware('permission:can-view-clinic-alert');
        Route::get('clinic-alerts/{clinic_alert}', 'show')->name('clinic-alerts.show')->middleware('permission:can-view-clinic-alert');
        Route::post('clinic-alerts', 'store')->name('clinic-alerts.store')->middleware('permission:can-add-clinic-alert');
        Route::get('clinic-alerts/{clinic_alert}/edit', 'edit')->name('clinic-alerts.edit')->middleware('permission:can-edit-clinic-alert');
        Route::put('clinic-alerts/{clinic_alert}/edit', 'update')->name('clinic-alerts.update')->middleware('permission:can-edit-clinic-alert');
        Route::delete('clinic-alerts/{clinic_alert}', 'destroy')->name('clinic-alerts.destroy')->middleware('permission:can-delete-clinic-alert');
    });

    // Logout
    Route::post('logout' , [App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('logout');
});

