<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Session;
use App\Models\User;
use App\Models\Shift;
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
        $data = [];
        $length = [];
        foreach($data as $key => $user){
            // array_push($length, count($user));
            $user = User::create([
                'name' => $user[0],
                'title' => $key === 10 ? 3 : 0,
                'type' => 2,
                'user_number' => Str::random(2),
                'phone_number' => $user[3],
                'from' => $user[1],
                'shift_id' => '560f64c5-25a0-45fa-9b04-5d0d39f07e8c',
                'password' => Hash::make('secret')
            ]);
        }
        return 'completed';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'title' => $request->input('title'),
            'type' => $request->input('type'),
            'user_number' => Str::random(2),
            'phone_number' => $request->input('phone_number'),
            'from' => $request->input('from'),
            'shift_id' => $request->input('shift'),
            'password' => Hash::make('secret')
        ]);

        $sessions = Session::where('type', $request->input('type'))->get();

        collect($sessions)->each(function($session) use($user){
            Attendance::create([
                'user_id' => $user->id,
                'session_id' => $session->id
            ]);
        });

        return response($user, 200);
    }

    public function updateProfile(Request $request){
        $file = $request->file('profile');
        $filename = date('YmdHi') . '.' . $file->getClientOriginalExtension();

        $file->storeAs('public/profile', $filename);

        User::find($request->input('user_id'))->update([
            'profile' => $filename
        ]);

        return response($filename,200);
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


        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'title' => $request->input('title'),
            'type' => $request->input('type'),
            'user_number' => Str::random(2),
            'shift_leader' => $request->input('shift_leader') === 'on' ? true : false,
            'phone_number' => $request->input('phone_number'),
            'from' => $request->input('from'),
            'shift_id' => $request->input('shift')
        ]);

        return response($user->refresh(), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return User::find($request->input('user_id'))->delete();
    }
}
