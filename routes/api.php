<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

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
Route::get('/register', function (Request $request) {
        $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password)
    ]);

    return $user;
});

// login
Route::post('/login', function (Request $request) {
    
    // $credentials = $request->only('email', 'password');
    
    // if(! auth()->attempt($credentials)){
    //     throw ValidationException::withMessages([
    //         'email' => 'Invalid credentials'
    //     ]);
    //     return response()->json('Invalid credentials', 201);
    // }

    // $request->session()->regenerate();

    // return response()->json('correct login', 201);
    //return response()->json($request->data['email'], 201);
    $user = User::where('email', $request->data['email'])->first();
    // return response()->json($user->password, 201);
    if (! $user || ! Hash::check($request->data['password'], $user->password)) {
        throw ValidationException::withMessages([
            'message' => ['The provided credentials are incorrect.'],
        ]);
    }
    //return response()->json($request->session()->regenerate(), 201);
    return $request->session()->regenerate();
});

// logout
Route::post('logout', function(Request $request){
    auth()->guard('web')->logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return response()->json(null, 200);
});