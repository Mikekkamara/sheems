<?php

namespace App\Http\Controllers;

use App\Models\Session;
use App\Models\Shift;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ShiftController extends Controller
{
    /**
     * All shifts
     */
    public function index(){
        $shifts = Shift::with('session')->get();
        return response($shifts, 200);
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
     * Start a shift
     */
    public function start($id){

        $shift = Shift::find($id);

        $session = Session::create([
            'shift_id' => $id,
            'start' => Carbon::now()
        ]);

        $shift->update([
            'ongoing' => true,
            'ongoing_session' => $session->id
        ]);

        return response($session, 200);
    }

    /**
     * End shift
     */
    public function end($id){
        $shift = Shift::find($id);

        //End session
        $endingSession = Session::find($shift->ongoing_session);

        $endingSession->update([
            'end' => Carbon::now()
        ]);

        $shift->update([
            'ongoing' => false,
            'ongoing_session' => null
        ]);

        return response($shift, 200);
    }
    /**
     * End and Begin next shift
     */
    public function goToNext($id, $next){
        //End shift
        $this->end($id);

        //Start next shift
        return $this->start($next);
    }


}
