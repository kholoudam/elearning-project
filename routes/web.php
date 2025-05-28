<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CoursController;
use App\Http\Controllers\CoursEnseignantController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EnseignantController;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StatsController;

// Pour les statistiques ADMIN
Route::get('/statistiques/admin', [StatsController::class, 'adminStats'])->middleware('auth');
// Pour les statistiques ENSEIGNANT
Route::get('/statistiques/enseignant', [StatsController::class, 'enseignantStats'])->middleware('auth');
Route::get('/', [PageController::class, 'index'])->name('index');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/login', [LoginController::class, 'show'])->name('login.show');
//Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.perform');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout.perform');
Route::get('/register', [PageController::class, 'register'])->name('register');
Route::post('/register', [LoginController::class, 'register'])->name('register.perform');
Route::middleware('auth')->group(function () {
    Route::post('/cours/{cours}/inscrire', [CoursController::class, 'inscrire'])->name('cours.inscrire');
    Route::get('/profile',        [LoginController::class, 'Profile'])->name('profile');
    Route::get('/profile/edit',   [LoginController::class, 'showProfile'])->name('profile.edit');
    Route::put('/profile',        [LoginController::class, 'updateProfile'])->name('profile.update');
});
Route::get('/certificat/{cours_id}/generer', [CoursController::class, 'genererCertificat'])->name('certificat.generer');
Route::get('/cours/{id}/apprendre', [CoursController::class, 'apprendre'])->name('cours.apprendre');
Route::post('/cours/{id}/quiz', [CoursController::class, 'validerQuiz'])->name('cours.quiz');
Route::get('/index', [AdminController::class, 'index'])->name('admin.index');
Route::get('admin/cours', [AdminController::class, 'AfficherCours'])->name('coursa.index');
Route::get('admin/cours/create', [AdminController::class, 'create'])->name('coursa.create');
Route::post('admin/cours', [AdminController::class, 'store'])->name('coursa.store');
Route::post('admin/cours/filter', [AdminController::class, 'filter'])->name('coursa.filter');
Route::get('admin/cours/{id}', [AdminController::class, 'show'])->name('coursa.show');
Route::get('admin/cours/{id}/edit', [AdminController::class, 'edit'])->name('coursa.edit');
Route::put('admin/cours/{id}', [AdminController::class, 'update'])->name('coursa.update');
Route::delete('admin/cours/{id}', [AdminController::class, 'destroy'])->name('coursa.destroy');
Route::get('/courses', [CoursController::class, 'index'])->name('courses.index');
Route::get('/courses/{id}', [CoursController::class, 'show'])->name('courses.show');
Route::resource('cours', CoursEnseignantController::class);
Route::resource('utilisateurs', UtilisateurController::class);
Route::get('/404', [PageController::class, 'show404'])->name('404');
Route::get('/team', [PageController::class, 'showTeam'])->name('team');
Route::get('/testimonial', [PageController::class, 'showTestimonial'])->name('testimonial');
Route::resource('enseignants', EnseignantController::class);
//24, 29, 56, .7