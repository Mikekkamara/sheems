<?php

namespace App\Http\Controllers;

use App\Models\Session;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function sessionsKeyboardists(){
        $sessions = Session::where('type', 1)->orderBy('created_at')->get();
        return $sessions;
    }
}
