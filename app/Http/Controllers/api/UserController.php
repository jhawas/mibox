<?php

namespace App\Http\Controllers\api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return $users;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = new User;
        $user->first_name = $request->first_name;
        $user->middle_name = $request->middle_name;
        $user->last_name = $request->last_name;
        $user->username = $request->username;
        $user->suffix = $request->suffix;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->birthdate = $request->birthdate;
        $user->sex = $request->sex;
        $user->specialty = $request->specialty;
        $user->contact_no = $request->contact_no;
        $user->save();

        $user->roles()->attach($request->role);

        return response()->json([
            'message' => 'success',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return $user->load('roles');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $user->first_name = $request->first_name;
        $user->middle_name = $request->middle_name;
        $user->last_name = $request->last_name;
        $user->username = $request->username;
        $user->suffix = $request->suffix;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->birthdate = $request->birthdate;
        $user->sex = $request->sex;
        $user->specialty = $request->specialty;
        $user->contact_no = $request->contact_no;
        $user->save();

        $user->roles()->sync($request->role);

        return response()->json([
            'message' => 'success',
            'user' => $user
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response()->json([
            'message' => 'success',
        ]);
    }
}
