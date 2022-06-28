<?php

namespace Database\Seeders;

use App\Models\LoanStatus;
use Illuminate\Database\Seeder;

class LoanStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        array_map(function ($name) {
           LoanStatus::firstOrCreate([
               'name' => $name
           ]);
        }, config('Seeders.loan_status'));
    }
}
