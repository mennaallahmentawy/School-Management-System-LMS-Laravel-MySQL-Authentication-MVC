<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Classrooms\ClassroomController;
use App\Http\Controllers\Grades\GradeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Questions\QuestionController;
use App\Http\Controllers\Quizzes\QuizzController;
use App\Http\Controllers\Sections\SectionController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\Students\AttendanceController;
use App\Http\Controllers\Students\FeesController;
use App\Http\Controllers\Students\FeesInvoicesController;
use App\Http\Controllers\Students\GraduatedController;
use App\Http\Controllers\Students\LibraryController;
use App\Http\Controllers\Students\OnlineClasseController;
use App\Http\Controllers\Students\PaymentController;
use App\Http\Controllers\Students\ProcessingFeeController;
use App\Http\Controllers\Students\PromotionController;
use App\Http\Controllers\Students\ReceiptStudentsController;
use App\Http\Controllers\Students\StudentController;
use App\Http\Controllers\Subjects\SubjectController;
use App\Http\Controllers\Teachers\TeacherController;
use Illuminate\Support\Facades\Route;
require __DIR__.'/auth.php';

Route::get('/', [HomeController::class,'index'])->name('selection');





Route::group(['namespace' => 'Auth'], function () {

Route::get('/login/{type}',[LoginController::class,'loginForm'])->middleware('guest')->name('login.show');

Route::post('/login',[LoginController::class,'login'])->name('login');
Route::get('/logout/{type}', [LoginController::class,'logout'])->name('logout');

});

// Route::group(['middleware' => ['guest']], function () {

//     Route::get('/', function () {
//         return view('auth.login');
//     });

// });
        Route::get('/dashboard', function () {
            return view('dashboard');

        })->middleware(['auth', 'verified'])->name('dashboard');

        Route::middleware('auth')->group(function () {
            Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
            Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
            Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        });


        Route::resource('Grades', GradeController::class);

 //==============================Classrooms============================
        Route::group([], function () {
            Route::resource('Classrooms', ClassroomController::class);
            Route::post('delete_all', [ClassroomController::class, 'delete_all'])->name('delete_all');
            Route::post('Filter_Classes', [ClassroomController::class, 'Filter_Classes'])->name('Filter_Classes');
        });
 //==============================Sections============================

        Route::group(['namespace' => 'App\Http\Controllers\Sections'], function () {
            Route::resource('Sections', SectionController::class);
            Route::get('/classes/{id}', [SectionController::class,'getclasses']);
        });
         //==============================parents============================
        Route::view('add_parent','livewire.show_Form')->name('add_parent');
 //==============================Teachers============================
        Route::resource('Teachers', TeacherController::class);
        //==============================Students============================
    Route::group([], function () {
        Route::resource('Students', StudentController::class);
        Route::resource('online_classes', OnlineClasseController::class);
        Route::get('indirect_admin', [OnlineClasseController::class,'indirectCreate'])->name('indirect.create.admin');
        Route::post('indirect_admin', [OnlineClasseController::class,'storeIndirect'])->name('indirect.store.admin');
        Route::resource('Graduated', GraduatedController::class);
        Route::resource('Promotion', PromotionController::class);
        Route::resource('Fees_Invoices', FeesInvoicesController::class);
        Route::resource('Fees', FeesController::class);
        Route::resource('receipt_students', ReceiptStudentsController::class);
        Route::resource('ProcessingFee', ProcessingFeeController::class);
        Route::resource('Payment_students', PaymentController::class);
        Route::resource('Attendance', AttendanceController::class);
        Route::get('download_file/{filename}', [LibraryController::class,'downloadAttachment'])->name('downloadAttachment');
        Route::resource('library', LibraryController::class);
        Route::post('Upload_attachment', [StudentController::class,'Upload_attachment'])->name('Upload_attachment');
        Route::get('Download_attachment/{studentsname}/{filename}', [StudentController::class,'Download_attachment'])->name('Download_attachment');
        Route::post('Delete_attachment', [StudentController::class,'Delete_attachment'])->name('Delete_attachment');
    });

 //==============================subjects============================
    Route::group([], function () {
        Route::resource('subjects', SubjectController::class);
    });

    //==============================Quizzes============================
    Route::group([], function () {
        Route::resource('Quizzes', QuizzController::class);
    });

    //==============================questions============================
    Route::group([], function () {
        Route::resource('questions', QuestionController::class);
    });

    //==============================Setting============================
    Route::resource('settings', SettingController::class);

