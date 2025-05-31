<?php

use App\Http\Controllers\ChartController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\SubjectController;

use App\Http\Controllers\ProfilePage;

use App\Livewire\AttendancePage;
use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\ResetPassword;
use App\Livewire\ClassroomPage;
use App\Livewire\Dashboard;
use App\Livewire\EmployeePage;
use App\Livewire\ExcusePage;
use App\Livewire\HolidayPage;
use App\Livewire\Schedule\ScheduleCreate;
use App\Livewire\SubjectPage;
use App\Livewire\Schedule\SchedulePage;
use App\Livewire\SchoolPage;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

// use Illuminate\Support\Facades\Redis;
use Prometheus\CollectorRegistry;
use Prometheus\RenderTextFormat;
use Prometheus\Storage\Redis as RedisStorage;
// use Prometheus\CollectorRegistry;
// use Prometheus\RenderTextFormat;
// use Prometheus\Storage\Redis;

use App\Exports\AttendanceExport;
use Maatwebsite\Excel\Facades\Excel;

Route::get('/', fn () => view('pages.home'))->name('home');

Route::middleware('guest')->group(function () {
    Route::get('login', Login::class)->name('login');
    Route::get('forgot-password', ForgotPassword::class)->name('forgot-pass');
    Route::get('reset-password', ResetPassword::class)->name('reset-pass');
});

Route::middleware('auth')->group(function () {
    Route::get('attendances', AttendancePage::class)->name('attendances');
    Route::get('chart', ChartController::class)->name('chart');
    Route::get('dashboard', Dashboard::class)->name('dashboard');

    Route::get('employees', EmployeePage::class)->name('employees');
    Route::get('employees/datatables', EmployeeController::class)
        ->name('employees.datatables');

    Route::get('excuses', ExcusePage::class)->name('excuses');

    Route::get('classrooms', ClassroomPage::class)->name('classrooms');
    Route::get('classrooms/datatables', ClassroomController::class)
        ->name('classrooms.datatables');

    Route::get('holidays', HolidayPage::class)->name('holidays');
    Route::get('holidays/json', [HolidayController::class, 'json'])
        ->name('holidays.json');

    Route::get('subjects', SubjectPage::class)->name('subjects');
    Route::get('subjects/datatables', SubjectController::class)
        ->name('subjects.datatables');

    Route::get('schedules', SchedulePage::class)->name('schedules');
    Route::get('schedules/{classroom}/create', ScheduleCreate::class)
        ->name('schedules.create');

    Route::get('profile/data', [ProfilePage::class, 'data'])->name('profile.data');
    Route::post('profile/update', [ProfilePage::class, 'update'])->name('profile.update');
    Route::post('/updated-profile-photo', [ProfilePage::class, 'updatedPhoto'])->name('profile.updated-photo');


    Route::get('/export-attendance', function () {
        return Excel::download(new AttendanceExport, 'log-presensi.xlsx');
    })->name('export.attendance');

    Route::get('/export-attendance-today', function () {
        return Excel::download(new AttendanceTodayExport, 'log-presensi-hari-ini.xlsx');
    })->name('export.attendance.today');

    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('school', SchoolPage::class)->name('school');
    });

    Route::get('logout', function () {
        Auth::logout();
        Session::regenerate();
        
        return to_route('login');
    })->name('logout');
});

Route::get('/metrics', function () {
    $storage = new RedisStorage([
        'host' => 'redis', // sesuai nama service di docker-compose
    ]);

    $registry = new CollectorRegistry($storage);

    try {
        $counter = $registry->registerCounter('app', 'requests_total', 'Total HTTP Requests');
    } catch (\Prometheus\Exception\MetricsRegistrationException $e) {
        $counter = $registry->getCounter('app', 'requests_total');
    }

    $counter->inc();

    $renderer = new RenderTextFormat();
    return response($renderer->render($registry->getMetricFamilySamples()))
        ->header('Content-Type', RenderTextFormat::MIME_TYPE);
});