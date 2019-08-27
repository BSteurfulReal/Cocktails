<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 0; $i < 20; $i++) {
            DB::table('pumps')->insert([
                'type' => $i < 6 ? 'BIG' : 'SMALL',
                'pin' => $i,
                'ml_per_minute' => $i < 6 ? 370 : 100
            ]);
        }

        User::factory()->create(['name'=>'member','email'=>'member@mail.com']);
    }
}
