<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvestmentController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ChatGPTController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aquí es donde puedes registrar todas las rutas web para tu aplicación.
| Estas rutas son cargadas por el RouteServiceProvider dentro de un grupo que
| contiene el grupo de middleware "web".
|
*/

// Ruta principal modificada para redirigir a la página de inicio
Route::get('/', function () {
    return redirect()->route('home');
})->name('root');

// Rutas de autenticación y sesión
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Rutas de inicio de sesión social
Route::get('/login/{provider}', [SocialController::class, 'redirect'])->name('social.login');
Route::get('/login/{provider}/callback', [SocialController::class, 'callback']);

// Ruta principal de usuarios autenticados
Route::get('/home', [InvestmentController::class, 'home'])->name('home');

// Rutas agrupadas para usuarios autenticados y verificados
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return redirect('/home');
    })->name('dashboard');

    Route::resource('investments', InvestmentController::class);

    // Rutas específicas del controlador de inversiones
    Route::get('/investments/{id}/form', [InvestmentController::class, 'showInvestmentForm'])->name('investments.form');
    Route::post('/investments/{id}/processInvestment', [InvestmentController::class, 'processInvestment'])->name('investments.processInvestment');

    // Ruta para el chat
    Route::view('/chat', 'chat')->name('chat.form');
    Route::post('/chat', [ChatGPTController::class, 'generateText'])->name('chat.send');

    // Rutas para gestionar notificaciones
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read')->middleware('auth');
    
    // Ruta para la página de contacto
    Route::view('/contact', 'contact')->name('contact');

    // Rutas para los proyectos con más inversiones
    Route::get('/top-investments', [PageController::class, 'showTopInvestments'])->name('top.investments');

    Route::get('/investments/transaction/{id}/ticket', [InvestmentController::class, 'generateInvestmentTicket'])->name('investments.ticket');
    Route::post('/investments/{id}/process', [InvestmentController::class, 'processInvestment'])->name('processInvestment')->middleware('auth');
    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
    Route::delete('/notifications', [NotificationController::class, 'deleteAll'])->name('notifications.deleteAll');
    Route::get('/notifications', [NotificationController::class, 'showNotifications'])->name('notifications.index')->middleware('auth');
});
