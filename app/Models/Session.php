<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory, Uuids;

    protected $fillable = ['shift_id', 'name', 'type', 'start', 'end'];

    protected $dates = [
        'start',
        'end'
    ];
    public function shift(){
        return $this->hasOne(Shift::class);
    }
    public function attendances(){
        return $this->hasMany(Attendance::class)->with('user');
    }
}
