<?php
use Illuminate\Support\Facades\Route;

Route::middleware(['WebSetting','throttle:FrontendGlobal'])->group(function () {

    Route::middleware('MemberGuest')->group(function () {
            Route::get('/Login', [App\Http\Controllers\LoginController::class, 'index']);
            Route::post('/Login/Update', [App\Http\Controllers\LoginController::class, 'Update']);
            Route::get('/Login/Verificationlink/{VerificationCode}', [App\Http\Controllers\LoginController::class, 'Verificationlink'])->where(['VerificationCode'=>'[0-9a-zA-Z]+']);
            Route::get('/Register', [App\Http\Controllers\RegisterController::class, 'index']);
            Route::post('/Register/Update', [App\Http\Controllers\RegisterController::class, 'Update']);
            Route::get('/ForgotPassword', [App\Http\Controllers\ForgotPasswordController::class, 'index']);
            Route::post('/ForgotPassword/Update', [App\Http\Controllers\ForgotPasswordController::class, 'Update']);
        
    });
    Route::middleware(['MemberAuth','GlobalMiddleware'])->group(function () {
        Route::post('/logout', [App\Http\Controllers\LoginController::class, 'logout']);
        Route::get('/PersonalCenter', [App\Http\Controllers\PersonalCenterController::class, 'index']);
        Route::post('/PersonalCenter/UpdateName', [App\Http\Controllers\PersonalCenterController::class, 'UpdateName']);
        Route::post('/PersonalCenter/Updateemail', [App\Http\Controllers\PersonalCenterController::class, 'Updateemail']);
        Route::get('/PersonalCenter/Verificationlink/{VerificationCode}', [App\Http\Controllers\PersonalCenterController::class, 'Verificationlink'])->where(['VerificationCode'=>'[0-9a-zA-Z]+']);

        Route::get('/LoginHistory', [App\Http\Controllers\LoginHistoryController::class, 'index']);

    });


    Route::middleware('GlobalMiddleware')->group(function () {

        Route::get('/', [App\Http\Controllers\IndexController::class, 'index']);

    });
});

// Admin Guest Routes  後台
Route::prefix('dashboards')->group(function () {

    Route::middleware(['guest','throttle:BackendGlobal'])->group(function () {
            Route::get('/login', [App\Http\Controllers\dashboard\LoginController::class, 'showLogin']);
            Route::post('/login', [App\Http\Controllers\dashboard\LoginController::class, 'login']);
            Route::get('/', [App\Http\Controllers\dashboard\HomeController::class, 'dashboard']);
    });

    Route::middleware('admin')->group(function () {

        Route::post('/logout', [App\Http\Controllers\dashboard\LoginController::class, 'logout'])->name('logout');

        Route::get('/Personal', [App\Http\Controllers\dashboard\PersonalController::class, 'index'])->name('Personal');
        Route::post('/Personal/UploadData', [App\Http\Controllers\dashboard\PersonalController::class, 'UploadData'])->name('Personal');

        Route::get('/Main', [App\Http\Controllers\dashboard\MainController ::class, 'index'])->name('Main');
        Route::get('/SuperAdmin', [App\Http\Controllers\dashboard\SuperAdminController ::class, 'index'])->name('SuperAdmin');
        Route::post('/SuperAdmin/AddData', [App\Http\Controllers\dashboard\SuperAdminController ::class, 'AddData'])->name('SuperAdmin');
        Route::post('/SuperAdmin/DeleteData', [App\Http\Controllers\dashboard\SuperAdminController ::class, 'DeleteData'])->name('SuperAdmin');

        Route::get('/AdminList', [App\Http\Controllers\dashboard\AdminListController ::class, 'index'])->name('AdminList');
        Route::post('/AdminList', [App\Http\Controllers\dashboard\AdminListController ::class, 'index'])->name('AdminList');

        Route::get('/AdminList/AddData', [App\Http\Controllers\dashboard\AdminListController ::class, 'AddData'])->name('AdminList');
        Route::post('/AdminList/UploadAddData', [App\Http\Controllers\dashboard\AdminListController ::class, 'UploadAddData'])->name('AdminList');

        Route::get('/AdminList/EditData/{id}/{page}', [App\Http\Controllers\dashboard\AdminListController ::class, 'EditData'])->where(['id'=>'[0-9]+','page'=>'[0-9]+'])->name('AdminList');
        Route::post('/AdminList/UploadEditData', [App\Http\Controllers\dashboard\AdminListController ::class, 'UploadEditData'])->name('AdminList');

        Route::post('/AdminList/UploadDisableData', [App\Http\Controllers\dashboard\AdminListController ::class, 'UploadDisableData'])->name('AdminList');
        Route::post('/AdminList/UploadEnableData', [App\Http\Controllers\dashboard\AdminListController ::class, 'UploadEnableData'])->name('AdminList');
        Route::post('/AdminList/DeleteData', [App\Http\Controllers\dashboard\AdminListController ::class, 'DeleteData'])->name('AdminList');
        

        Route::get('/Permission', [App\Http\Controllers\dashboard\PermissionController ::class, 'index'])->name('Permission');
        Route::post('/Permission/UploadData', [App\Http\Controllers\dashboard\PermissionController ::class, 'UploadData'])->name('Permission');
        Route::post('/Permission/DeleteData', [App\Http\Controllers\dashboard\PermissionController ::class, 'DeleteData'])->name('Permission');
        Route::get('/Permission/Levelvalue/{id}', [App\Http\Controllers\dashboard\PermissionController ::class, 'Levelvalue'])->where(['id'=>'[0-9]+'])->name('Permission');
        Route::post('/Permission/LevelvalueUpload', [App\Http\Controllers\dashboard\PermissionController ::class, 'LevelvalueUpload'])->name('Permission');


        Route::get('/SystemSteeing', [App\Http\Controllers\dashboard\SystemSteeingController ::class, 'index'])->name('SystemSteeing');
        Route::post('/SystemSteeing/UploadData', [App\Http\Controllers\dashboard\SystemSteeingController ::class, 'UploadData'])->name('SystemSteeing');



    });
});
// Admin Guest Routes  後台