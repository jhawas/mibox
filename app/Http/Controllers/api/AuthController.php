<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

	/**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:191'],
            'email' => ['required', 'string', 'email', 'max:191', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }
	/**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    public function register (Request $request) {

	    $validator = $this->validator($request->all());

	    if ($validator->fails()) {
	        return response(['errors'=>$validator->errors()->all()], 422);
	    }

	    $request['password'] = Hash::make($request['password']);
	    
	    $user = User::create($request->toArray());

	    $token = $user->createToken('Laravel Password Grant Client')->accessToken;
	    
	    $response = ['token' => $token];

	    return response($response, 200);

	}

	/**
     * Login Request
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function login (Request $request) {

		$request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

	    if(Auth::attempt(['username' => $request->username, 'password' => $request->password])){
            $user = Auth::user();
            $token = $user->createToken($request->username)->accessToken;
            return response()->json([
            	'user' => $user,
            	'token' => $token,
            	'message' => 'Successfully login'
            ], 200);
        }
        else{
            return response()->json([
            	'error' => 'Unauthorised',
            	'message' => 'Invalid Username or Password',
            ], 401);
        }

	}

	/**
     * Logout Request
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function logout (Request $request) {
        
	    $request->user()->token()->revoke();

        return response()->json([
            'token' => null,
            'user' => null,
            'message' => 'Logout Success'
        ], 200);

	}
}
