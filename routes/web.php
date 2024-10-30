<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\ClassCategoryController;
use App\Http\Controllers\Admin\ClassroomController;
use App\Http\Controllers\Admin\ManageUsersController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\It\ItDashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Student\StudentDashboardController;
use App\Http\Controllers\Teacher\TeacherController;
use App\Http\Controllers\Teacher\TeacherDashboardController;
use App\Models\ClassCategory;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin routes
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function (){
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::resource('student', StudentController::class);
    Route::resource('classroom', ClassroomController::class);
    Route::resource('class-category', ClassCategoryController::class);

    Route::get('manage-user', [ManageUsersController::class, 'index'])->name('admin.manageuser');
    Route::get('create-user', [ManageUsersController::class, 'create'])->name('admin.usercreate');
    Route::get('{user}/edit-user', [ManageUsersController::class, 'edit'])->name('admin.useredit');
    Route::put('{user}/edit-user', [ManageUsersController::class, 'update'])->name('admin.userupdate');
    Route::put('{user}/pwdreset-user', [ManageUsersController::class, 'userResetPassword'])->name('admin.pwdreset');
    Route::post('store-user', [ManageUsersController::class, 'store'])->name('admin.storeuser');
    Route::delete('{user}/delete-user', [ManageUsersController::class, 'destroy'])->name('admin.deleteuser');
    Route::get('/search', [StudentController::class, 'searchpage'])->name('search-student');
    Route::get('/search/class', [StudentController::class, 'searchclassform'])->name('search-class');
    Route::get('/search/class/result', [StudentController::class, 'searchclassresult'])->name('search-class-result');
});

// Teacher Routes
Route::middleware(['auth', 'role:teacher'])->group(function (){
    Route::get('/teacher/dashboard', [TeacherDashboardController::class, 'index'])->name('teacher.dashboard');
    Route::get('/teacher/profile', [ProfileController::class, 'edit'])->name('teacher.profile.edit');
});

// Student Routes
Route::middleware(['auth', 'role:student'])->group(function (){
    Route::get('/student/dashboard', [StudentDashboardController::class, 'index'])->name('student.dashboard');
});

// IT Routes
Route::middleware(['auth', 'it'])->group(function (){
    Route::get('/it/dashboard', [ItDashboardController::class, 'index'])->name('it.dashboard');
});
require __DIR__.'/auth.php';

