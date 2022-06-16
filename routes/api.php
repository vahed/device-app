<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\DeviceController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// register
Route::post('/register', function (Request $request) {
        $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password)
    ]);

    return $user;
});

// login
Route::post('/login', function (Request $request) {
    $user = User::where('email', $request->email)->first();
    if (! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'message' => ['The provided credentials are incorrect.'],
        ]);
    }
    return $request->session()->regenerate();
});

// logout
Route::post('logout', function(Request $request){
    auth()->guard('web')->logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return response()->json(null, 200);
});

Route::get('devices', [DeviceController::class, 'showAllDevices']);
Route::get('devices/{id}', [DeviceController::class, 'showSingleDevice']);
Route::get('showAllDevicesByOS', [DeviceController::class, 'showAllDevicesByOS']);
Route::post('devices', [DeviceController::class, 'storeNewDevice']);
Route::post('devices/{id}', [DeviceController::class, 'destroyDevice']);