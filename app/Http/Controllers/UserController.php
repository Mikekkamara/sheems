<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * [
     * 'Shift Leader / keyboardists',
     *  'Data analyst',0
     *  'Keyboardist',1
     *  'Shift Leader / Worshippers',
     * 'Worshipper',2
     *  'Violinist'3
     * ]
     */
    public function index()
    {
        $users = User::with('attendances')->get();
        return response($users, 200);
    }

    public function violinists(){
        $users = User::with('attendances')->where('type', 3)->get();
        return response($users, 200);
    }

    public function keyboardists(){
        $users = User::with('attendances')->where('type', 1)->get();
        return response($users, 200);
    }

    public function worshipLeaders(){
        $users = User::with('attendances')->where('type', 2)->get();
        return response($users, 200);
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
        $filename = '';

        if ($request->file('profile')) {
            $file = $request->file('profile');
            $filename = date('YmdHi') . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/profile', $filename);
        }else{
            $filename = 'default.png';
        }
        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'title' => $request->input('title'),
            'type' => $request->input('type'),
            'user_number' => Str::random(2),
            'phone_number' => $request->input('phone_number'),
            'from' => $request->input('from'),
            'profile' => $filename,
            'shift_id' => $request->input('shift'),
            'password' => Hash::make('secret')
        ]);
        return response(User::with('attendances', 'shift.sessions')->get(), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $data = User::all();

        foreach ($data as $dt){
            $dt->update([ 'type' => 3, 'title' => 0]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $filename = '';

        if ($request->file('profile')) {
            $file = $request->file('profile');
            $filename = date('YmdHi') . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/profile', $filename);
        }else{
            $filename = 'default.png';
        }
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'title' => $request->input('title'),
            'type' => $request->input('type'),
            'user_number' => Str::random(2),
            'phone_number' => $request->input('phone_number'),
            'from' => $request->input('from'),
            'profile' => $filename,
            'shift_id' => $request->input('shift')
        ]);

        return response(User::with('attendances', 'shift.sessions')->get(), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
