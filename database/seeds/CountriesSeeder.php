<?php

use Illuminate\Database\Seeder;
use App\Countries;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Countries::create([
            array('code' => 'US', 'name' => 'United States'),
        ]);
    }
}
