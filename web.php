<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\studentcontroller;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\productcontroller;
use App\Http\Controllers\ravicontroller;
use App\Http\Controllers\employcontroller;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\kdcontroller;
use App\Http\Controllers\crudcontroller;
use App\Http\Controllers\CrudAppController;
use App\Http\Controllers\kController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\registrationcontroller;
use App\Http\Controllers\DeleteUserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\asiyacontroller;





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

// Route::get('/', function () {
//     return view('welcome');
// });


// Route::get('/', [studentcontroller::class, 'fbregistraion']);
// Route::post('/store', [studentcontroller::class, 'store']);
// Route::get('/fblogin', [studentcontroller::class, 'fblogin']);
// Route::post('/add', [studentcontroller::class, 'add']);


Route::get('dashboard', [CustomAuthController::class, 'dashboard'])->name('dashboard');
Route::get('login', [CustomAuthController::class, 'login'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom');
Route::get('register', [CustomAuthController::class, 'registration'])->name('register');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom');
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');

Route::resource('target', PostController::class);
Route::resource('companies', CompanyController::class);
// Route::resource('products', ProductController::class);
Route::resource('shree', ravicontroller::class);

// Route::resource('group', employcontroller::class);



Route::get('group/create', [employcontroller::class, 'create'])->name('group.create');
Route::post('group', [employcontroller::class, 'store'])->name('group.store');
Route::get('group/index', [employcontroller::class, 'index'])->name('group.index');
Route::get('group/show/{id}', [employcontroller::class, 'show'])->name('group.show');
Route::get('group/edit/{id}', [employcontroller::class, 'edit'])->name('group.edit');
Route::put('group/update/{id}', [employcontroller::class, 'update'])->name('group.update');
Route::DELETE('group/destroy/{id}', [employcontroller::class, 'destroy'])->name('group.destroy');





// Route::get('group', [StudentController::class, 'create']);
// Route::post('group', [StudentController::class, 'store']);

Route::get('generate-pdf', [PDFController::class, 'generatePDF']);

// Route::resource("/student", StudentController::class);


// Route::resource('crud', crudcontroller::class);

// Route::controller(ImageController::class)->group(function(){
//     Route::get('image-upload', 'index');
//     Route::post('image-upload', 'store')->name('image.store');
// });
// Route::resource("/fbnote", kdcontroller::class);


Route::get('fbnote', [kdcontroller::class, 'create'])->name('fbnote.create');
Route::post('fbnote/store', [kdcontroller::class, 'store'])->name('fbnote.store');
Route::get('fbnote/index', [kdcontroller::class, 'index'])->name('fbnote.index');
Route::get('fbnote/show/{id}', [kdcontroller::class, 'show'])->name('fbnote.show');
Route::get('fbnote/edit/{id}', [kdcontroller::class, 'edit'])->name('fbnote.edit');
Route::put('fbnote/update/{id}', [kdcontroller::class, 'update'])->name('fbnote.update');
Route::DELETE('fbnote/destroy/{id}', [kdcontroller::class, 'destroy'])->name('fbnote.destroy');
Route::DELETE('fbnote/DeleteAll', [kdcontroller::class, 'deleteAll'])->name('fbnote.deleteAll');






Route::get('student.create', [StudentController::class, 'create'])->name('student.create');
Route::post('student', [StudentController::class, 'store'])->name('student.store');
Route::get('student', [StudentController::class, 'index'])->name('student.index');
Route::get('student/show/{id}', [StudentController::class, 'show'])->name('student.show');
Route::get('student/edit/{id}', [StudentController::class, 'edit'])->name('student.edit');
Route::put('student/update/{id}', [StudentController::class, 'update'])->name('student.update');
Route::DELETE('student/destroy/{id}', [StudentController::class, 'destroy'])->name('student.destroy');




Route::get('/all_records',[CrudAppController::class,'all_records'])->name('all.records');
Route::get('/add-new-record',[CrudAppController::class,'add_new_record'])->name('add.new.record');
Route::post('/store-new-record',[CrudAppController::class,'store_new_record'])->name('store.new.record');
Route::get('/edit-record/{id}',[CrudAppController::class,'edit_record'])->name('edit.record');
Route::post('/update-record/{id}',[CrudAppController::class,'update_record'])->name('update.record');
Route::get('/delete-record/{id}',[CrudAppController::class,'delete_record'])->name('delete.record');


Route::get('/create', [kController::class, 'create']);
Route::post('/store', [kController::class, 'store']);
Route::get('/index', [kController::class, 'index']);
Route::get('show/{id}', [kController::class, 'show']);
Route::get('edit/{id}', [kController::class, 'edit']);
Route::put('update/{id}', [kController::class, 'update']);
Route::DELETE('destroy/{id}', [kController::class, 'destroy']);



// --------------------------------------------------------------------------------------------------------------------------

// Route::get('/index',[crudcontroller::class,'index']);
// Route::post('store',[crudcontroller::class,'store']);
// Route::get('show/{id}',[crudcontroller::class,'show']);
// Route::get('delete/{id}',[crudcontroller::class,'destroy']);
// Route::get('edit/{id}',[crudcontroller::class,'edit']);
// Route::get('edit1/{id}',[crudcontroller::class,'edit1']);
// Route::post('update/',[crudcontroller::class,'update']);



Route::get('product/index',[productcontroller::class,'index']);
Route::get('product/create',[productcontroller::class,'create']);
Route::post('product/store',[productcontroller::class,'store']);
Route::get('product/show/{id}',[productcontroller::class,'show']);


Route::get('/', [productcontroller::class, 'index']);
Route::get('tube.cart', [productcontroller::class, 'cart'])->name('tube.cart');
Route::get('add-to-cart/{id}', [productcontroller::class, 'addToCart'])->name('add.to.cart');
Route::patch('update-cart', [productcontroller::class, 'update'])->name('update.cart');
Route::delete('remove-from-cart', [productcontroller::class, 'remove'])->name('remove.from.cart');
Route::get('import', [productcontroller::class, 'import'])->name('import');
Route::get('export/{id}', [UserController::class, 'export'])->name('export');



Route::get('join_table', [JointableController::class, 'index']);


// Route::resource('country','CountryController');
// // Route::any('/search', 'CountryController@search');

// Route::get('index',[CountryController::class,'index'])->name('country.index');
// Route::get('create',[CountryController::class,'create'])->name('country.create');
// Route::post('store',[CountryController::class,'store'])->name('country.store');
// Route::any('search',[CountryController::class,'search'])->name('search');
// Route::get('edit/{id}',[CountryController::class,'edit'])->name('country.edit');
// Route::get('update/{id}',[CountryController::class,'update'])->name('country.update');
// Route::get('destroy/{id}',[CountryController::class,'destroy'])->name('country.destroy');



Route::get('logic/register',[registrationcontroller::class,'register'])->name('logic.register');
Route::post('logic/store',[registrationcontroller::class,'store'])->name('store');
Route::get('logic/dashboard',[registrationcontroller::class,'dashboard'])->name('logic.dashboard');


Route::get('osiya/create',[asiyacontroller::class,'create'])->name('osiya.create');
Route::post('osiya/store',[asiyacontroller::class,'store'])->name('osiya.store');
Route::get('osiya/index',[asiyacontroller::class,'index'])->name('osiya.index');



// Route::get('users-list', [asiyacontroller::class, 'index'])->name('users-list');
Route::post('/ajax_search/action', [asiyacontroller::class, 'action'])->name('ajax_search.action');


// Route::delete('osiya/index/{id}' ,[asiyacontroller::class,'destroy'])->name('osiya.destroy');
Route::delete('osiya/index/DeleteAll', [asiyacontroller::class,'deleteAll'])->name('osiya.deleteAll');







Route::controller(ImageController::class)->group(function(){
    Route::get('image-upload', 'index');
    Route::post('image-upload', 'store')->name('image.store');
});




