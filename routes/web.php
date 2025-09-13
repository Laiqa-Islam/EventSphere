<?php

use App\Models\Announcement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\VenueController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\UserEventController;
use App\Http\Controllers\AdminEventController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\UserGalleryController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\MediaGalleryController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\AdminFeedbackController;

Route::get('/', function () {
    return view('website.index');
})->name('index');
Route::get('/about', function () {
    return view('website.about');
})->name('about');
Route::get('/contact', function () {
    return view('website.contact');
})->name('contact');

// User Dashboard
Route::middleware(['auth', 'role:participant'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/user/events', [UserEventController::class, 'index'])->name('events.user.index');
Route::get('/user/events/{event}', [UserEventController::class, 'show'])->name('events.user.show');
Route::get('/user/gallery', [UserGalleryController::class, 'index'])->name('gallery.user.index');
Route::middleware('auth')->prefix('user')->group(function () {
    Route::post('/events/{event}/register', [UserEventController::class, 'register'])->name('events.user.register');
    Route::delete('/events/{event}/cancel', [UserEventController::class, 'cancel'])->name('events.user.cancel');

});

Route::middleware(['auth'])->group(function () {
    Route::get('/media/{id}', [UserGalleryController::class, 'show'])->name('media.show');
    Route::post('/media/{id}/favorite', [UserGalleryController::class, 'toggleFavorite'])->name('media.favorite');
});

Route::middleware('auth')->group(function () {
    Route::post('/favorites/toggle/{media}', [FavoritesController::class, 'toggle'])->name('favorites.toggle');
    Route::get('/favorites', [FavoritesController::class, 'myFavorites'])->name('favorites.index');
    Route::post('/events/{event}/feedback', [FeedbackController::class, 'store'])
        ->middleware('auth')
        ->name('feedback.store');
    Route::post('/events/{event}/bookmark', [UserEventController::class, 'bookmark'])
        ->middleware('auth')->name('events.bookmark');
    Route::delete('/events/{event}/bookmark', [UserEventController::class, 'unbookmark'])
        ->middleware('auth')->name('events.unbookmark');

});

Route::middleware(['auth'])->group(function () {
    // student
    Route::get('/my-registrations', [RegistrationController::class, 'myRegistrations'])->name('registrations.my');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/my-certificates', [CertificateController::class, 'myCertificates'])->name('user.certificates');
    Route::post('/request-certificate/{eventId}', [CertificateController::class, 'requestCertificate'])->name('user.requestCertificate');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/certificates/approved', [App\Http\Controllers\CertificateController::class, 'approvedCertificates'])
        ->name('admin.certificates.approved');
    Route::get('/admin/certificates/pending', [CertificateController::class, 'pendingCertificates'])->name('admin.certificates.pending');
    Route::post('/admin/certificates/approve/{id}', [CertificateController::class, 'approveCertificate'])->name('admin.certificates.approve');
});

use App\Http\Controllers\ContactController;

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');



// Admin Dashboard
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/events', [AdminEventController::class, 'index'])->name('events.index');
    Route::post('/events/{event}/approve', [AdminEventController::class, 'approve'])->name('events.approve');
    Route::post('/events/{event}/reject', [AdminEventController::class, 'reject'])->name('events.reject');
});

Route::middleware(['auth', 'role:admin,organizer'])->group(function () {
    Route::get('/attendance', [AttendanceController::class, 'attendanceIndex'])->name('attendance.index');
    Route::get('/attendance/{event}', [AttendanceController::class, 'attendanceDetails'])->name('attendance.details');
    Route::get('/attendance/user/scanner', [AttendanceController::class, 'scanner'])->name('attendance.user.scanner');
    Route::post('/attendance/checkin', [AttendanceController::class, 'checkin'])->name('attendance.checkin');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [AdminUserController::class, 'show'])->name('users.show');
    Route::post('/users/{user}/role', [AdminUserController::class, 'updateRole'])->name('users.updateRole');
    Route::post('/users/{user}/reset-password', [AdminUserController::class, 'resetPassword'])->name('users.resetPassword');
    Route::post('/users/{user}/suspend', [AdminUserController::class, 'suspend'])->name('users.suspend');
    Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');
     Route::delete('/feedback/{feedback}', [AdminFeedbackController::class, 'destroy'])->name('feedback.destroy');
});



// Organizer Dashboard
Route::middleware(['auth', 'role:organizer'])->group(function () {
    Route::get('/organizer', function () {
        return view('organizer.dashboard');
    })->name('organizer.dashboard');
});
Route::middleware(['auth', 'role:organizer,admin'])->group(function () {
    Route::resource('events', EventController::class);
});
Route::middleware(['auth', 'role:admin,organizer'])->group(function () {
    Route::resource('venues', VenueController::class);
});

Route::middleware(['auth', 'role:admin,organizer'])->group(function () {
    Route::post('/events/{event}/register', [RegistrationController::class, 'store'])->name('registrations.store');
    Route::get('/events/{event}/registrations', [RegistrationController::class, 'index'])->name('registrations.index');
});

Route::middleware(['auth', 'role:admin,organizer'])->group(function () {
    Route::resource('media-gallery', MediaGalleryController::class);
});
Route::middleware(['auth', 'role:admin,organizer'])->group(function () {
    Route::resource('announcements', AnnouncementController::class);
});

Route::prefix('admin')->middleware(['auth', 'role:admin,organizer'])->group(function () {
    Route::get('/feedback', [AdminFeedbackController::class, 'index'])->name('admin.feedback.index');
    Route::get('/feedback/{event}', [AdminFeedbackController::class, 'show'])->name('admin.feedback.show');
   
});


//Notifications Route
Route::post('/notifications/{id}/read', function ($id) {
    $notification = Auth::user()->notifications()->findOrFail($id);
    $notification->markAsRead();
    return back();
})->name('notifications.read');

Route::post('/notifications/read-all', function () {
    Auth::user()->unreadNotifications->markAsRead();
    return back();
})->name('notifications.readAll');

Route::get('/notifications', function () {
    $notifications = Auth::user()->notifications;
    return view('notifications.index', compact('notifications'));
})->name('notifications.all');


Route::get('/announcements/all', [AnnouncementController::class, 'all'])->name('announcements.all');
// Route::get('/attendance/checkin/{qrToken}', [AttendanceController::class, 'checkin'])
//     ->name('attendance.checkin');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
