<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Shift;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class InitAppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Shift::create([
            'name' => 'Shift A'
        ]);

        $shift = Shift::create([
            'name' => 'Shift B'
        ]);

        User::create([
            'name' => 'Michael Kamara',
            'email' => 'mikekkamara@gmail.com',
            'type' => 2,
            'user_number' => Str::random(2),
            'phone_number' => '+254704120644',
            'from' => 'Murang\'a',
            'shift_id' => $shift->id,
            'password' => Hash::make('sheems1_sheems!@#')
        ]);
    }
}
