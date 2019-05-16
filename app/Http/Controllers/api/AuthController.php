<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

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

	    $user = User::where('email', $request->email)->first();

	    if ($user) {

	        if (Hash::check($request->password, $user->password)) {
	            $token = $user->createToken('Laravel Password Grant Client')->accessToken;
	            $response = ['token' => $token];
	            return response($response, 200);
	        } else {
	            $response = "Password missmatch";
	            return response($response, 422);
	        }

	    } else {
	        $response = 'User does not exist';
	        return response($response, 422);
	    }

	}

	/**
     * Logout Request
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function logout (Request $request) {

	    $token = $request->user()->token();
	    $token->revoke();

	    $response = 'You have been succesfully logged out!';
	    
	    return response($response, 200);

	}
}
