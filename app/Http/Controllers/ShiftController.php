<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Session;
use App\Models\Shift;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class ShiftController extends Controller
{
    /**
     * All shifts
     */
    public function index(){
        $keyboardists = Shift::with('sessionKeyboardists')->get();
        $violinists = Shift::with('sessionViolinists')->get();
        $worshipLeaders = Shift::with('sessionWorshipLeaders')->get();
        return response([
            'keyboardists' => $keyboardists,
            'violinists' => $violinists,
            'worship_leaders' => $worshipLeaders
        ], 200);
    }

    /**
     * Store A new shift
     */
    public function store(Request $request){
        return Shift::create([
            'name' => $request->input('name')
        ]);
    }
    /**
     * Return all shift's sessions
     */
    public function show($id){

        $shifts = Shift::with('sessions', 'users.attendances')->find($id);
        return response($shifts, 200);
    }
    /**
     * Start a shift
     * [
     * 'Shift Leader / keyboardists',
     *  'Data analyst',0
     *  'Keyboardist',1
     *  'Shift Leader / Worshippers',
     * 'Worshipper',2
     *  'Violinist'3
     * ]
     */
    public function start($id, $type = 1){

        $shift = Shift::find($id);

        $session = Session::create([
            'shift_id' => $id,
            'name' => $shift->name . ' - ' . Str::random(3),
            'start' => Carbon::now(),
            'type' => $type
        ]);

        $sessionType = 'ongoing_session_keyboardists';

        switch ($type) {
            case 2:
                $sessionType = 'ongoing_session_worship_leaders';
                break;
            case 3:
                $sessionType = 'ongoing_session_violinists';
                break;
            default:
                break;
        }

        $shift->update([
            'ongoing' => true,
            $sessionType => $session->id
        ]);

        //Create Attendances

        $users = User::where('shift_id', $shift->id)->where('type', $type)->get();

        collect($users)->each(function ($user) use($session){
            $this->createAttendances($user->id, $session->id);
        });

        return response($session, 200);
    }

    public function createAttendances($user_id, $session_id){
        return Attendance::create([
            'user_id' => $user_id,
            'session_id' => $session_id
        ]);
    }

    /**
     * End shift
     */
    public function end($id, $type = 1){
        $shift = Shift::find($id);

        $sessionType = 'ongoing_session_keyboardists';

        switch ($type) {
            case 2:
                $sessionType = 'ongoing_session_worship_leaders';
                break;
            case 3:
                $sessionType = 'ongoing_session_violinists';
                break;
            default:
                break;
        }

        //End session
        $endingSession = Session::find($shift->$sessionType);

        $endingSession->update([
            'end' => Carbon::now()
        ]);

        $shift->update([
            'ongoing' => false,
            $sessionType => null
        ]);

        return response($shift, 200);
    }
    /**
     * End and Begin next shift
     */
    public function goToNext($id, $next, $type){
        //End shift
        $this->end($id, $type);

        //Start next shift
        return $this->start($next, $type);
    }

    public function generateReport(){
        $report = Shift::with('sessions.attendances')->get();
        return $report;
    }


}
