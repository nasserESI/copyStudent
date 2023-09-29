<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\courseController;
use App\Http\Controllers\CopyController;
use App\Http\Controllers\EncryptionController;
use App\Models\Copy;
use App\Models\User;
use App\Models\Course;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FichierController;
use App\Http\Controllers\RegistrationController;
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

Route::get('/', function () {

    return view('welcome');
});

Route::get('/dashboard', function () {
    $users = User::where('admincheck', 0)
        ->whereIn('role', ['teacher', 'admin'])
        ->get();


    $courses = Course::all();
    $copies = Copy::all();
    $tests = Copy::where('student',auth()->user()->name)->get();
    return view('dashboard',['users'=>$users,'courses'=>$courses,'copies'=>$copies,'tests'=>$tests]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::group(['middleware' => 'admin'], function () {
    Route::controller(RegistrationController::class)->group(function () {
        Route::post('/dashboard/{user1}', 'accept')->name('accept');
        Route::post('/dashboard/{user}', 'refuse')->name('refuse');
    });
    Route::controller(courseController::class)->group(function(){
        Route::put('/dashboard', 'addCourse')->name('addcourse');
        Route::delete('/dashboard/{id}', 'removeCourse')->name('removecourse');
    });
});
Route::controller(CopyController::class)->group(function(){
    Route::group(['middleware' => 'teacher'], function () {
        //Route::get('/index/copies/{id}','telechargerFichier')->name('telecharger.fichier');
        Route::get('/role/teacher', 'index')->name('copies.index')->middleware('teacher');
        Route::delete('/role/teacher/{id}', 'destroy')->name('copies.destroy')->middleware('teacher');
        Route::post('/dashboard', 'store')->name('copies.store')->middleware('teacher');
        Route::post('/teacher', 'chargerFichier')->name('upload.store')->middleware('teacher');
        Route::post('/index/edit','mark')->name('grade')->middleware('teacher');
    });
    Route::get('/index/copies/{id}','telechargerFichier')->name('telecharger.fichier');
    Route::group(['middleware' => 'student'], function () {
        //Route::get('/index/copies/{id}','telechargerFichier')->name('telecharger.fichier');
        Route::get('student','studentWatching')->name('copystudent');
    });
});



    require __DIR__.'/auth.php';
