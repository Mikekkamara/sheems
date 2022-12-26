<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory, Uuids;

    protected $fillable = ['name', 'ongoing', 'ongoing_session_violinists', 'ongoing_session_keyboardists', 'ongoing_session_worship_leaders'];

    public function sessionViolinists(){
        return $this->hasOne(Session::class,'id', 'ongoing_session_violinists');
    }

    public function sessionKeyboardists(){
        return $this->hasOne(Session::class,'id', 'ongoing_session_keyboardists');
    }

    public function sessionWorshipLeaders(){
        return $this->hasOne(Session::class,'id', 'ongoing_session_worship_leaders');
    }

    public function sessionsViolinists(){
        return $this->hasMany(Session::class)->where('type', 3);
    }

    public function sessionsKeyboardists(){
        return $this->hasMany(Session::class)->where('type', 1);
    }

    public function sessionsWorshipLeaders(){
        return $this->hasMany(Session::class)->where('type', 2);
    }

    public function sessions(){
        return $this->hasMany(Session::class);
    }

    public function users(){
        return $this->hasMany(User::class);
    }
}
