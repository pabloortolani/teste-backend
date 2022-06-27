<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;

class GenresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        array_map(function ($name) {
           Genre::firstOrCreate([
               'name' => $name
           ]);
        }, config('Seeders.genres'));
    }
}
