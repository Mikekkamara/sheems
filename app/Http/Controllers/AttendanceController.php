<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Shift;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AttendanceController extends Controller
{
    public function checkIn($id){

        $user = User::find($id);

        $sessionType = 'ongoing_session_keyboardists';

        switch ($user->type) {
            case 2:
                $sessionType = 'ongoing_session_worship_leaders';
                break;
            case 3:
                $sessionType = 'ongoing_session_violinists';
                break;
            default:
                break;

        }
        $ongoingShift = Shift::where('ongoing', true)->first();


        if($user->shift_id == $ongoingShift->id){
            $attendance = Attendance::where('user_id', $id)->where('session_id',$ongoingShift->$sessionType)->first()->update([ 'start' => Carbon::now() ]);
        }else{
            return response('failed')->isNotFound();
        }
        return response($attendance)->isSuccessful();

    }

    public function checkOut($id){
        $user = User::find($id);

        $sessionType = 'ongoing_session_keyboardists';

        switch ($user->type) {
            case 2:
                $sessionType = 'ongoing_session_worship_leaders';
                break;
            case 3:
                $sessionType = 'ongoing_session_violinists';
                break;
            default:
                break;

        }

        $ongoingShift = Shift::where('ongoing', true)->first();


        if($user->shift_id == $ongoingShift->id){
            $attendance = Attendance::where('user_id', $id)->where('session_id',$ongoingShift->$sessionType)->first()->update([ 'end' => Carbon::now() ]);
        }else{
            return response('failed')->isNotFound();
        }
        return response($attendance)->isSuccessful();
    }
}
