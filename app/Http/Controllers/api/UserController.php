<?php

namespace App\Http\Controllers\api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\NewUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Events\NotificationEvent;

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
    public function store(Request $request)
    {

        $users = User::all();

        $validatedData = $request->validate([
            'roles' => 'required|not_in:[]',
            'first_name' => 'required|max:191',
            'middle_name' => 'required|max:191',
            'last_name' => 'required|max:191',
            'username' => 'required|max:191|unique:users',
            'email' => 'required|email|max:191|unique:users',
            'password' => 'required|min:6|confirmed',
            'birthdate' => 'required|max:191',
            'sex' => 'required|max:191',
            'specialty' => 'required|max:191',
            'contact_no' => 'required|max:191',
        ]);

        $roles = $this->extractArrayByColumn($request->roles, 'id');

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

        $user->roles()->attach($roles);

        Notification::send($users, new NewUser($user));

        event(new NotificationEvent());

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
        return $user;
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
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'roles' => 'required|not_in:[]',
            'first_name' => 'required|max:191',
            'middle_name' => 'required|max:191',
            'last_name' => 'required|max:191',
            'password' => 'required|min:6|confirmed',
            'birthdate' => 'required|max:191',
            'sex' => 'required|max:191',
            'specialty' => 'required|max:191',
            'contact_no' => 'required|max:191',
            'username' => 'required|max:191|unique:users,username,'.$user->id,
            'email' => 'required|email|max:191|unique:users,email,'.$user->id,
        ]);

        $roles = $this->extractArrayByColumn($request->roles, 'id');

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

        $user->roles()->sync($roles);

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

    /**
     * extact array by column
     *
     * @param  $content, column to return in array format
     */
    protected function extractArrayByColumn($content_array, $column) 
    {
        $roles_decode = json_decode($content_array);
        
        return array_column($roles_decode, 'id');

    }

}
