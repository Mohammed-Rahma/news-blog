<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public int $num = 5;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        global $num;

        for ($i=1; $i < 6 ; $i++){
            DB::table('categories')->insert([
                'name' => 'Category'.$i,
                'created_at' => now()
            ]);
        }

    }
}
