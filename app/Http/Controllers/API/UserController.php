<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserController extends Controller
{

    /**
     * login api
     *
     * @return Response
     */
    public function login()
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $user->createToken(env('APP_NAME', 'MyApp'));
            $user = $user->toArray();
            $user['access_token'] = $user->accessToken;
            return response()->json(['success' => $user], Response::HTTP_OK);
        } else {
            return response()->json(['error' => 'Unauthorised'], Response::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * Register api
     *
     * @param Request $request
     * @return Response
     */
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'password_repeat' => 'required|same:password',
        ]);

        $validatedData['password'] = \Hash::make($validatedData['password']);
        $validatedData['role'] = User::ROLE_USER;
        /**
         * @var $user User
         */
        $user = User::create($validatedData);
        $user->createToken(env('APP_NAME', 'MyApp'));
        $token = $user->accessToken;
        $user = $user->toArray();
        $user['access_token'] = $token;
        return response()->json(['success' => $user], Response::HTTP_OK);
    }

    /**
     * user api
     *
     * @return Response
     */
    public function user()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], Response::HTTP_OK);
    }
}
