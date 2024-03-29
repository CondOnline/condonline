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
                ->count(5)
                ->has(Residence::factory()->count(40)
                ->has(User::factory()->count(10)))
                ->create();
    }
}
