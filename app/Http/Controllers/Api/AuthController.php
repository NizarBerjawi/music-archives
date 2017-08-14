<?php
namespace App\Http\Controllers\Api;

use Auth;
use App\Models\User;
use App\Http\Requests\Api\LoginUser;
use App\Http\Requests\Api\RegisterUser;
use App\Transformers\UserTransformer;

class AuthController extends ApiController
{
    /**
     * AuthController constructor.
     *
     * @param UserTransformer $transformer
     */
    public function __construct(UserTransformer $transformer)
    {
        $this->transformer = $transformer;
    }

    /**
     * Login user and return the user if successful.
     *
     * @param LoginUser $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginUser $request)
    {
        // Get the user's login credentials
        $credentials = $request->only('user.email', 'user.password');

        // Get the email and the password credentials
        $credentials = $credentials['user'];

        // The once method is used to log a user into the application for
        // a single request. No sessions or cookies will be utilized.
        if ( !Auth::once($credentials) )
        {
            return $this->respondFailedLogin();
        }

        // If the login is successfull
        return $this->respondWithTransformer(auth()->user());
    }

    /**
     * Register a new user and return the user if successful.
     *
     * @param RegisterUser $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterUser $request)
    {
        // Create a new user
        $user = User::create([
            'name' => $request->input('user.name'),
            'email' => $request->input('user.email'),
            'password' => $request->input('user.password'),
        ]);

        return $this->respondWithTransformer($user);
    }
}
