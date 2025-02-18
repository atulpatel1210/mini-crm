<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\ContrlerEmployeeController;
use Illuminate\Support\Facades\Artisan;


Route::get('/', function () {
    return redirect('/dashboard');
});

Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'hi'])) {
        Session::put('locale', $locale);
        app()->setLocale($locale);
    }
    return redirect()->back()->with('success', 'Language changed to ' . $locale);
})->name('change.language');

Auth::routes(['register' => false]);

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    Route::resource('companies', CompanyController::class);
    Route::post('/companies/data', [CompanyController::class, 'getData'])->name('companies.getData');


    Route::resource('employees', EmployeeController::class);
    Route::post('employees/data', [EmployeeController::class, 'getData'])->name('employees.getData');
});
