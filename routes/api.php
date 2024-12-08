<?php

use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\IssueController;
use App\Http\Controllers\Api\IssueArticlesController;
use App\Http\Controllers\Auth\SessionController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Orion\Facades\Orion;

Route::group(['middleware' => ['api', 'throttle:5,1']], function () {

    Route::post('/register', [RegistrationController::class, 'store'])
        ->middleware('guest:sanctum')
        ->name('register');

    Route::post('/login', [SessionController::class, 'store'])
        ->middleware('guest:sanctum')
        ->name('login');

    // Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
    //     ->middleware('guest:sanctum')
    //     ->name('password.email');

    // Route::post('/reset-password', [NewPasswordController::class, 'store'])
    //     ->middleware('guest:sanctum')
    //     ->name('password.store');

    // Route::get('/verify-email/{id}/{hash}', VerifyEmailController::class)
    //     ->middleware(['auth', 'signed', 'throttle:6,1'])
    //     ->name('verification.verify');

    // Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
    //     ->middleware(['auth', 'throttle:6,1'])
    //     ->name('verification.send');

    Route::post('/logout', [SessionController::class, 'destroy'])
        ->middleware('auth')
        ->name('logout');

    Route::post('/upgrade_user', function (Request $request): JsonResponse {
        if (!Auth::check()) {
            abort(404);
        }
        if ($request->code != env('ADMIN_UPGRADE_PASSCODE')) {
            abort(404);
        }
        $user = App\Models\User::where('id', Auth::user()->id)->first();
        $user->update([
            'is_admin' => true
        ]);
        return response()->json([
            'success' => true,
            'user' => $user->details()
        ]);
    });

    Route::post('/downgrade_user', function (Request $request): JsonResponse {
        if (!Auth::check()) {
            abort(404);
        }
        if ($request->code != env('ADMIN_UPGRADE_PASSCODE')) {
            abort(404);
        }
        $user = App\Models\User::where('id', Auth::user()->id)->first;
        $user->update([
            'is_admin' => false
        ]);
        return response()->json([
            'success' => true,
            'user' => $user->details()
        ]);
    });

    Route::post('/setup', function (Request $request): JsonResponse {
        if (!Auth::check()) {
            abort(404);
        }
        if ($request->code != env('ADMIN_UPGRADE_PASSCODE')) {
            abort(404);
        }
        Artisan::call('storage:link');
        return response()->json([
            'success' => true,
            'output' => Artisan::output()
        ]);
    });
});

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['as' => 'api.'], function () {
    Orion::resource('issues', IssueController::class)->withSoftDeletes();
    Orion::resource('articles', ArticleController::class)->withSoftDeletes();
    Orion::hasManyResource('issue', 'articles', IssueArticlesController::class)->withSoftDeletes();
});
