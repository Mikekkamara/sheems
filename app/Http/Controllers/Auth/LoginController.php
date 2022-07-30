<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\AuthResource;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating writers for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect writers after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /*public function login(LoginRequest $request)
    {


        if (!Auth::attempt($request->all())) {
            return $this->error('Credentials not match', 401);
        }


        $user = AuthResource::collection(
            $user = AuthResource::collection(User::where('id',Auth::user()->id)->get()));
        return response([
            'error' => False,
            'message' => 'Success',
            'user'=>$user
        ], Response::HTTP_OK);
    }*/

    /* public function logout()
    {
        auth()->user()->tokens()->delete();

        return response([
            'error' => False,
            'message' => 'Success',
            'token' =>'Tokens Revoked',
        ], Response::HTTP_OK);
    } */

}
