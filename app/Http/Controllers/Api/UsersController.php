<?php

namespace App\Http\Controllers\Api;

use App\Transformers\UserTransformer;
use App\Http\Requests\Api\UpdateUser;
use Auth;

class UsersController extends ApiController
{
    /**
     * UsersController constructor.
     *
     * @param UserTransformer $transformer
     */
    public function __construct(UserTransformer $transformer)
    {
        // Get an instance of the UserTransformer
        $this->transformer = $transformer;

        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->respondWithTransformer(Auth::user());
    }

    /**
     * Update the authenticated user and return the user if successful.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUser $request)
    {
        // Get an instance of the authenticated user
        $user = Auth::user();

        // If the data is available update the user
        if ($request->has('user')) {
            $user->update($request->get('user'));
        }

        return $this->respondWithTransformer($user);
    }
}
