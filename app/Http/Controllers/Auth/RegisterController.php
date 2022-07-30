<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\AuthResource;
use App\Models\User;
use App\Models\Writer\Proficiency;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new writers as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect writers after registration.
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
        $this->middleware('guest');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return User|Application|ResponseFactory|\Illuminate\Http\Response
     */

    public function register(RegisterRequest $request){

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->company_email = $request->input('company_email');
        $user->writer_number = Str::random(6);
        $user->email = $request->input('email');
        $user->national_id = $request->input('national_id');
        $user->role = 2;
        $user->status = 0;
        $user->phone_number = $request->input('phone_number');
        $user->password = Hash::make($request->input('password'));

        if ($user->save()) {
            /*Writer proficiency*/
            $proficiency = new Proficiency();
            $proficiency->user_id = $user->id;
            $proficiency->niche =$request->input('niche');
            $proficiency->niche_expirience = $request->input('niche_expirience');
            $proficiency->english_proficiency = $request->input('english_proficiency');
            $proficiency->daily_word_count = $request->input('daily_word_count');
            $proficiency->pricing = $request->input('pricing');
            $proficiency->description = $request->input('description');
            if ($proficiency->save()) {
                /*Authenticate user*/
                $this->guard()->login($user);

                if ($response = $this->registered($request, $user)) {
                    return $response;
                }

                return $request->wantsJson()
                            ? new JsonResponse([], 201)
                            : redirect($this->redirectPath());
                    }

        }

    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:writers'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }
}
