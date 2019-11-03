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
            $response['token'] = $user->createToken(env('APP_NAME', 'MyApp'))->accessToken;
            return response()->json(['success' => $response], Response::HTTP_OK);
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
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'password_repeat' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], Response::HTTP_UNAUTHORIZED);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $input['status'] = User::ROLE_USER;
        $user = User::create($input);
        $response['token'] = $user->createToken(env('APP_NAME', 'MyApp'))->accessToken;
        $response['name'] = $user->name;
        return response()->json(['success' => $response], Response::HTTP_OK);
    }

    /**
     * details api
     *
     * @return Response
     */
    public function details()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], Response::HTTP_OK);
    }
}
