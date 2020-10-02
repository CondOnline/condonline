<?php

namespace Database\Seeders;

use App\Models\Residence;
use App\Models\Street;
use App\Models\User;
use Illuminate\Database\Seeder;

class StreetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Street::factory()
                ->count(10)
                ->has(Residence::factory()->count(50)
                ->has(User::factory()->count(5)))
                ->create();
    }
}
